<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function proseslogin(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );
        $data = $request->only('username', 'password');

        if (Auth::attempt($data)) {
            $user = Auth::user();
            if ($user->role == 'super admin' || $user->role == 'admin' || $user->role == 'apoteker' || $user->role == 'dokter') {
                return redirect()->intended('dashboard');
            }
        }
        return redirect('logout');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
