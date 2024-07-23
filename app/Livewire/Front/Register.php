<?php

namespace App\Livewire\Front;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class Register extends Component
{

    public $name;
    #[Validate]
    public $email;
    #[Validate]
    public $password;
    #[Validate]
    public $password_confirmation;
    #[Validate]


    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
                ];
    }

    public function updated($field)
    {
        // Check password requirements when password field is updated
        if ($field == 'password') {
            $this->validatePassword($this->password);
        }

        // Check if password and password confirmation match when confirmation field is updated
        if ($field == 'password_confirmation') {
            $this->validatePasswordConfirmation($this->password_confirmation);
        }
    }

    protected function validatePassword($value)
    {
        // Check for password requirements
        $uppercase = preg_match('/[A-Z]/', $value);
        $lowercase = preg_match('/[a-z]/', $value);
        $number = preg_match('/[0-9]/', $value);
        $specialChars = preg_match('/[^A-Za-z0-9]/', $value);

        $passwordErrors = [];

        if (!$uppercase) {
            $passwordErrors[] = 'At least one uppercase character is required.';
        }

        if (!$lowercase) {
            $passwordErrors[] = 'At least one lowercase character is required.';
        }

        if (!$number) {
            $passwordErrors[] = 'At least one numeric character is required.';
        }

        if (!$specialChars) {
            $passwordErrors[] = 'At least one special character is required.';
        }

        if (strlen($value) < 8) {
            $passwordErrors[] = 'Password must be at least 8 characters long.';
        }

        if (!empty($passwordErrors)) {
            $this->addError('password', implode(' ', $passwordErrors));
        } else {
            $this->clearValidation('password');
        }
    }

    protected function validatePasswordConfirmation($value)
    {
        // Check if password and password confirmation match
        if ($value != $this->password) {
            $this->addError('password_confirmation', 'Password confirmation does not match.');
        } else {
            $this->clearValidation('password_confirmation');
        }
    }
    public function register(){

        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    
        Auth::login($user);
    
        return redirect()->to('/');
    }

    public function mount(){
        if (auth()->check()) {
            return redirect()->to('/');
        }
    }

    #[Layout('layouts.web')]
    public function render()
    {
        
        return view('livewire.front.register');
    }
}
