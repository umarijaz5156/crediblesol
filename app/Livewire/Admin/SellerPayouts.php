<?php

namespace App\Livewire\Admin;

use App\Models\Payout;
use Livewire\Component;
use Livewire\Attributes\Layout;

class SellerPayouts extends Component
{


    public $sellerId;
    public $viewModel = false;
    public $seePayout;
    public function mount($id){
        $this->sellerId = $id;
    }

    public function viewPayout($id){

        $this->seePayout =  Payout::find($id);
        $this->viewModel = true;
    }

   
    #[Layout('layouts.app')]
    public function render()
    {
        $payouts = Payout::where('seller_account_id',$this->sellerId)->latest()->paginate(20);
        return view('livewire.admin.seller-payouts', ['payouts' => $payouts]);
    }
}
