<?php

namespace App\Livewire\Seller\Chat;

use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ConversationList extends Component
{
    public $conversations;
    public $selectedConversation;
    public $conversationId;
    

    protected $listeners = ['ticketSelected'];

    public function mount()
    {
        if (!Auth::check()) {
            abort(404);
        }
        $user_id = auth()->user()->id;
           
        $this->conversations = Conversation::with(['buyer', 'seller'])->where('seller_id',$user_id)->get();
        if($this->conversationId){
            $this->getConversation();
        }
    }

     public function ticketSelected($conversation)
    {
        
        $this->selectedConversation = $conversation['id'];
        $this->dispatch('loadChat', conversation: $conversation);

    }

    public function getConversation()
    {
        // $ticket = Ticket::find($this->ticketId);
        $this->selectedConversation = $this->conversationId;
    }
    public function render()
    {
        return view('livewire.seller.chat.conversation-list');
    }
}
