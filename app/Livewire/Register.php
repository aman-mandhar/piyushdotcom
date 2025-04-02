<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\city;

class Register extends Component
{
    public $name;
    public $mobile_number;
    public $email;
    public $password;
    public $password_confirmation;
    public $city_id; // user's city
    public $ref_id;  // referral id
    public $role_id; // user's role
    public $users;
    public $ref_name; // referral name
    public $cities;
    public $roles;

    public function render()
    {
        if (Auth::check()) {
            return redirect($this->redirectDash());
        }

        return view('livewire.register');
    }
    
    public function mount()
    {
        $this->users = User::all();
        $this->cities = City::orderBy('name', 'asc')->get();
        $this->roles = Role::all();
    }

    public function updated($field)    
    {
        $this->validateOnly($field, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_number' => ['required', 'numeric', 'digits:10', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'city_id' => ['required', 'exists:cities,id'],
            'ref_id' => ['nullable', 'exists:users,id'],
        ]);
        
        if ($this->ref_id) {
            $this->ref_name = User::where('id', $this->ref_id)->first()->name ?? '';

            if (empty($this->ref_name)) {
                session()->flash('error', 'Referral not found!');
            }
        } else {
            $this->ref_name = 'No referral!';
        }
    }

    

    public function register()
    {
        try {
            $validatedData = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile_number' => ['required', 'numeric', 'digits:10', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'city_id' => ['required', 'exists:cities,id'],
                'ref_id' => ['nullable', 'exists:users,id'],
                'role_id' => ['nullable', 'exists:roles,id'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = collect($e->errors())->flatten()->implode(' ');
            session()->flash('error', $messages);
            return;
        }

        $user = User::create([
            'name' => $this->name,
            'mobile_number' => $this->mobile_number,
            'email' => $this->email,
            'ref_id' => $this->ref_id,
            'password' => bcrypt($this->password),
            'city_id' => $this->city_id,
            'role_id' => $this->role_id ?? 2,
            
        ]);

        Auth::login($user);

        return redirect()->to($this->redirectDash());
    }


    protected function redirectDash()
    {
        $routes = [
            1 => route('admin.dashboard'),
            2 => route('customer.dashboard'),
            3 => route('broker.dashboard'),
            4 => route('hd.dashboard'),
        ];

        $role = Auth::user()->role_id;
        return $routes[$role] ?? '/';
    }
}
