<?php

namespace App\Livewire\Seller;

use App\Models\Payout;
use App\Models\SellerAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;

class ManagePayout extends Component
{


    public $orange_money_idType;
    #[Validate]
    public $orange_money_id;
    #[Validate]

    public $receive_payment = false;
    public $seller;

    public function rules()
    {
        $rules = [
            'orange_money_idType' => ['required', 'min:3', 'max:15'],
            'orange_money_id' =>  ['required', 'digits:9'],
        ];
     
        return $rules;
    }


    public function mount()
    {
        $this->seller = Auth::user()->seller;
        $this->orange_money_idType  = $this->seller->orange_money_idType;
        $this->orange_money_id  = $this->seller->orange_money_id;
        $this->receive_payment = $this->seller->orange_money_enable;
    }

    
    public function toggleReceivePayment()
    {
      
        if ($this->receive_payment) {
            $this->receive_payment = true;
        } else {
            $this->receive_payment = false;
        }
    }


    public function register()
    {
        $this->validate();

        $sellerAccount = SellerAccount::findOrFail($this->seller->id);

        $sellerAccount->update([
             'orange_money_idType' =>  $this->orange_money_idType ?? null,
             'orange_money_id' =>  $this->orange_money_id ?? null,
             'orange_money_enable' => $this->receive_payment ? true : false,
        ]);
        return redirect()->back()->with('success', 'Action performed successfully');
    }

    #[Layout('layouts.seller')]
    public function render()
    {
        return view('livewire.seller.manage-payout');
    }
}
