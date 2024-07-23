<?php

namespace App\Livewire\Admin;

use App\Jobs\SendEmailJob;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as ClientRequest;
use GuzzleHttp\Exception\ClientException;

class ManageOrders extends Component
{
    use WithFileUploads;

    public $statusChangeInfo = ['order_status' => 0, 'orderId' => 0];
    public $changeStatusModal = false;
    public $payoutModal = false;
    public $payoutOrangeMoneyModal = false;
    public $price;
    public $commissionAmount;
    public $totalAmount;
    public $isLoading = false;
    public $responseJson;

    public $transactionInfoModel = false;
    public $transactionId;
    public $additionalInfo;


    public $payoutChangeInfo = ['payout_status' => 0, 'orderId' => 0];

    public $statusPaymentChangeInfo = ['payment_status' => 0, 'orderId' => 0];
    public $changePaymentStatusModal = false;
    public $selectedStatus;
    public $attachment;
    public $description;
    public $previousImage;
    protected $rules = [
        'selectedStatus' => ['required', 'string', 'in:complete,cancel'],
    ];

    protected $messages = [
        'selectedStatus.required' => 'Please select a status.',
        'selectedStatus.in' => 'The selected status is invalid. Only "complete" or "cancel" are acceptable.',
    ];


    #[Layout('layouts.app')]
    public function render()
    {

        $orders = Order::with('user', 'product')->latest()
        ->where('payment_status','complete')

            ->paginate(15);

        return view('livewire.admin.manage-orders', ['orders' => $orders]);
    }

    public function confirmChangeStatus($id, $order_status)
    {

        $this->statusChangeInfo['orderId'] = $id;
        $this->changeStatusModal = true;
    }


