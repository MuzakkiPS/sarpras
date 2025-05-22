<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showRegisterForm()
    {
        return view('register');
    }


    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin'
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);



        if ($request->role === 'admin') {
            return redirect('/login')->with('success', 'Admin berhasil didaftarkan! Silakan login.');
        }

        return redirect('/dashboard')->with('success', 'User berhasil ditambahkan!');
    }
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if (auth()->attempt($request->only('email', 'password'))) {

            if (auth()->user()->role === 'admin') {
                return redirect('/dashboard')->with('success', 'Berhasil login!');
            } else {
                auth()->logout();
                return redirect('/login')->withErrors([
                    'email' => 'Akun ini tidak diperbolehkan login di sini.',
                ]);
            }
        }


        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Berhasil logout!');
    }

    public function showDashboard()
    {
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    public function showUsers()
    {
        $users = User::all();
        return view('user', compact('users'));
    }
}
