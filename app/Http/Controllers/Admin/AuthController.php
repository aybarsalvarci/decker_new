<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        if(Auth::attempt($request->validated()))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }
        return back()->withErrors([
            'email' => 'The information provided does not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
