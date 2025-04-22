<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $allUsers = User::with('role')->orderBy('name')->get();
        return view('admin.users.index', compact('allUsers'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('mobile_number', 'like', "%$query%")
            ->with('role')
            ->get();

        return view('admin.users.search-results', compact('users', 'query'));
    }

    public function editRole($id)
    {
        $user = User::with('role')->findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit-role', compact('user', 'roles'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User role updated!');
    }
    
    public function profile()
    {
        return view('profile');
    }

    public function editProfile()
    {
        return view('edit-profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|numeric|digits:10',
            'city_id' => 'required|exists:cities,id',
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->mobile_number = $request->mobile_number;
        $user->city_id = $request->city_id;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(auth()->user()->id);

        if (!password_verify($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password updated successfully.');
    }

    public function users()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function addUser()
    {
        return view('add-user');
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    

}
