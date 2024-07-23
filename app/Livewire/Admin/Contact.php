<?php

namespace App\Livewire\Admin;
use App\Models\Contact as ModelsContact;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Contact extends Component
{
   
    #[Layout('layouts.app')]
    public function render()
    {
        $contacts = ModelsContact::latest()->paginate(20);
        return view('livewire.admin.contact', ['contacts' => $contacts]);
    }
}
