<?php

namespace App\Livewire\Admin;

use App\Models\SellerAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;



class ManageSellers extends Component
{
    use WithFileUploads;


    public $sortField, $sortAsc = true;
    public $search;
    public $addUserModal = false;
    public $confirmingDeletionModal = false;

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

    public $user_id;

    public $userDeleteId;
    public $sellerEditId;
    public $statusChangeInfo = ['is_approved' => 0, 'sellerId' => 0];
    public $changeStatusModal = false;
    public $loading = false;
    public $individual_or_business = 'individual';

   
    public function rules()
    {
        $rules = [
            'first_name' => ['required', 'regex:/^[a-zA-Z]*$/', 'min:3', 'max:50'],
            'last_name' => ['required', 'regex:/^[a-zA-Z]*$/', 'min:3', 'max:50'],
            'description' => ['required', 'min:5', 'max:2000'],
            'phone_number' => ['required', 'numeric'],
            'country_id' => ['required', 'exists:countries,id'],
            'businessImage' => ['required', 'image', 'max:2048', 'mimes:png,jpg,jpeg,webp'],
            'individual_or_business' => ['required'],
            'city' => ['required', 'min:2', 'max:50'],
            'address' => ['required', 'min:5', 'max:255'],
        ];
    
        if (!$this->sellerEditId) {
            $rules['user_id'] = ['required', 'numeric'];

            // If creating a new seller account, add uniqueness constraints
            $rules['username'] = ['required', 'regex:/^[a-zA-Z]([._-](?![._-])|[a-zA-Z0-9]){1,15}[a-zA-Z0-9]$/', 'string', 'min:3', 'max:17', 'unique:seller_accounts,username'];
            $rules['businessName'] = ['required', 'string', 'max:255', 'unique:seller_accounts,businessName'];
        } else {
            // If editing an existing seller account, remove uniqueness constraints
            
            $rules['username'] = ['required', 'regex:/^[a-zA-Z]([._-](?![._-])|[a-zA-Z0-9]){1,15}[a-zA-Z0-9]$/', 'string', 'min:3', 'max:17'];
            $rules['businessName'] = ['required', 'string', 'max:255'];
        }
    
        return $rules;
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
            'user_id.required' => 'Please select a user',

        ];
    }


    public function showModal(){
        $this->resetFields();
        $this->addUserModal = true;

    }
    public function createUpdateUser(){

        $validatedData = $this->validate();
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }else{
            unset($validatedData['password']);

        }
        if($this->userEditId){
            $user = User::find($this->userEditId);
            if ($user) {
                $user->update($validatedData);
            } else {
                $this->addUserModal = false;

                session()->flash('error', 'User Not found.');

            }
        }else{
            User::create($validatedData);

        }
        $this->resetFields();
        $this->addUserModal = false;

        session()->flash('success', 'User deleted successfully.');

    }

    public function register()
    {
        $this->validate();
        $this->loading = true;
        DB::beginTransaction();

        try {

            if($this->sellerEditId){
                $sellerAccount = \App\Models\SellerAccount::findOrFail($this->sellerEditId);
                $imageName = basename($sellerAccount->business_image);
                if ($this->businessImage && $this->businessImage->getClientOriginalName() !== $imageName) {
                   
                    if ($sellerAccount->business_image) {
                        Storage::disk('public')->delete($sellerAccount->business_image);
                    }
                    $businessImagePath = $this->businessImage->storeAs('profile-photos', Carbon::now()->timestamp . "-" . $this->businessImage->getClientOriginalName(), 'public');
                    $sellerAccount->update(['business_image' => $businessImagePath]);
                }
                
                $sellerAccount->update([
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'username' => $this->username,
                    'description' => $this->description,
                    'phone_number' => $this->phone_number,
                    'city' => $this->city,
                    'country_id' => $this->country_id,
                    'address' => $this->address,
                    'businessName' => $this->businessName,
                    'individual_or_business' => $this->individual_or_business
                ]);
            } 
            else {
                $userId = $this->user_id;
                $user = User::findOrFail($userId);

            $businessImage = $this->businessImage;
            $businessImagePath = $businessImage->storeAs('profile-photos', Carbon::now()->timestamp . "-" . $businessImage->getClientOriginalName(), 'public');
           
            $SellerAccount = \App\Models\SellerAccount::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'username' => $this->username,
                'description' => $this->description,
                'phone_number' => $this->phone_number,
                'city' => $this->city,
                'country_id' => $this->country_id,
                'address' => $this->address,
                'user_id' => $userId,
                'business_image' => $businessImagePath,
                'businessName' => $this->businessName,
                'is_approved' => 1,
                'individual_or_business' => $this->individual_or_business

            ]);

            $user->is_seller = true;
            $user->save();
        }

          
            DB::commit();
            
          
            $this->loading = false;
            $this->addUserModal = false;

            return redirect()->back()->with('success', 'Action performed successfully');
        } catch (\Throwable $th) {
            $this->loading = false;
            DB::rollBack();
            throw $th;
        }

    }

    public function resetFields(){

        $this->first_name = '';
        $this->last_name = '';
        $this->username = '';
        $this->phone_number = '';
        $this->description = '';
        $this->city = '';
        $this->address = '';
        $this->country_id = '';
        $this->businessName = '';
        $this->individual_or_business = '';
        $this->sellerEditId = null;
    }

    public function editSeller($id){
        $this->resetFields();
        $this->sellerEditId=$id;
        $seller = SellerAccount::find($id);
        $this->first_name = $seller->first_name;
        $this->last_name = $seller->last_name;
        $this->username = $seller->username;
        $this->phone_number = $seller->phone_number;
        $this->description = $seller->description;
        $this->city = $seller->city;
        $this->address = $seller->address;
        $this->country_id = $seller->country_id;
        $this->businessName = $seller->businessName;
        $this->businessImage = $seller->business_image;

        $this->individual_or_business = $seller->individual_or_business;
        
        $this->addUserModal = true;
    }

    public function deleteUser($id){
        $this->userDeleteId = $id;
        $this->confirmingDeletionModal = true;
    }

    public function delete()
    {
        $id = $this->userDeleteId;
        $seller = SellerAccount::find($id);
        $userId = $seller->user_id;;
        $user = User::findOrFail($userId);
        $user->is_seller = false;
        $user->save();
        $seller->delete();

        $this->reset('userDeleteId', 'confirmingDeletionModal');
        session()->flash('success', 'Seller deleted successfully.');
    }


    public function confirmChangeStatus($id, $is_approved)
    {
        $this->statusChangeInfo['is_approved'] = !$is_approved;
        $this->statusChangeInfo['sellerId'] = $id;
        $this->changeStatusModal = true;
    }


    public function updateStatus()
    {
        $user = SellerAccount::findOrFail($this->statusChangeInfo['sellerId']);
        $user->is_approved = $this->statusChangeInfo['is_approved'];
        $user->save();

        $this->reset('statusChangeInfo', 'changeStatusModal');
        session()->flash('success', 'Action Performed successfully!');
    }
    

    #[Layout('layouts.app')]
    public function render()
    {
        $sellers = SellerAccount::latest()->paginate(20);
        $users = User::where('is_seller',0)->where('is_admin',0)->get();
        return view('livewire.admin.manage-sellers', ['sellers' => $sellers,'users'=>$users]);
    }
}
