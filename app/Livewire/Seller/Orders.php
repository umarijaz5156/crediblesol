<?php

namespace App\Livewire\Seller;

use App\Models\Conversation;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Orders extends Component
{

    #[Layout('layouts.seller')]

    public $statusChangeInfo = ['order_status' => 0, 'orderId' => 0];
    public $statusPaymentChangeInfo = ['payment_status' => 0, 'orderId' => 0];
    public $changePaymentStatusModal = false;


    public $changeStatusModal = false;
    public $showPayoutModal = false;
    public $order;

    public function render()
    {

        $seller = Auth::user()->seller;
        $orders = Order::whereIn('product_id', $seller->products->pluck('id'))->latest()
            ->where('payment_status','complete')
            ->paginate(10);

        return view('livewire.seller.orders', ['orders' => $orders]);
    }

    public function createConversation($userId)
    {
        $conversation = new Conversation();
        $conversation->seller_id = auth()->id();
        $conversation->buyer_id = $userId;
        $conversation->save();
        return redirect()->route('seller.chats', $conversation->id);
    }


    public function confirmChangeStatus($id, $order_status)
    {
        if ($order_status === 'delivered') {
            $this->statusChangeInfo['order_status'] = 'pending';
        } else {
            $this->statusChangeInfo['order_status'] = 'delivered';
        }
        $this->statusChangeInfo['orderId'] = $id;
        $this->changeStatusModal = true;
    }

    public function confirmChangePaymentStatus($id, $payment_status)
    {
        if ($payment_status === 'pending') {
            $this->statusPaymentChangeInfo['payment_status'] = 'complete';
        }
        $this->statusPaymentChangeInfo['orderId'] = $id;
        $this->changePaymentStatusModal = true;
    }

    public function updatePaymentStatus()
    {
        $product = Order::findOrFail($this->statusPaymentChangeInfo['orderId']);
        $product->payment_status = $this->statusPaymentChangeInfo['payment_status'];
        $product->save();

        $this->reset('statusPaymentChangeInfo', 'changePaymentStatusModal');
        session()->flash('success', 'Payment status has been updated successfully!');
    }


    public function updateStatus()
    {
        $product = Order::findOrFail($this->statusChangeInfo['orderId']);
        $product->order_status = $this->statusChangeInfo['order_status'];
        $product->save();

        $this->reset('statusChangeInfo', 'changeStatusModal');
        session()->flash('success', 'Order status has been updated successfully!');
    }

    public function viewPayout($id)
    {

        $this->order = Order::where(["id" => $id])->with("user")->first();
        $this->showPayoutModal = true;

    }
}
