<?php

namespace App\Livewire\Seller;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

use Livewire\Component;

class SellerEarning extends Component
{


    #[Layout('layouts.seller')]
    public function render()
    {
        
        $seller = Auth::user()->seller;
        $earning = Order::where('order_status', 'complete')
        ->whereIn('product_id', $seller->products->pluck('id'))
        ->where('payment_status', 'complete')
        ->where('payout_status', 'complete')
        ->where('status', 'SUCCESS')
        ->sum('total_price');

        $settings = Setting::whereIn('key', ['commission_percentage'])
            ->pluck('value', 'key')
            ->all();

        $commission_percentage = $settings['commission_percentage'] ?? 0;
        $price = $earning;
        $commission_amount = ($price * $commission_percentage) / 100;
        $total_price = $price - $commission_amount;


        $pendingPayout = Order::where('order_status', 'complete')
        ->whereIn('product_id', $seller->products->pluck('id'))
        ->where('payment_status', 'complete')
        ->where('payout_status', 'pending')
        ->whereNotIn('status', ['SUCCESS'])
        ->sum('total_price');


        $commission_amount = ($pendingPayout * $commission_percentage) / 100;
        $total_pending = $pendingPayout - $commission_amount;

        return view('livewire.seller.seller-earning',['earning' => $total_price,'pendingPayout' => $total_pending]);
    }
}
