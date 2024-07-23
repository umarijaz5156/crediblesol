<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;

use Livewire\Component;

class ViewUser extends Component
{


    public $user;
    public $seller;

    public function mount($id){
        $this->user = User::findOrFail($id);
        if($this->user->is_seller){
            $this->seller = $this->user->seller;
        }
    }

    #[Layout('layouts.app')]    
    public function render()
    {
        return view('livewire.admin.view-user');
    }
}
