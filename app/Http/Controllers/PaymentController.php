<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as ClientRequest;
use GuzzleHttp\Exception\ClientException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Services\PaytechService;
use App\Jobs\SendEmailJob;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    
    public function success(Request $request, $code)
    {

        $orderId = Crypt::decryptString($code);
        $order = Order::findOrFail($orderId);
        $order->payment_status = 'complete';
        $order->save();


        // Buyer email
            $user = User::findOrFail($order->user_id);
            $customerEmail = $user->email;
            $subject = "Payment Confirmation for Order #" . $order->id;
            $heading = "Payment Confirmation";

            $body = "Hello ". $user->name .",<br><br>
                    Your payment for Order #" . $order->id . " has been successfully processed. Below are the details of your order:<br><br>
                    <strong>Order ID:</strong> " . $order->id . "<br>
                    <strong>Total Amount:</strong> " . $order->total_price . "<br>
                    <strong>Payment Status:</strong> Complete<br><br>
                    Please log in to your account to view the complete details of your order and track its status.<br><br>";

            $emailData = [
                'body' => $body,
                'subject' => $subject,
                'heading' => $heading
            ];

            dispatch(new SendEmailJob($emailData, $customerEmail));

            // Seller email
            $user1 = User::findOrFail($order->product->seller->user->id);
            $customerEmail = $user1->email;
            $subject = "Payment Confirmation for Order #" . $order->id;
            $heading = "Payment Confirmation";

            $body = "Hello ". $order->product->seller->first_name .",<br><br>
            Congratulations! You have received a new order for Order #" . $order->id . ". Below are the details:<br><br>
                    <strong>Order ID:</strong> " . $order->id . "<br>
                    <strong>Total Amount:</strong> " . $order->total_price . "<br>
                    <strong>Payment Status:</strong> Complete<br><br>
                    Please log in to your account to view the complete details of the order and fulfill it as soon as possible.<br><br>";

            $emailData = [
                'body' => $body,
                'subject' => $subject,
                'heading' => $heading
            ];

            dispatch(new SendEmailJob($emailData, $customerEmail));

            // Admin email
            $admin = User::where('is_admin', 1)->first();
            $adminEmail = $admin->email;
            $subject = "Payment Confirmation for Order: #" . $order->id;
            $heading = "Payment Confirmation";

            $body = "Hello Admin,<br><br>
                    A new order has been received for Order #" . $order->id . ". Below are the details:<br><br>
                    <strong>Order ID:</strong> " . $order->id . "<br>
                    <strong>Total Amount:</strong> " . $order->total_price . "<br>
                    <strong>Payment Status:</strong> Complete<br><br>
                    Please log in to the admin panel to view the complete details of the order.<br><br>";

            $emailData = [
                'body' => $body,
                'subject' => $subject,
                'heading' => $heading
            ];

            dispatch(new SendEmailJob($emailData, $adminEmail));



        return Redirect::to(route('buyer.orders'))->with('success', 'Payment completed successfully.');
    }

    public function cancel(Request $request, $code)
    {

        $orderId = Crypt::decryptString($code);
        $order = Order::findOrFail($orderId);
        $order->payment_status = 'cancel';
        $order->order_status = 'cancel';

        $order->save();

            $product = Product::findOrFail($order->product_id);
            $product->stock = $product->stock + $order->quantity;
            $product->save();


            // buyer email
            $user = User::findOrFail($order->user_id);
            $customerEmail = $user->email;
            $subject = "Payment Cancellation for Order #" . $order->id;
            $heading = "Payment Cancellation";
        
            $body = "Hello ". $user->name .",<br><br>
            Your payment for Order #" . $order->id . " has been cancelled. Below are the details of your order:<br><br>
                    <strong>Order ID:</strong> " . $order->id . "<br>
                    <strong>Total Amount:</strong> " . $order->total_price . "<br>
                    <strong>Payment Status:</strong> Cancelled<br><br>
                    Please log in to your account to view the complete details of your order and track its status.<br><br>";
        
            $emailData = [
                'body' => $body,
                'subject' => $subject,
                'heading' => $heading
            ];
        
            dispatch(new SendEmailJob($emailData, $customerEmail));


            // seller email
            $user1 = User::findOrFail($order->product->seller->user->id);
            $customerEmail = $user1->email;
            $subject = "Payment Cancellation for Order #" . $order->id;
            $heading = "Payment Cancellation";
            $body = "Hello ". $order->product->seller->first_name .",<br><br>
            The payment for Order #" . $order->id . " has been cancelled by the buyer. Below are the details of the order:<br><br>
            <strong>Order ID:</strong> " . $order->id . "<br>
            <strong>Total Amount:</strong> " . $order->total_price . "<br>
            <strong>Payment Status:</strong> Cancelled<br><br>
            We regret to inform you that the payment for the order has been cancelled. Please log in to your account to view the complete details of the order.<br><br>";
    
            $emailData = [
                'body' => $body,
                'subject' => $subject,
                'heading' => $heading
            ];
        
            dispatch(new SendEmailJob($emailData, $customerEmail));

            // Admin email
            $admin = User::where('is_admin', 1)->first();
            $adminEmail = $admin->email;
            $subject = "Payment Cancellation for Order #" . $order->id;
            $heading = "Payment Cancellation";

            $body = "Hello Admin,<br><br>
                    The payment for Order #" . $order->id . " has been cancelled by the buyer. Below are the details of the order:<br><br>
                    <strong>Order ID:</strong> " . $order->id . "<br>
                    <strong>Total Amount:</strong> " . $order->total_price . "<br>
                    <strong>Payment Status:</strong> Cancelled by Buyer<br><br>
                    Please log in to the admin panel to view the complete details of the order.<br><br>";

            $emailData = [
                'body' => $body,
                'subject' => $subject,
                'heading' => $heading
            ];

            dispatch(new SendEmailJob($emailData, $adminEmail));

        

        return Redirect::to(route('buyer.orders'))->with('error', 'Payment cancelled.');
    }



    public function sendPayment(Request $request)
    {
        // Replace these values with your actual credentials and data
        $api_url = 'https://api.sandbox.orange-sonatel.com/api/eWallet/v1/cashins';
        $client_id = env('OM_CUSTOMER_ID');
        $client_secret = env('OM_SECRET_ID');

        $settings = Setting::whereIn('key', ['orange_money_idType','orange_money_id','orange_money_pin'])
        ->pluck('value', 'key')
        ->all();

        $requiredKeys = ['orange_money_idType', 'orange_money_id', 'orange_money_pin'];
        $missingKeys = array_diff($requiredKeys, array_keys($settings));

        if (!empty($missingKeys)) {
            dd('The following fields are required from the admin side: ' . implode(', ', $missingKeys));
            return redirect()->back()->withErrors([
                'error' => 'The following fields are required from the admin side: ' . implode(', ', $missingKeys),
            ]);
        }

        $orange_money_idType = $settings['orange_money_idType'];
        $orange_money_id = $settings['orange_money_id'];
        $orange_money_pin = $settings['orange_money_pin'];



        $pinCode = $orange_money_pin;
        $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtZzGVQjEGJ97sFxPmuZ2sUX0F9UTmOY0EEcehsURFyv5u1pGV4/y9P9f0OmTeBjPslVKtF/rqQUsHpqdx0uU/pRFxmHft+phuu+9MCP/hmbFbyJNaF/EeD0A4Nx1j72AWyvctS7z1Xjfio+cuqS5szZ4iOJ1RO3K1gg91CrpxOOoHnQC7PsZ332wbsa/PnBJ5uDBDhA8szpw/OnBKXxxnluKGuD7wse3VH9T1j2yaJWflZlyEKJi6ftRj2+DV/3lA/0ggehOpVN+Px9MYTolGgriK7BZ0Lr4wsVz+hdls+EXJn8beIRkkmtyhF43R9ABbkUfMCoCEnAUSEdLVSwfrwIDAQAB';
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
                'idType' => 'MSISDN',
                'id' => '771899696',
                'encryptedPinCode' => $partner_encrypted_pin,
            ],
            'customer' => [
                'idType' => 'MSISDN',
                'id' => '786175700',
            ],
            'amount' => [
                'value' => 1,
                'unit' => 'XOF',
            ],
            // 'metadata' => [
            //     'senderFirstName' => "Mr",
            //     'senderLastName' => 'XOF',
            // ],
            'reference' => '',
            'receiveNotification' => false,
        ]);
     

               // Send Cash In request
        try {
            $request = new ClientRequest('POST', $api_url, $headers, $body);
            $response = $client->send($request);
            
            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);
            dd($responseBody);
          


        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $reasonPhrase = $response->getReasonPhrase();
            $body = $response->getBody()->getContents();
        
            // Log or handle the error message
            logger()->error("ClientException: $statusCode $reasonPhrase - $body");
        
            // Show the error message
            dd("Client error: $statusCode $reasonPhrase - $body");
        } catch (\Exception $e) {
            // Handle other exceptions
            dd($e);
        }
    }

    // Function to get OAuth access token
    private function getAccessToken($client_id, $client_secret)
    {
        $token_url = 'https://api.sandbox.orange-sonatel.com/oauth/token';

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
