<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if(Auth::attempt($request->except(['_token']))) {
            return redirect('/admin');
        }
        return redirect ('/auth/login')->with('messageError', 'Email/password combination is invalid');

    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect ('/auth/login')
            ->with('messageSuccess', 'Account created successfully..');
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
