<?php

namespace App\Livewire\Front;

use App\Jobs\SendEmailJob;
use App\Models\Conversation;
use App\Models\Currency;
use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductStat;
use App\Models\Report;
use App\Models\Review;
use App\Models\ReviewAttachment;
use App\Models\Setting;
use App\Models\User;
use App\Models\WeightMetric;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithPagination;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;




use Livewire\Component;

class ProductDetails extends Component
{

    use WithFileUploads;
    use WithPagination;

    public $attachments = [];


    public $product, $productNameFilter;
    public $receiver_id, $sender_id;
    public $conversation;
    public $chatModel = false;
    public $message;
    public $currentUrl;

    public $metrics;
    public $quantity = 1;
    public $selectedMetric;
    public $orders;

    public $addReviewModel = false;

    #[Validate]
    public $review;
    #[Validate]

    public $rating = 0;
    #[Validate]

    public $reviewImages = [];
    #[Validate]

    public $addReportModel = false;
    public $reportInfo = ['reported_item_id' => 0, 'report_type' => 0];
    public $report;
    #[Validate]


    public $alreadyReview;
    public $totalPrice;
    public $conversationId;
    // payments
    public $product_name;
    public $price;
    public $token;
    public $apiKey;
    public $secretKey;

    public $baseUrl = 'https://paytech.sn/api';
    public $loading = false;


    protected $rules = [
        'message' => 'required|string|max:255',
        'attachments' => ['array', 'max:5'],
        'attachments.*.size' => 'max:5120',
        'attachments.*' => ['mimes:png,doc,docx,jpg,webp,jpeg,pdf,xls,xlsx,txt,zip', 'max:5120'],

    ];

    public function mount($title, $id)
    {

        $this->loading = false;

        preg_match('/\d+$/', $id, $matches);
        $lastNumber = $matches[0];
        $this->product = Product::with([
            'attachments',
            'seller',
            'category',
            'stockMetric',
            'priceMetric',
            'reviews' => function ($query) {
                $query->latest();
            }
        ])
            ->where('id', $lastNumber)
            ->firstOrFail();




        $this->receiver_id = $this->product->seller->user_id;
        $this->sender_id = auth()->user()->id ?? 0;

        if (auth()->user()) {

            $this->orders = Order::where('user_id', auth()->id())
                ->where('user_id', auth()->user()->id)
                ->where('product_id', $this->product->id)
                ->where('order_status', 'complete')
                ->get();

            $this->alreadyReview =  Review::where('user_id', auth()->id())
                ->where('product_id', $this->product->id)->exists();
        } else {
            $this->orders = [];
        }


        $this->conversation = Conversation::where('seller_id', $this->receiver_id)->where('buyer_id', $this->sender_id)->first();
        $this->currentUrl = URL::current();

        $this->metrics = WeightMetric::get();
        $this->apiKey = env('PAY_TECH_API_KEY');
        $this->secretKey = env('PAY_TECH_SECRET_KEY');
        $this->totalPrice = $this->quantity * $this->product->price;
    }

    public function ChatModel()
    {
        $conversation = Conversation::where('seller_id', $this->product->seller->user_id)->where('buyer_id', auth()->user()->id)->first();
        $this->conversationId = $conversation->id ?? null;
        $this->chatModel = true;
    }

    public function sendMessage()
    {
        $this->validate();
        $this->validateAttachmentCount();

        if (!$this->conversation) {
            Conversation::create([
                "buyer_id" => $this->sender_id,
                "seller_id" => $this->receiver_id,
            ]);
            $this->conversation = Conversation::where('seller_id', $this->receiver_id)->where('buyer_id', $this->sender_id)->first();
        }

        $linkText = "I want to Know about this product. Link: ";
        $link = $linkText . $this->currentUrl . "\n";
        $messageContent = $link . $this->message;

        $message = Message::create([
            "message" => $messageContent,
            "conversation_id" => $this->conversation->id,
            "sender_id" => $this->sender_id,
            "receiver_id" => $this->receiver_id,
        ]);

        foreach ($this->attachments as $attachment) {
            $newFilename = $attachment->getClientOriginalName();
            $imagePath = $attachment->storeAs('chats_attachments', Carbon::now()->timestamp . '-' . $newFilename, 'public');
            MessageAttachment::create([
                'message_id' => $message->id,
                'file_path' => $imagePath,
            ]);
        }

        $this->message = '';
        session()->flash('success', 'The message being sent along with the product link.');
        $this->chatModel = false;
    }

    protected function validateAttachmentCount()
    {
        $attachmentCount = count($this->attachments);

        if ($attachmentCount > 5) {
            $this->addError('attachments_error', 'You can upload a maximum of 5 attachments.');
            return;
        }
    }

