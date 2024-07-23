<?php

namespace App\Livewire\Front;

use App\Models\Category;
use App\Models\Conversation;
use App\Models\Product;
use App\Models\SellerAccount;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;


class Home extends Component
{


    public function mount()
    {
        // $installed = Storage::disk('public')->exists('installed');

        // if ($installed === false) {
        //     return redirect()->route('setup.check');
        // }
    }

    public function ChatModel($id)
    {
        $conversation = Conversation::where('seller_id', $id)->where('buyer_id', auth()->user()->id)->first();

        if (!$conversation) {
            $conversation =  Conversation::create([
                "seller_id" => $id,
                "buyer_id" => auth()->user()->id,
            ]);
        }

        return redirect()->route('buyer.chats', ['id' => $conversation->id]);

    }

    #[Layout('layouts.web')]
    public function render()
    {
        $categories = Category::get();
        $products = Product::select('products.*')
        ->leftJoin('product_stats', 'products.id', '=', 'product_stats.product_id')
        ->orderByDesc('product_stats.avg_rating')
        ->where('products.approved', 1)
        ->take(15)
        ->get();

        $latestProducts = Product::where('products.approved', 1)
        ->latest() 
        ->take(15)
        ->get();
    
            

        $sellers = SellerAccount::with('user')
            ->where('is_approved', 1)
            ->latest()
            ->take(15)
            ->get();

            $setting = Setting::where('key', 'feature_sellers')->first();
            $businessIds = [];
            if ($setting && $setting->value) {
                $businessIds = json_decode($setting->value, true);
            }
            
    
        $featureSellers = SellerAccount::whereIn('id', $businessIds)
        ->where('is_approved', true)
        ->get();

        return view('livewire.front.home', ['products' => $products, 'categories' => $categories, 'sellers' => $sellers,'latestProducts' => $latestProducts,'featureSellers' =>$featureSellers]);
    }
}
