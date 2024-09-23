<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sesiController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $infologin = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($infologin)) {
            return redirect('dashboard');
        } else {
            return redirect('login')->withErrors('Username dan Password tidak sesuai')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
