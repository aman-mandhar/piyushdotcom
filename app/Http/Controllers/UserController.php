<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
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
