<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'email é obrigatório.',
            'password.required' => 'password é obrigatório.',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('ticket.index');
        }

        return redirect()->back()->with('danger', 'E-mail ou Senha inválida');
    }

    public function logout()
    {
        Auth::logout();        
        return redirect()->route('login.index');
    }
}