    public function updateStatus()
    {
        $this->validate();
        $order = Order::findOrFail($this->statusChangeInfo['orderId']);
        $order->order_status = $this->selectedStatus;
        $order->save();

        if ($this->selectedStatus === 'cancel') {
            $product = Product::findOrFail($order->product_id);
            $product->stock = $product->stock + $order->quantity;
            $product->save();
        }


        // for buyer
        $user = User::findOrFail($order->user_id);
        $customerEmail = $user->email;
        $subject = "Order Status Update: Order #" . $order->id;
        $heading = "Order Status Update";

        $statusMessage = ($this->selectedStatus === 'complete') ? 'completed' : 'cancelled';

        $body = "Hello " . $user->name . ",<br><br>
                Your order #" . $order->id . " has been marked as " . $statusMessage . " from the admin side. Below are the updated details of your order:<br><br>
                <strong>Order ID:</strong> " . $order->id . "<br>
                <strong>Total Amount:</strong> " . $order->total_price . "<br>
                <strong>Order Status:</strong> " . ucfirst($this->selectedStatus) . "<br><br>
                Please log in to your account to view the complete details of your order and track its status.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $customerEmail));


        // for seller
        $seller = User::findOrFail($order->product->seller->user_id);
        $customerEmail = $seller->email;
        $subject = "Order Status Update: Order #" . $order->id;
        $heading = "Order Status Update";

        $statusMessage = ($this->selectedStatus === 'complete') ? 'completed' : 'cancelled';

        $body = "Hello " . $order->product->seller->first_name . ",<br><br>
                Your order #" . $order->id . " has been marked as " . $statusMessage . " from the admin side. Below are the updated details of your order:<br><br>
                <strong>Order ID:</strong> " . $order->id . "<br>
                <strong>Total Amount:</strong> " . $order->total_price . "<br>
                <strong>Order Status:</strong> " . ucfirst($this->selectedStatus) . "<br><br>
                Please log in to your account to view the complete details of your order and track its status.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $customerEmail));


        // admin
        $admin = User::where('is_admin', 1)->first();
        $adminEmail = $admin->email;
        $subject = "Order Status Update: Order #" . $order->id;
        $heading = "Order Status Update";

        $statusMessage = "The order #" . $order->id . " has been marked as " . $order->order_status . ".";

        $body = "Hello Admin,<br><br>
                " . $statusMessage . " Below are the updated details of the order:<br><br>
                <strong>Order ID:</strong> " . $order->id . "<br>
                <strong>Total Amount:</strong> " . $order->total_price . "<br>
                <strong>Order Status:</strong> " . ucfirst($order->order_status) . " by Buyer<br><br>
                Please log in to the admin panel to view the complete details of the order.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $adminEmail));



        $this->reset('statusChangeInfo', 'changeStatusModal');
        session()->flash('success', 'Order status has been updated successfully!');
    }

    public function confirmPayout($id, $order_status)
    {

        $this->payoutChangeInfo['orderId'] = $id;
        $this->payoutChangeInfo['payout_status'] = $order_status;

        $order = Order::where('id', $this->payoutChangeInfo['orderId'])->first();

        $this->selectedStatus = $order->payout_status;
        $this->description = $order->payout_description;
        $this->attachment = $order->payout_image;
        $this->previousImage = $order->payout_image;
        $this->dispatch('updateCkEditorBody');
        $this->dispatch('initReviewEditor');
        $this->payoutModal = true;
    }

    public function confirmPayoutWithOrangeMoney($id)
    {
        $this->payoutChangeInfo['orderId'] = $id;

        $order = Order::where('id', $this->payoutChangeInfo['orderId'])->first();

        $settings = Setting::whereIn('key', ['commission_percentage'])
        ->pluck('value', 'key')
        ->all();

        $commission_percentage = $settings['commission_percentage'] ?? 0;

        $Tprice = $order->total_price;
        $commission_amount = ($Tprice * $commission_percentage) / 100;
        $this->price = $Tprice - $commission_amount;
        $this->commissionAmount = $commission_amount;
        $this->totalAmount = $order->total_price;

        $this->payoutOrangeMoneyModal = true;
    }

    public function updatePayoutOrangeMoney()
    {

        $this->validate([
            'price' => 'required|numeric|min:1',
        ]);

        $this->isLoading = true;

        $settings = Setting::whereIn('key', ['orange_money_idType', 'orange_money_id', 'orange_money_pin'])
            ->pluck('value', 'key')
            ->all();
        $requiredKeys = ['orange_money_idType', 'orange_money_id', 'orange_money_pin'];
        $missingKeys = array_diff($requiredKeys, array_keys($settings));

        if (!empty($missingKeys)) {
            $this->addError('error', 'The following fields are required from the admin side: ' . implode(', ', $missingKeys) . '. Go to the setting page and add these values.');
            $this->isLoading = false;
            return;
        }

        $order = Order::where('id', $this->payoutChangeInfo['orderId'])->first();
        if (!$order) {
            $this->addError('error', 'Order not found.');
            $this->isLoading = false;
            return;
        }

        if ($order->payout_status === 'complete') {
            $this->addError('error', 'Order payout status is already completed.');
            $this->isLoading = false;
            return;
        }

        if ($order->product->seller->orange_money_enable == 1) {
            if ($order->product->seller->orange_money_idType && $order->product->seller->orange_money_id) {
                $seller = $order->product->seller;
            } else {
                $this->addError('error', 'Orange Money ID or ID Type is missing.');
                $this->isLoading = false;
                return;
            }
        } else {
            $this->addError('error', 'Orange Money is not enabled for this seller.');
            $this->isLoading = false;
            return;
        }

        $this->sendPayment();
    }

    protected  function sendPayment()
    {
        
        $api_url = env('OM_CASHIN_URL');
        $client_id = env('OM_CUSTOMER_ID');
        $client_secret = env('OM_SECRET_ID');

        $settings = Setting::whereIn('key', ['orange_money_idType', 'orange_money_id', 'orange_money_pin'])
            ->pluck('value', 'key')
            ->all();

        $orange_money_idType = $settings['orange_money_idType'];
        $orange_money_id = $settings['orange_money_id'];
        $orange_money_pin = $settings['orange_money_pin'];


        $order = Order::where('id', $this->payoutChangeInfo['orderId'])->first();
        $customerIdType = $order->product->seller->orange_money_idType;
        $customerId = $order->product->seller->orange_money_id;


        
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
                'value' => $this->price,
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
                    $statusMessage = '';
                    switch ($status) {
                        case 'ACCEPTED':
                            $statusMessage = 'Your transaction was accepted.';
                            break;
                        case 'CANCELLED':
                            $statusMessage = 'Your transaction was cancelled.';
                            break;
                        case 'FAILED':
                            $statusMessage = 'Your transaction failed.';
                            break;
                        case 'INITIATED':
                            $statusMessage = 'Your transaction was initiated.';
                            break;
                        case 'PENDING':
                            $statusMessage = 'Your transaction is pending.';
                            break;
                        case 'PRE_INITIATED':
                            $statusMessage = 'Your transaction was pre-initiated.';
                            break;
                        case 'REJECTED':
                            $statusMessage = 'Your transaction was rejected.';
                            break;
                        case 'SUCCESS':
                            $statusMessage = 'Your transaction was successful.';
                            break;
                        default:
                            $statusMessage = 'Unknown status';
                            break;
                    }

                    $order = Order::where('id', $this->payoutChangeInfo['orderId'])->first();
                    $order->status = $status;
                    if ($status === "SUCCESS") {
                        $order->payout_status = 'complete';
                    }
                    $order->transaction_id = $transactionId;
                    $order->save();

                    $this->isLoading = false;
                    $this->payoutOrangeMoneyModal = false;
                    session()->flash('success', $statusMessage);
                } else {
                    $this->addError('error', $responseData);
                    $this->isLoading = false;
                    return;
                }
            } else {
                $this->addError('error', $responseBody);
                $this->isLoading = false;
                return;
            }
        } catch (ClientException $e) {

            $responseBody = $e->getResponse()->getBody()->getContents();
            $responseJson = json_decode($responseBody);
            $errorCode = $responseJson->status ?? '';
            $errorTitle = $responseJson->title ?? '';
            $errorDetail = $responseJson->detail ?? '';


            $errorMessage = "Error: $errorTitle (Code: $errorCode) - $errorDetail";
            $this->addError('error', $errorMessage);
            $this->isLoading = false;
            return;
        } catch (\Exception $e) {
            // Handle other exceptions
            $this->addError('error', $e->getMessage());
            $this->isLoading = false;
            return;
        }
    }

    public function fetchAdditionalInfo($transId)
    {
        
        $this->isLoading = true;
            try {

            $api_url = env('OM_TRANSACTION_URL') . $transId;
            $client_id = env('OM_CUSTOMER_ID');
            $client_secret = env('OM_SECRET_ID');

            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer ' . $this->getAccessToken($client_id, $client_secret),
            ];


            $request = new ClientRequest('GET', $api_url, $headers);
            $response = $client->send($request);
            $responseBody = $response->getBody()->getContents();
            $responseJson = json_decode($responseBody);
            $this->isLoading = false;

            $this->transactionInfoModel = true;
            
            $this->responseJson = json_encode($responseJson, JSON_PRETTY_PRINT);
        } catch (ClientException $e) {

            $responseBody = $e->getResponse()->getBody()->getContents();
            $responseJson = json_decode($responseBody);
            $errorCode = $responseJson->status ?? '';
            $errorTitle = $responseJson->title ?? '';
            $errorDetail = $responseJson->detail ?? '';

            $this->isLoading = false;

            $errorMessage = "Error: $errorTitle (Code: $errorCode) - $errorDetail";
            $this->addError('error', $errorMessage);
            return;
        } catch (\Exception $e) {
            $this->isLoading = false;

            // Handle other exceptions
            $this->addError('error', $e->getMessage());
            return;
        }
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



    public function updatePayout()
    {

        $validatedData = $this->validate([
            'selectedStatus' => ['required', 'string', 'in:complete,pending'],
            'attachment' => ['required'],
            'description' => ['required', 'min:5', 'max:1000'],

        ], [
            'selectedStatus.required' => 'Please select a status.',
            'selectedStatus.in' => 'The selected status is invalid. Only "complete" or "pending" are acceptable.',
            'description.min' => 'Description must be at least :min characters.',
            'description.max' => 'Description should not exceed :max characters.',
        ]);


        $order = Order::where('id', $this->payoutChangeInfo['orderId'])->first();
        $oldStatus = $order->payout_status;
        $newStatus = $validatedData['selectedStatus'];

        $order->payout_status = $validatedData['selectedStatus'];





        if ($order->payout_image) {
            $path = $order->payout_image;
            Storage::disk('public')->delete($path);
        }

        $newFilename = Carbon::now()->timestamp . '.' . $this->attachment->getClientOriginalExtension();
        $imagePath = $this->attachment->storeAs('payout_images', $newFilename, 'public');

        $order->payout_image = $imagePath;
        $order->payout_description = $validatedData['description'];
        $order->save();

        $this->sendEmailToSeller($order, $oldStatus, $newStatus);
        $this->sendEmailToAdmin($order, $oldStatus, $newStatus);

        $this->payoutModal = false;
        session()->flash('success', 'Payout status has been updated successfully!');
    }

    private function sendEmailToSeller($order, $oldStatus, $newStatus)
    {
        $seller = User::findOrFail($order->product->seller->user_id);
        $customerEmail = $seller->email;
        $subject = "Payout Status Update: Order #" . $order->id;
        $heading = "Payout Status Update";

        $statusMessage = "Your payout request for order #" . $order->id . " has been updated from " . ucfirst($oldStatus) . " to " . ucfirst($newStatus) . ".";

        $body = "Hello " . $order->product->seller->first_name . ",<br><br>
                " . $statusMessage . " Below are the updated details of your order:<br><br>
                <strong>Order ID:</strong> " . $order->id . "<br>
                <strong>Total Amount:</strong> " . $order->total_price . "<br>
                <strong>Payout Status:</strong> " . ucfirst($newStatus) . "<br><br>
                Please log in to your account to view the complete details of your order and payout status.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $customerEmail));
    }

    private function sendEmailToAdmin($order, $oldStatus, $newStatus)
    {
        $admin = User::where('is_admin', 1)->first();
        $adminEmail = $admin->email;
        $subject = "Payout Status Update: Order #" . $order->id;
        $heading = "Payout Status Update";

        $statusMessage = "The payout status for order #" . $order->id . " has been updated from " . ucfirst($oldStatus) . " to " . ucfirst($newStatus) . ".";

        $body = "Hello Admin,<br><br>
                " . $statusMessage . " Below are the updated details of the order:<br><br>
                <strong>Order ID:</strong> " . $order->id . "<br>
                <strong>Total Amount:</strong> " . $order->total_price . "<br>
                <strong>Payout Status:</strong> " . ucfirst($newStatus) . " by Admin<br><br>
                Please log in to the admin panel to view the complete details of the order and payout status.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $adminEmail));
    }


    public function confirmChangePaymentStatus($id, $payment_status)
    {
        if ($payment_status === 'pending') {
            $this->statusPaymentChangeInfo['payment_status'] = 'complete';
        } else {
            $this->statusPaymentChangeInfo['payment_status'] = 'pending';
        }
        $this->statusPaymentChangeInfo['orderId'] = $id;
        $this->changePaymentStatusModal = true;
    }

    public function updatePaymentStatus()
    {
        $order = Order::findOrFail($this->statusPaymentChangeInfo['orderId']);
        $oldStatus = $order->payment_status;
        $newStatus = $this->statusPaymentChangeInfo['payment_status'];

        $order->payment_status = $this->statusPaymentChangeInfo['payment_status'];
        $order->save();


        $this->sendEmailToSellerPayment($order, $oldStatus, $newStatus);
        $this->sendEmailToBuyerPayment($order, $oldStatus, $newStatus);

        $this->reset('statusPaymentChangeInfo', 'changePaymentStatusModal');
        session()->flash('success', 'Payment status has been updated successfully!');
    }

    private function sendEmailToSellerPayment($order, $oldStatus, $newStatus)
    {
        $seller = User::findOrFail($order->product->seller->user_id);
        $sellerEmail = $seller->email;
        $subject = "Payment Status Update: Order #" . $order->id;
        $heading = "Payment Status Update";

        $statusMessage = "The payment status for order #" . $order->id . " has been updated from " . ucfirst($oldStatus) . " to " . ucfirst($newStatus) . ".";

        $body = "Hello " . $seller->first_name . ",<br><br>
                " . $statusMessage . " Below are the updated details of your order:<br><br>
                <strong>Order ID:</strong> " . $order->id . "<br>
                <strong>Total Amount:</strong> " . $order->total_price . "<br>
                <strong>Payment Status:</strong> " . ucfirst($newStatus) . "<br><br>
                Please log in to your account to view the complete details of your order and payment status.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $sellerEmail));
    }
    // Send email to buyer
    private function sendEmailToBuyerPayment($order, $oldStatus, $newStatus)
    {
        $buyer  = User::findOrFail($order->user_id);

        $buyerEmail = $buyer->email;
        $subject = "Payment Status Update: Order #" . $order->id;
        $heading = "Payment Status Update";

        $statusMessage = "The payment status for order #" . $order->id . " has been updated from " . ucfirst($oldStatus) . " to " . ucfirst($newStatus) . ".";

        $body = "Hello " . $buyer->name . ",<br><br>
            " . $statusMessage . " Below are the updated details of your order:<br><br>
            <strong>Order ID:</strong> " . $order->id . "<br>
            <strong>Total Amount:</strong> " . $order->total_price . "<br>
            <strong>Payment Status:</strong> " . ucfirst($newStatus) . "<br><br>
            Please log in to your account to view the complete details of your order and payment status.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $buyerEmail));
    }
}
