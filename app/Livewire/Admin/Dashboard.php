<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
  
    #[Layout('layouts.app')]
    public function render()
    {
        $categoryCount = Category::count();
        $productCount = Product::where('approved',1)->count();
        $sellerCount = User::where('is_seller',1)->count();
        $userCount = User::count();


        $earning = Order::where('payment_status', 'complete')
        ->sum('total_price');

        $settings = Setting::whereIn('key', ['commission_percentage'])
            ->pluck('value', 'key')
            ->all();

        $commission_percentage = $settings['commission_percentage'] ?? 0;
        $price = $earning;
        $commission_amount = ($price * $commission_percentage) / 100;
        $total_price = $price - $commission_amount;


        $totalPayout = Order::where('payout_status', 'complete')
            ->where('payment_status', 'complete')
            ->sum('total_price');
        $commission_amount1 = ($totalPayout * $commission_percentage) / 100;
        $total_payout = $totalPayout - $commission_amount1;



        $pendingPayout = Order::where('payout_status', 'pending')
        ->where('payment_status', 'complete')

            ->sum('total_price');
            $commission_amount2 = ($pendingPayout * $commission_percentage) / 100;
        $pending_payout = $pendingPayout - $commission_amount2;


        return view('livewire.admin.dashboard', 
        [
            'categoryCount' => $categoryCount,
            'productCount' => $productCount,
            'sellerCount' => $sellerCount,
            'userCount' => $userCount,
            'earning' => $earning,
            'adminEarning' => $commission_amount,
            'pending_payout' => $pending_payout,
            'total_payout' => $total_payout,
        ]);
    }
}

