<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate()
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = request()->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/dashboard');
        } else {
            return back()->withInput()->withErrors(['password' => ['salah']]);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
