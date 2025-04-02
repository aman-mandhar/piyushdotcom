<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\city;

class ChangeRole extends Component
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

    public function mount()
    {
        $this->users = User::all();
        $this->cities = City::orderBy('name', 'asc')->get();
        $this->roles = Role::all();
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
            session()->flash('errors_list', collect($e->errors())->flatten());

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

        // redirect to dashboard with session message
        session()->flash('message', 'User created successfully!');
        return redirect($this->redirectDash());
    }


    protected function redirectDash()
    {
        $routes = [
            1 => route('admin.dashboard'),
            2 => route('buyer.dashboard'),
            3 => route('seller.dashboard'),
            4 => route('broker.dashboard'),
            5 => route('hd.dashboard'),
        ];

        $role = Auth::user()->role_id;
        return $routes[$role] ?? '/';
    }
    
    public function render()
    {
        return view('livewire.change-role');
    }
}
