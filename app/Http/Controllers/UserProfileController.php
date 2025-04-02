<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function edit()
    {
        $profile = Auth::user()->profile ?? new UserProfile();
        return view('profile-edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:15',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:50',
            'zipcode' => 'nullable|string|max:10',
            'gender' => 'nullable|string|in:Male,Female,Other',
            'bio' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $profile = $user->profile ?? new UserProfile(['user_id' => $user->id]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $profile->profile_picture = $path;
        }

        $profile->fill($request->except('profile_picture'))->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
