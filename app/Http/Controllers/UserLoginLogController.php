<?php

namespace App\Http\Controllers;

use App\Models\UserLoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserLoginLogController extends Controller
{
    public function index()
    {
        $logs = UserLoginLog::orderBy('id', 'desc')->get();
        return view('login-history', compact('logs'));
    }
    
    public function myIndex()
    {
        $logs = UserLoginLog::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();
        return view('my-login-history', compact('logs'));
    }
}

