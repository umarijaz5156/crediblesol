<?php

namespace App\Livewire\Seller\Chat;

use App\Models\Conversation;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
class Index extends Component
{

    public $conversations;
    public $conversationId;
    public $count;

    public function mount($id = null)
    {
        if (!Auth::check()) {
            abort(404);
        }
        $user_id = auth()->user()->id;
            
        $this->count = Conversation::where('seller_id',$user_id)->count();
        $this->conversationId = $id;

    }

    #[Layout('layouts.seller')]

    public function render()
    {
        return view('livewire.seller.chat.index');
    }
}