    public function buy()
    {

        $this->validate([
            'quantity' => 'required|numeric|min:1|max:' . $this->product->stock,
        ]);

        if (!$this->loading) {
            $this->loading = true;

            $total = $this->quantity * $this->product->price;

            $order = Order::create([
                'user_id' => auth()->user()->id,
                'total_price' => $total,
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
                'metric_id' => $this->product->price_metric,
            ]);

            $product = Product::findOrFail($this->product->id);
            $product->stock = $this->product->stock - $this->quantity;
            $product->save();
            // add this for test because live link need here.
            $ipn_url = 'https://hotbleepreviews.webmasterspark.com';
            // $ipn_url = route('payment.callback', ['code' => $code]);



            $api_key = $this->apiKey;
            $api_secret = $this->secretKey;
            $url = $this->baseUrl . '/payment/request-payment';

            $ref_commande = $this->product->title . '-' . $order->id;
            $environment = 'test';
            $code = Crypt::encryptString($order->id);
            $success_url = route('payment.success', ['code' => $code]);
            $cancel_url = route('payment.success', ['code' => $code]);
            $currency = env('APP_CURRENCY', 'USD');




            // Buyer email.
            $this->buyerOrderEmail($order);
            $this->sellerOrderEmail($order);
            $this->adminOrderEmail($order);


            // code for currency
            // $setting = Setting::get();
            // if ($setting) {
            //     $currency = $setting->where('key', 'currency')->whereNotNull('value')->first();
            //     if ($currency) {
            //         $currency_type = Currency::findOrFail($currency->value);
            //         $currency = $currency_type->code;
            //     } else {
            //         $currency = 'USD';
            //     }
            // } else {
            //     $currency = 'USD';
            // }


            try {
                $client = new Client();
                $response = $client->post($url, [
                    'headers' => [
                        'API_KEY' => $api_key,
                        'API_SECRET' => $api_secret,
                        'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8'
                    ],
                    'form_params' => [
                        'item_name' => $this->product->title,
                        'item_price' => $total,
                        'currency' => $currency,
                        'ref_command' => $ref_commande,
                        'command_name' => $this->product->title,
                        'env' => $environment,
                        'success_url' => $success_url,
                        'ipn_url' => $ipn_url,
                        'cancel_url' => $cancel_url,
                        '3d_secure' => false,
                    ]
                ]);


                $jsonResponse = $response->getBody()->getContents();
                $responseData = json_decode($jsonResponse, true);
                if ($responseData && array_key_exists('success', $responseData)) {
                    if ($responseData['success'] < 0) {
                        // Handle error response
                        $errorMessage = $responseData['message'] ?? 'Unknown error occurred.';
                        if (strpos($errorMessage, 'activer votre compte') !== false) {

                            session()->flash('error', 'Unknown error occurred');
                        } else {
                            session()->flash('error', $errorMessage);
                        }
                    } elseif ($responseData['success'] == 1) {
                        // Handle success response
                        $token = $responseData['token'] ?? null;
                        if ($token) {
                            $orderT = Order::where('id', $order->id)->first();
                            $orderT->payTech_token = $token;
                            $orderT->save();
                            $this->loading = false;

                            return redirect()->to($responseData['redirect_url']);
                        } else {
                            session()->flash('error', 'There was an issue with the payment method. Your order is placed, and you can contact the seller for further details.');
                        }
                    } else {
                        session()->flash('error', 'There was an issue with the payment method. Your order is placed, and you can contact the seller for further details.');
                    }
                } else {
                    session()->flash('error', 'There was an issue with the payment method. Your order is placed, and you can contact the seller for further details.');
                }
            } catch (RequestException $e) {

                session()->flash('error', 'There was an issue with the payment method. Your order is placed, and you can contact the seller for further details.');
            }
        }
    }


