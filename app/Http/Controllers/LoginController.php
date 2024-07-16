<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $data_login = $request->only('email', 'password');

        if (Auth::attempt($data_login)) {

            return redirect()->route('dashboard');
 
        }

        return redirect()->route('login')->with('error', 'Credenciais inválidas. Por favor, tente novamente.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
