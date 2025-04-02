<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\City;

class AuthForm extends Component
{
    public $tab = 'login';

    // Login Fields
    public $email;
    public $password;

    // Register Fields
    public $name;
    public $mobile_number;
    public $password_confirmation;
    public $city_id;
    public $ref_id;
    public $role_id = 2;
    public $cities = [];

    public $redirect;
    public $authenticated = false;
    public $propertyUserId;
    public $propertyUserMobile;

    public function mount($redirect = null, $propertyUserId = null, $propertyUserMobile = null)
    {
        $this->redirect = $redirect ?? session('url.intended');
        $this->cities = City::orderBy('name')->get();
        $this->propertyUserId = $propertyUserId;
        $this->propertyUserMobile = $propertyUserMobile;
    }

    public function switchTab($tab)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->tab = $tab;
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->authenticated = true;
            $this->dispatch('user-logged-in');
        } else {
            session()->flash('error', 'Invalid credentials.');
        }
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'mobile_number' => 'required|digits:10|unique:users',
            'password' => 'required|min:8|confirmed',
            'city_id' => 'required|exists:cities,id',
            'ref_id' => 'nullable|exists:users,id'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'password' => Hash::make($this->password),
            'city_id' => $this->city_id,
            'ref_id' => $this->ref_id,
            'role_id' => $this->role_id,
        ]);

        Auth::login($user);
        $this->authenticated = true;
        $this->dispatch('user-logged-in');
    }

    public function render()
    {
        return view('livewire.auth-form');
    }
}
