<?php

namespace App\Livewire\Seller;

use App\Models\SellerAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class SellerInformation extends Component
{

    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $username;
    public $description;
    #[Validate]
    public $phone_number;
    public $businessImage;
    #[Validate]

    public $businessName;
    public $country_id;
    public $city;
    public $address;

    public $countryCode;
    public $seller;
    public $individual_or_business = 'individual';

    public function rules()
    {
       
        $rules = [
            'description' => ['required', 'min:5', 'max:2000'],
            'businessImage' => ['required', 'image', 'max:2048', 'mimes:png,jpg,jpeg,webp'],
        ];
        return $rules;
    }



    public function mount()
    {
        $this->seller = Auth::user()->seller;
        $this->businessImage = $this->seller->business_image;
        $this->description = $this->seller->description;
       
    }

    

    public function register()
    {
        $this->validate();

        $sellerAccount = SellerAccount::findOrFail($this->seller->id);
        $imageName = basename($sellerAccount->business_image);
        if ($this->businessImage && $this->businessImage->getClientOriginalName() !== $imageName) {

            if ($sellerAccount->business_image) {
                Storage::disk('public')->delete($sellerAccount->business_image);
            }
            $businessImagePath = $this->businessImage->storeAs('profile-photos', Carbon::now()->timestamp . "-" . $this->businessImage->getClientOriginalName(), 'public');
            $sellerAccount->update(['business_image' => $businessImagePath]);
        }

        $sellerAccount->update([
            'description' => $this->description,
        ]);
        return redirect()->back()->with('success', 'Action performed successfully');
    }

    #[Layout('layouts.seller')]
    public function render()
    {
        return view('livewire.seller.seller-information');
    }
}
