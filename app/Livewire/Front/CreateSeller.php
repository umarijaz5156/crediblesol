<?php

namespace App\Livewire\Front;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class CreateSeller extends Component
{

    use WithFileUploads;

    #[Validate]
    public $first_name;
    #[Validate]
    public $last_name;
    #[Validate]
    public $username;
    #[Validate]
    public $description;
    #[Validate]
    public $phone_number;
    #[Validate]
    public $businessImage;
    #[Validate]

    public $businessName;
    #[Validate]
    public $country_id;
    #[Validate]
    public $city;
    #[Validate]
    public $address;
    #[Validate]

    public $countryCode;
    public $individual_or_business = 'individual';
    public $loading = false;
    public $fullNumber;

    public $currentStep = 1;


    public function rules()
    {
        return [
            'first_name' => ['required', 'regex:/^[a-zA-z]*$/','min:3', 'max:50'],
            'last_name' => ['required', 'regex:/^[a-zA-z]*$/','min:3', 'max:50'],
            'username' => ['required', 'regex:/^[a-zA-Z]([._-](?![._-])|[a-zA-Z0-9]){1,15}[a-zA-Z0-9]$/', 'string', 'min:3', 'max:17', 'unique:seller_accounts,username'],
           
            'description' => ['required', 'min:5', 'max:2000'],
            'country_id' => ['required', 'exists:countries,id'],
            'businessImage' => ['required', 'image', 'max:2048', 'mimes:png,jpg,jpeg,webp'],
            'individual_or_business' => ['required'],
            'businessName' => ['required', 'string', 'max:255', 'unique:seller_accounts,businessName'],
            'city' => ['required', 'min:2', 'max:50'],
            'address' => ['required', 'min:5', 'max:255'],
            'fullNumber' => ['required', 'numeric'],

        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please enter the first name',
            'last_name.required' => 'Please enter the last name',
            'username.required' => 'Please enter the username',
            'username.regex' => 'Username must not contain spaces and characters at start and end',
            'phone_number.numeric' => 'Phone number must be numeric',
            'individual_or_business.required' => 'Please select one option',
            'businessName.required' => 'Please enter the name of the Business',
            'country_id.required' => 'Please select the country',
            'businessImage.required' => 'Please upload a business logo',
            'businessImage.image' => 'The logo must be an image',
            'businessImage.max' => 'The logo may not be greater than 2MB',
            'businessImage.mimes' => 'The logo must be a file of type: png, jpg, jpeg, webp',
            'city.required' => 'Please enter the city name',
            'address.required' => 'Please enter the address',
            'fullNumber.required' => "Phone number is required.(make sure enter correct number)"
        ];
    }
    

    public function validationAttributes()
    {
        return [
            'country_id' => 'country'
        ];
    }
  
    
    protected $listeners = ['phoneNumberUpdated'];

    public function phoneNumberUpdated($phoneNumber)
    {
        $this->fullNumber = $phoneNumber;
    }

    public function nextStep()
    {
        if ($this->currentStep == 1) {

            $this->firstStepSubmit();
        } else if ($this->currentStep == 2) {
            $this->secondStepSubmit();
        }

        $this->currentStep++;
    }

    public function prevStep()
    {
        $this->currentStep--;
        $this->dispatch('prevStepCalled');
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'first_name' => ['required', 'regex:/^[a-zA-z]*$/','min:3', 'max:50'],
            'last_name' => ['required', 'regex:/^[a-zA-z]*$/','min:3', 'max:50'],
            'username' => ['required', 'regex:/^[a-zA-Z]([._-](?![._-])|[a-zA-Z0-9]){1,15}[a-zA-Z0-9]$/', 'string', 'min:3', 'max:17', 'unique:seller_accounts,username'],
            'fullNumber' => ['required', 'numeric'],
            'phone_number' => ['required', 'numeric'],
            'country_id' => ['required', 'exists:countries,id'],
            'city' => ['required', 'min:2', 'max:50'],
            'address' => ['required', 'min:5', 'max:255'],

        ], [], [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'fullNumber' => 'Phone Number',
            'phone_number' => 'Phone Number',
            'country_id' => 'Country',

        ]);


    }
  
    public function register()
    {

        $this->validate();
        $this->loading = true;
        DB::beginTransaction();

        try {

            $userId = auth()->user()->id;

            $user = User::findOrFail($userId);

            $businessImage = $this->businessImage;
            $businessImagePath = $businessImage->storeAs('profile-photos', Carbon::now()->timestamp . "-" . $businessImage->getClientOriginalName(), 'public');
            $SellerAccount = \App\Models\SellerAccount::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'username' => $this->username,
                'description' => $this->description,
                'phone_number' => $this->fullNumber,
                'city' => $this->city,
                'country_id' => $this->country_id,
                'address' => $this->address,
                'user_id' => auth()->user()->id,
                'business_image' => $businessImagePath,
                'businessName' => $this->businessName,
                'is_approved' => 0,
                'individual_or_business' => $this->individual_or_business

            ]);

          
            DB::commit();
            $user->is_seller = true;
            $user->save();
            $this->loading = false;
            return redirect()->route('seller.dashboard')->with('success', 'Your Seller Information Submit Successfully.');
        } catch (\Throwable $th) {
            $this->loading = false;
            DB::rollBack();
            throw $th;
        }

    }


    public function mount(){
        $user = Auth::user();
        if(!$user){
            return redirect('/login');
        }else{
             if($user->is_seller){
                return redirect(route('seller.dashboard'));
             }
        }

    }

    #[Layout('layouts.web')]

    public function render()
    {
        $user = Auth::user();

        return view('livewire.front.create-seller', ['user' => $user]);
    }
}
