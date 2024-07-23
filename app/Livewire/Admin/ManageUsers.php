<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;



class ManageUsers extends Component
{

    public $sortField, $sortAsc = true;
    public $search;
    public $addUserModal = false;
    public $confirmingDeletionModal = false;

    public $name;
    #[Validate]

    public $email;
    #[Validate]

    public $password;
    #[Validate]

    public $userDeleteId;
    public $userEditId;
    public $statusChangeInfo = ['is_seller' => 0, 'userId' => 0];
    public $changeStatusModal = false;


   
    public function rules()
    {
        return [
            'name' => ['required','min:3', 'max:50'],
            'email' => 'required|email',
            'password' => $this->userEditId ? 'nullable' : 'required',
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

    public function resetFields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->userEditId = '';
        $this->userDeleteId = '';

        
    }

    public function editUser($id){
        $this->userEditId=$id;
        $user = User::find($id);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->addUserModal = true;
    }

    public function deleteUser($id){
        $this->userDeleteId = $id;
        $this->confirmingDeletionModal = true;
    }

    public function delete()
    {
        $id = $this->userDeleteId;
        $user = User::find($id);
        $user->delete();

        $this->reset('userDeleteId', 'confirmingDeletionModal');
        session()->flash('success', 'User deleted successfully.');
    }


    public function confirmChangeStatus($id, $is_seller)
    {
        $this->statusChangeInfo['is_seller'] = !$is_seller;
        $this->statusChangeInfo['userId'] = $id;
        $this->changeStatusModal = true;
    }


    public function updateStatus()
    {
        $user = User::findOrFail($this->statusChangeInfo['userId']);
        $user->is_seller = $this->statusChangeInfo['is_seller'];
        $user->save();

        $this->reset('statusChangeInfo', 'changeStatusModal');
        session()->flash('success', 'Action Performed successfully!');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $users = User::latest()->paginate(10);
        return view('livewire.admin.manage-users', ['users' => $users]);
    }
}
