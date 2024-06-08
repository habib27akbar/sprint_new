<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;

class AuthController extends Controller
{
    public function form_login()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->with('alert-danger', 'Login Failed!');
    }

    public function form_regist()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $user = Pengguna::create([
            'id_unit_kerja' => $request->id_unit_kerja,
            'kode_pengguna' => $request->kode_pengguna,
            'nama_pengguna' => $request->nama_pengguna,
            'email' => $request->email,
            'password_pengguna' => Hash::make($request->password_pengguna),
        ]);

        Auth::login($user);
        return redirect('/home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
