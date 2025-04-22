<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return view('dashboards.admin');
    }

    public function customerDashboard()
{
    return view('dashboards.customer');
}

    public function employeeDashboard()
    {
        return view('dashboards.employee');
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $role = (int) Auth::user()->role_id;

        switch ($role) {
            case 1:
                return redirect()->route('admin.dashboard');
            case 2:
                return redirect()->route('customer.dashboard');
            case 3:
                return redirect()->route('employee.dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Invalid role! Logged out.');
        }
    }
}
