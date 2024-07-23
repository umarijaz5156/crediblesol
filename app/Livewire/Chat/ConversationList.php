<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ConversationList extends Component
{
    public $conversations;
    public $selectedConversation;
    public $conversationId;
    public $perpage = 10;
    public $pageNumber = 1;
    public $totalChats;


    protected $listeners = ['ticketSelected'];

    public function render()
    {
        return view('livewire.chat.conversation-list');
    }

    public function mount()
    {
        if (!Auth::check()) {
            abort(404);
        }
        $user_id = auth()->user()->id;
           
        $currentPage = $this->pageNumber;
        $offset = ($currentPage - 1) * $this->perpage;
        $this->conversations = Conversation::with(['buyer', 'seller'])->where('buyer_id',$user_id)
        ->take($this->perpage)->offset($offset)->get();
       
        $this->totalChats = Conversation::with(['buyer', 'seller'])->where('buyer_id',$user_id)->count();

        if($this->conversationId){
            $this->getConversation();
        }
    }

     public function ticketSelected($conversation)
    {
        
        $this->selectedConversation = $conversation['id'];
        $this->dispatch('loadChat', conversation: $conversation);

    }
    public function getChat(){
        $user_id = auth()->user()->id;
           
        $currentPage = $this->pageNumber;
        $offset = ($currentPage - 1) * $this->perpage;
        $this->conversations = Conversation::with(['buyer', 'seller'])->where('buyer_id',$user_id)
        ->take($this->perpage)->offset($offset)->get();

        $this->totalChats = Conversation::with(['buyer', 'seller'])->where('buyer_id',$user_id)->count();


}


    public function nextPage(){
        if($this->perpage < $this->totalChats)
            $this->pageNumber = $this->pageNumber + 1;
        $this->getChat();
    }

    public function previousPage(){
        $this->pageNumber = $this->pageNumber - 1 ;
        $this->getChat();
    }


    public function getConversation()
    {
        // $ticket = Ticket::find($this->ticketId);
        $this->selectedConversation = $this->conversationId;
    }
}
