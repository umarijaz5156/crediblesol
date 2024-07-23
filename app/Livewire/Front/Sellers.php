<?php

namespace App\Livewire\Front;

use App\Models\Conversation;
use App\Models\SellerAccount;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Sellers extends Component
{
    use WithPagination;



    public function ChatModel($id)
    {
        $conversation = Conversation::where('seller_id', $id)->where('buyer_id', auth()->user()->id)->first();
        if (!$conversation) {
            $conversation =  Conversation::create([
                "buyer_id" => auth()->user()->id,
                "seller_id" => $id,
            ]);
        }

        return redirect()->route('buyer.chats', ['id' => $conversation->id]);

    }



    #[Layout('layouts.web')]
    public function render()
    {
        $sellers = SellerAccount::with('user')->latest()->where('is_approved', 1)->paginate(20);

        return view('livewire.front.sellers', ['sellers' => $sellers]);
    }
}
