<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // dd(User::where('email', $request->input('email'))->first());
        if(Auth::attempt($request->except(['_token']))) {
            return redirect('/admin');
        }
        return redirect('/auth/login')->with('messageError', 'Email/password combination is invalid');
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
        return redirect('/auth/login')->with('messageSuccess', 'Account created. Please use your email to login');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function logout() {
        Auth::logout();
        return redirect ('/auth/login')->with('messageSuccess', 'Logout Successfully');
    }

    public function sendForgotPasswordEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['messageSuccess', __($status)])
                    : back()->with(['messageError', __($status)]);
    }

    public function showResetPassword($token, $email)
    {
        return view('auth.reset-password', [
            'token' => $token,
             'email' => $email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('messageSuccess', __($status))
                    : back()->with('messageError',__($status));
    }

    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();

    }

    public function googleLoginRedirect()
    {
        // dd(Socialite::driver('google'));
        $socialiteUser = Socialite::driver('google')->user();
        $user = User::firstOrCreate([
            'email' => $socialiteUser->email,
        ], [
            'name' => $socialiteUser->name,
            'password' => Hash::make(uniqid()),
            'email_verified_at' => now(),
        ]);

        if (!$user->email_verified_at) {
                $user->email_verified_at = now();
                $user->save();
            }

        Auth::login($user);

        return redirect('/admin');
    }

    public function loginWithGitlab()
    {
        return Socialite::driver('gitlab')->redirect();

    }

    public function gitlabLoginRedirect()
    {
        // dd(Socialite::driver('google'));
        $socialiteUser = Socialite::driver('gitlab')->user();
        $user = User::firstOrCreate([
            'email' => $socialiteUser->email,
        ], [
            'name' => $socialiteUser->name,
            'password' => Hash::make(uniqid()),
            'email_verified_at' => now(),
        ]);

        if (!$user->email_verified_at) {
                $user->email_verified_at = now();
                $user->save();
            }

        Auth::login($user);

        return redirect('/admin');
    }
}

