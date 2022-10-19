<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin ()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        return 'ok';
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        return 'ok';
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }


    public function showResetPassword()
    {
        return view('auth.reset-password');
    }
}
