<?php

namespace App\Livewire\Seller;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Attributes\Layout;

use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.seller')]

    public function render()
    {
        $categoryCount = Category::count();
        $user = User::with('seller')->findOrFail(auth()->id());
        $productCount = Product::where('approved', 1)->where('seller_account_id', $user->seller->id)->count();
        $completedOrders = Order::where('order_status', 'complete')
            ->whereHas('product', function ($query) use ($user) {
                $query->where('seller_account_id', $user->seller->id);
            })
            ->count();
        $allOrders = Order::whereHas('product', function ($query) use ($user) {
            $query->where('seller_account_id', $user->seller->id);
        })
            ->count();
        return view('livewire.seller.dashboard', ['categoryCount' => $categoryCount, 'productCount' => $productCount, 'completedOrders' => $completedOrders, 'allOrders' => $allOrders]);
    }
}
