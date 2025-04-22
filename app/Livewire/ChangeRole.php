<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\City;

class ChangeRole extends Component
{
    public $search = '';
    public $roles;

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function changeRole($userId, $newRoleId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->role_id = $newRoleId;
            $user->save();
            session()->flash('success', 'User role updated successfully.');
        }
    }

    public function render()
    {
        $users = [];

    if (strlen($this->search) >= 2) {
        $users = User::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('mobile_number', 'like', '%' . $this->search . '%');
            })
            ->with('role')  // <-- this was likely being ignored earlier!
            ->get();
    }

        return view('livewire.change-role', compact('users'));
    }
}
