<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signInPage()
    {
        if (Auth::check() && Auth::user()){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.signin');
    }

    public function signUpPage()
    {
        if (Auth::user() && Auth::check()){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.signup');
    }

    public function signIn(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            toast('Login Successfully', 'success', 'top-right');
            return to_route('admin.dashboard');
        }
    }

    public function logOut()
    {
        Auth::logout();
        toast('Successfully logout','success');
        return redirect()->route('admin.sign-in');
    }
}
