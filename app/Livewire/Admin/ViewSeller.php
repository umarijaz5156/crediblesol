<?php

namespace App\Livewire\Admin;

use App\Models\SellerAccount;
use Livewire\Component;
use Livewire\Attributes\Layout;


class ViewSeller extends Component
{

    public $seller;

    public function mount($id){
        $this->seller = SellerAccount::findOrFail($id);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.view-seller');
    }
}
