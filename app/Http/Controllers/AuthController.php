<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return redirect($this->redirectDash());
        }

        // Save redirect URL to session
        if ($request->has('redirect')) {
            session(['url.intended' => $request->redirect]);
        }

        return view('login'); // Your Blade view
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect($this->redirectDash());
        }
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|numeric|digits:10|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'city_id' => 'required|exists:cities,id',
            'role_id' => 'required|exists:roles,id',
            'ref_id' => 'nullable|exists:users,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'ref_id' => $request->ref_id,
            'city_id' => $request->city_id,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Your registration has been successful.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended($this->redirectDash());
        }

        return back()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('home');
    }

    protected function redirectDash()
    {
        $role = (int) Auth::user()->role_id;

        $routes = [
            1 => route('admin.dashboard'),
            2 => route('customer.dashboard'),
            3 => route('broker.dashboard'),
            4 => route('developer.dashboard'),
            
        ];

        return $routes[$role] ?? route('home');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return redirect($this->redirectDash());
        }
        return view('login');
    }
}
