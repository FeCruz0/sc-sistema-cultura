<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate(['email'=>'required|email','password'=>'required']);

        // tentativa padrão (usa provider e hashing do Laravel)
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // fallback: usuário com campo legacy 'senha' (hash armazenado em coluna diferente)
        $user = User::where('email', $request->email)->first();
        if ($user && isset($user->senha) && Hash::check($request->password, $user->senha)) {
            Auth::login($user); // login manual do usuário já validado
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }
}