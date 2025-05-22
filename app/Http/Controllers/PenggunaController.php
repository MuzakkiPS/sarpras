<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    
    public function showRegisterForm()
    {
        return view('registeruser'); 
    }

   
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect('/dashboard')->with('success', 'User berhasil ditambahkan!');
    }

   
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password) && $user->role === 'user') {
            return response()->json([
                'message' => 'Login berhasil!',
                'user' => $user,
                'token' => $user->createToken('API Token')->plainTextToken,
            ]);
        }

        return response()->json(['message' => 'Login gagal atau bukan user'], 401);
    }
}