    public function buyerOrderEmail($order){

        $user = User::findOrFail($order->user_id);
        $customerEmail = $user->email;
        $subject = "Order Placed for Order #" . $order->id;
        $heading = "Order Placed";

        $body = "Hello ". $user->name .",<br><br>
        Thank you for shopping with us! Your order #" . $order->id . " has been successfully placed. Below are the details of your order:<br><br>
        <strong>Order ID:</strong> " . $order->id . "<br>
        <strong>Total Amount:</strong> " . $order->total_price . "<br>
        <strong>Payment Status:</strong> Pending<br><br>
        Please log in to your account to view the complete details of your order and track its status.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $customerEmail));

    }
    public function sellerOrderEmail($order){
        

        $seller = User::findOrFail($order->product->seller->user->id);
        $sellerEmail = $seller->email;
        $subject = "New Order Received: Order #" . $order->id;
        $heading = "New Order Received";

        $body = "Hello ". $order->product->seller->first_name .",<br><br>
            You have received a new order! Below are the details of the order:<br><br>
            <strong>Order ID:</strong> " . $order->id . "<br>
            <strong>Total Amount:</strong> " . $order->total_price . "<br>
            <strong>Payment Status:</strong> Pending<br><br>
            Please log in to your account to view the complete details of the order and manage it accordingly.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $sellerEmail));

    }

    public function adminOrderEmail($order){

        $admin = User::where('is_admin',1)->first();
        $adminEmail = $admin->email; 
        $subject = "New Order Received: Order #" . $order->id;
        $heading = "New Order Received";

        $body = "Hello Admin,<br><br>
            A new order has been received! Below are the details of the order:<br><br>
            <strong>Order ID:</strong> " . $order->id . "<br>
            <strong>Total Amount:</strong> " . $order->total_price . "<br>
            <strong>Payment Status:</strong> Pending<br><br>
            Please log in to the admin panel to view the complete details of the order and manage it accordingly.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $adminEmail));

    }

    public function updateQuantity()
    {
        if (!$this->quantity) {
            $this->quantity = 1;
        }
        $this->totalPrice = $this->quantity * $this->product->price;
    }


    public function ReviewModel()
    {

        $this->addReviewModel = true;
    }

    public function reportModel($id,$type){

        $this->reportInfo['reported_item_id'] = $id;
        $this->reportInfo['report_type'] = $type;
        $this->addReportModel = true;
    }

    public function sendReportMessage(){

       
        $this->validate([
            'report' => 'required|min:10|max:255',
        ]);

        $reportedItemId = $this->reportInfo['reported_item_id'];
        $reportType = $this->reportInfo['report_type'];

        $report = new Report();
        $report->reported_item_id = $reportedItemId;
        $report->report_type = $reportType;
        $report->user_id = Auth::id();
        $report->message = $this->report;
        $report->save();

        $this->report = '';
        $this->reportInfo = [
            'reported_item_id' => null,
            'report_type' => null,
        ];

        $this->addReportModel = false;
        return redirect()->back()->with('success', 'Action performed Successfully.');

    }


    // store review
    public function StoreOrUpdate()
    {
        $this->validate([
            'review' => 'required|min:50|max:1000',
            'rating' => 'required|numeric|min:0.5|max:5',
            'reviewImages' => [
                function ($attribute, $value, $fail) {
                    if ($value) {
                        if (count($value) > 5) {
                            $fail("The $attribute must not contain more than 5 images.");
                        }

                        foreach ($value as $image) {
                            if (!$image->isValid()) {
                                $fail("One of the $attribute is not a valid image.");
                            }
                        }
                    }
                }
            ]
        ]);


        if ($this->getErrorBag()->isEmpty()) {

            $newReview =  Review::create([
                'user_id' => auth()->id(),
                'review' => $this->review,
                'rating' => $this->rating,
                'is_approved' => 1,
                'product_id' => $this->product->id,
            ]);


            // review images
            if ($this->reviewImages) {
                foreach ($this->reviewImages as $image) {
                    $fileExtension = $image->getClientOriginalExtension() ?? '';
                    $fileName = Carbon::now()->timestamp . "-" . $image->getClientOriginalName();
                    $path = $image->storeAs('review-images', $fileName, 'public');
                    ReviewAttachment::create([
                        'review_id' => $newReview->id,
                        'file_path' => $path,
                        'file_type' => $fileExtension
                    ]);
                }
            }

            $businessStat = ProductStat::firstOrNew(['product_id' => $this->product->id]);

            $reviews = $this->getProduct()->reviews;
            $reviewsCount = $reviews->count();
            $avgRating = $reviews->avg('rating') ?? 0;
            $positiveReviewsCount = $reviews->where('rating', '>=', 3)->count();
            $negativeReviewsCount = $reviewsCount - $positiveReviewsCount;

            // Save business stats
            $businessStat = ProductStat::firstOrNew(['product_id' => $this->product->id]);
            $businessStat->reviews_count = $reviewsCount;
            $businessStat->avg_rating = $avgRating;
            $businessStat->positive_reviews_count = $positiveReviewsCount;
            $businessStat->negative_reviews_count = $negativeReviewsCount;

            $businessStat->save();


            $this->reset(['review', 'rating']);
            $this->addReviewModel = false;

            $this->alreadyReview =  Review::where('user_id', auth()->id())
                ->where('product_id', $this->product->id)->exists();

            return redirect()->back()->with('success', 'Action performed Successfully.');
        }
    }

    protected function getProduct()
    {
        return Product::findOrFail($this->product->id);
    }


    #[Layout('layouts.web')]

    public function render()
    {
        $products = [];
        $latestReviews = $this->product->reviews()->latest()->paginate(5);

        if ($this->product->category) {
            $products = Product::with(['attachments', 'seller', 'category', 'stockMetric', 'priceMetric'])
                ->where('category_id', $this->product->category->id)
                ->when($this->productNameFilter, function ($query, $productNameFilter) {
                    return $query->where('title', 'like', '%' . $productNameFilter . '%');
                })
                ->latest()
                ->take(8)
                ->get();
        }

        return view('livewire.front.product-details', ['products' => $products, 'latestReviews' => $latestReviews]);
    }
}
