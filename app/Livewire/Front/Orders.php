<?php

namespace App\Livewire\Front;

use App\Jobs\SendEmailJob;
use App\Models\Conversation;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductStat;
use App\Models\Review;
use App\Models\ReviewAttachment;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $loading = false;

    public $addReviewModel = false;
    public $selectedProduct;

    #[Validate]
    public $review;
    #[Validate]

    public $rating = 0;
    #[Validate]

    public $reviewImages = [];
    #[Validate]


    public $viewOrderModal = false;
    public $selectedOrder;

    #[Layout('layouts.web')]

    public $statusChangeInfo = ['order_status' => 0, 'orderId' => 0];

    #[Validate]
    public $selectedStatus;
    public $changeStatusModal = false;

    protected $rules = [
        'selectedStatus' => ['required', 'string', 'in:complete,disputed'],
    ];

    protected $messages = [
        'selectedStatus.required' => 'Please select a status.',
        'selectedStatus.in' => 'The selected status is invalid. Only "complete" or "disputed" are acceptable.',
    ];

    public function render()
    {
        $orders = Order::with(['user', 'product', 'metric'])
        ->where('payment_status','complete')

            ->where('user_id', auth()->user()->id)
            ->latest()
            ->paginate(10);
        return view('livewire.front.orders', ['orders' => $orders]);
    }

    public function confirmChangeStatus($id, $order_status)
    {
        $this->statusChangeInfo['orderId'] = $id;
        $this->changeStatusModal = true;
    }

    public function createConversation($userId)
    {
        $conversation = new Conversation();
        $conversation->buyer_id = auth()->id();
        $conversation->seller_id = $userId;
        $conversation->save();
        return redirect()->route('buyer.chats', $conversation->id);
    }


    public function updateStatus()
    {
        $this->loading = true;

        $this->validate();

        $product = Order::findOrFail($this->statusChangeInfo['orderId']);
        $product->order_status = $this->selectedStatus;
        $product->save();


        // Buyer email
        $user = User::findOrFail($product->user_id);
        $customerEmail = $user->email;
        $subject = "Order Status Update: Order #" . $product->id;
        $heading = "Order Status Update";

        if ($this->selectedStatus === 'complete') {
            $statusMessage = "Your order #" . $product->id . " has been marked as completed.";
        } elseif ($this->selectedStatus === 'disputed') {
            $statusMessage = "Your order #" . $product->id . " has been marked as disputed.";
        }

        $body = "Hello " . $user->name . ",<br><br>
                " . $statusMessage . " Below are the updated details of your order:<br><br>
                <strong>Order ID:</strong> " . $product->id . "<br>
                <strong>Total Amount:</strong> " . $product->total_price . "<br>
                <strong>Order Status:</strong> " . ucfirst($this->selectedStatus) . "<br><br>
                Please log in to your account to view the complete details of your order and track its status.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $customerEmail));

        // Seller email
        $seller = User::findOrFail($product->product->seller->user_id);
        $sellerEmail = $seller->email;
        $subject = "Order Status Update: Order #" . $product->id;
        $heading = "Order Status Update";

        if ($this->selectedStatus === 'complete') {
            $statusMessage = "The order #" . $product->id . " has been marked as completed by the buyer.";
        } elseif ($this->selectedStatus === 'disputed') {
            $statusMessage = "The order #" . $product->id . " has been marked as disputed by the buyer.";
        }

        $body = "Hello " . $product->product->seller->first_name . ",<br><br>
                " . $statusMessage . " Below are the updated details of the order:<br><br>
                <strong>Order ID:</strong> " . $product->id . "<br>
                <strong>Total Amount:</strong> " . $product->total_price . "<br>
                <strong>Order Status:</strong> " . ucfirst($this->selectedStatus) . "<br><br>
                Please log in to your account to view the complete details of the order and manage it accordingly.<br><br>";

        $emailData = [
            'body' => $body,
            'subject' => $subject,
            'heading' => $heading
        ];

        dispatch(new SendEmailJob($emailData, $sellerEmail));

        // Admin email
        $admin = User::where('is_admin', 1)->first();
        $adminEmail = $admin->email;
        $subject = "Order Status Update: Order #" . $product->id;
        $heading = "Order Status Update";

        if ($this->selectedStatus === 'complete') {
            $statusMessage = "The order #" . $product->id . " has been marked as completed by the buyer.";
        } elseif ($this->selectedStatus === 'disputed') {
            $statusMessage = "The order #" . $product->id . " has been marked as disputed by the buyer.";
        }

        $body = "Hello Admin,<br><br>
                " . $statusMessage . " Below are the updated details of the order:<br><br>
                <strong>Order ID:</strong> " . $product->id . "<br>
                <strong>Total Amount:</strong> " . $product->total_price . "<br>
                <strong>Order Status:</strong> " . ucfirst($this->selectedStatus) . " by Buyer<br><br>
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

    public function viewOrderModel($id)
    {

        $this->selectedOrder = Order::findOrFail($id);
        $this->viewOrderModal = true;
    }

    public function ReviewModel($id)
    {
        $this->selectedOrder = Order::findOrFail($id);
        $this->selectedProduct = Product::findOrFail($this->selectedOrder->product_id);
        $this->addReviewModel = true;
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

            $newReview = Review::create([
                'user_id' => auth()->id(),
                'review' => $this->review,
                'rating' => $this->rating,
                'is_approved' => 1,
                'order_id' => $this->selectedOrder->id,
                'product_id' => $this->selectedProduct->id,
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

            $businessStat = ProductStat::firstOrNew(['product_id' => $this->selectedProduct->id]);

            $reviews = Product::findOrFail($this->selectedProduct->id)->reviews;
            $reviewsCount = $reviews->count();
            $avgRating = $reviews->avg('rating') ?? 0;
            $positiveReviewsCount = $reviews->where('rating', '>=', 3)->count();
            $negativeReviewsCount = $reviewsCount - $positiveReviewsCount;

            // Save business stats
            $businessStat = ProductStat::firstOrNew(['product_id' => $this->selectedProduct->id]);
            $businessStat->reviews_count = $reviewsCount;
            $businessStat->avg_rating = $avgRating;
            $businessStat->positive_reviews_count = $positiveReviewsCount;
            $businessStat->negative_reviews_count = $negativeReviewsCount;

            $businessStat->save();


            $this->reset(['review', 'rating']);
            $this->addReviewModel = false;


            return redirect()->back()->with('success', 'Action performed Successfully.');
        }
    }
}
