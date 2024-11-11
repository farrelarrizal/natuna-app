<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login
    public function login()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('auth.login', $data);
    }

    public function loginPost(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended('dashboard/executive-summary');
        }

        return redirect()->back()->with('error', 'Email atau password salah');
    }

    //logout
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
