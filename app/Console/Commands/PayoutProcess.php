<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailJob;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;
use GuzzleHttp\Psr7\Request as ClientRequest;

class PayoutProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:payout-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve orders that meet the specified criteria

        $settings = Setting::whereIn('key', ['orange_money_idType','days_hold_payment', 'orange_money_id', 'orange_money_pin'])
        ->pluck('value', 'key')
        ->all();

        $days_hold_payment = $settings['days_hold_payment'] ?? 0;


        $orders = Order::where('order_status', 'complete')
            ->where('payment_status', 'complete')
            ->where('payout_status', 'pending')
            ->whereNotIn('status', ['SUCCESS'])
            ->whereDate('created_at', '<=', now()->subDays($days_hold_payment))
            ->get();

      


        $requiredKeys = ['orange_money_idType', 'orange_money_id', 'orange_money_pin'];
        $missingKeys = array_diff($requiredKeys, array_keys($settings));

        if (!empty($missingKeys)) {
            $error = 'The following fields are required from the admin side: ' . implode(', ', $missingKeys) . '. Go to the setting page and add these values.';
            $this->sendEmailToAdmin($error);
            return;
        } else {

            foreach ($orders as $order) {
                if ($order->product->seller->orange_money_enable == 1) {
                    $this->sendPayment($order);
                } else {
                    $this->sendEmailToSeller($order);
                }
            }
        }



        $this->info('Payout processing completed.');
    }

    protected  function sendPayment($order)
    {

        $api_url = env('OM_CASHIN_URL');
        $client_id = env('OM_CUSTOMER_ID');
        $client_secret = env('OM_SECRET_ID');

        $settings = Setting::whereIn('key', ['orange_money_idType', 'orange_money_id', 'orange_money_pin', 'commission_percentage'])
            ->pluck('value', 'key')
            ->all();

        $orange_money_idType = $settings['orange_money_idType'];
        $orange_money_id = $settings['orange_money_id'];
        $orange_money_pin = $settings['orange_money_pin'];
        $commission_percentage = $settings['commission_percentage'] ?? 0;



        $order = Order::where('id', $order->id)->first();
        $customerIdType = $order->product->seller->orange_money_idType;
        $customerId = $order->product->seller->orange_money_id;

        $price = $order->total_price;
        $commission_amount = ($price * $commission_percentage) / 100;
        $total_price = $price - $commission_amount;

        // make oin encrypt
        $pinCode = $orange_money_pin;
        $publicKey = env('OM_PUBLIC_KEY');
        $publicKey = "-----BEGIN PUBLIC KEY-----\n" .
            wordwrap($publicKey, 64, "\n", true) .
            "\n-----END PUBLIC KEY-----";
        openssl_public_encrypt($pinCode, $encryptedPin, $publicKey);

        $partner_encrypted_pin = base64_encode($encryptedPin);

        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getAccessToken($client_id, $client_secret),
        ];

        $body = json_encode([
            'partner' => [
                'idType' => $orange_money_idType,
                'id' => $orange_money_id,
                'encryptedPinCode' => $partner_encrypted_pin,
            ],
            'customer' => [
                'idType' => $customerIdType,
                'id' => $customerId,
            ],
            'amount' => [
                'value' => $total_price,
                'unit' => 'XOF',
            ],
            'reference' => $order->id,
            'receiveNotification' => false,
        ]);


        // Send Cash In request
        try {
            $request = new ClientRequest('POST', $api_url, $headers, $body);
            $response = $client->send($request);

            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);
            if ($responseData) {
                $status = $responseData['status'] ?? null;
                $transactionId = $responseData['transactionId'] ?? null;

                if ($status !== null && $transactionId !== null) {
                    $order = Order::where('id', $order->id)->first();
                    $order->status = $status;
                    if ($status === "SUCCESS") {
                        $order->payout_status = 'complete';
                        $this->sendEmailToSellerSuccess($order);
                    }
                    $order->transaction_id = $transactionId;
                    $order->save();
                    return;
                } else {
                    return;
                }
            } else {
                return;
            }
        } catch (ClientException $e) {

            $responseBody = $e->getResponse()->getBody()->getContents();
            $responseJson = json_decode($responseBody);
            $errorCode = $responseJson->status ?? '';
            $errorTitle = $responseJson->title ?? '';
            $errorDetail = $responseJson->detail ?? '';
            $errorMessage = "Error: $errorTitle (Code: $errorCode) - $errorDetail";
            $this->sendEmailToAdmin($errorMessage);

            return;
        } catch (\Exception $e) {

            return;
        }
    }

    private function sendEmailToAdmin($error)
    {
        $admin = User::where('is_admin', 1)->first();
        $adminEmail = $admin->email;
        $subject = "Payout Error";
        $heading = "Payout Error";

        $statusMessage = $error;

        $body = "Hello Admin,<br><br>
                " . $statusMessage . " This is the Error message of the payout:<br><br>
                Please log in to the admin panel to view the complete details of the order and payout status.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $adminEmail));
    }



    private function sendEmailToSeller($order)
    {

        $seller = User::findOrFail($order->product->seller->user_id);
        $customerEmail = $seller->email;
        $subject = "Enable Orange Payment Method for Payout";
        $heading = "Enable Orange Payment Method";

        $body = "Hello " . $order->product->seller->first_name . ",\n\n"
            . "To enable payouts through Orange Money, please enable the Orange Payment Method in your account settings.\n\n"
            . "Thank you.";

        // Dispatch email job
        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $customerEmail));
    }

    private function sendEmailToSellerSuccess($order)
    {
        $seller = User::findOrFail($order->product->seller->user_id);
        $customerEmail = $seller->email;
        $subject = "Payment Sent Successfully";
        $heading = "Payment Sent Successfully";

        $body = "Hello " . $order->product->seller->first_name . ",\n\n"
            . "Your payout for order #" . $order->id . " has been successfully sent.\n\n"
            . "Thank you for using our platform.";

        // Dispatch email job
        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $customerEmail));
    }



    private function getAccessToken($client_id, $client_secret)
    {

        $token_url = env('OM_TOKEN_URL');

        $response = (new Client())->post($token_url, [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $client_id,
                'client_secret' => $client_secret,
            ],
        ]);

        $response_data = json_decode($response->getBody(), true);
        return $response_data['access_token'];
    }
}
