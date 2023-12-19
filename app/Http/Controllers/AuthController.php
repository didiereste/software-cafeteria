<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class AuthController extends Controller
{


    public function showlogin()
    {
        return view('login');
    }


    public function ingreso(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credenciales = $request->only('email', 'password');

            if (Auth::attempt($credenciales)) {
                return redirect()->route('home');
            }

            throw ValidationException::withMessages([
                'email' => ['Credenciales inválidas.'],
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('login')->withErrors($e->errors())->withInput();
        }
    }

    public function showregistro()
    {
        return view('registro');
    }

    public function logout()
    {
        Auth::logout();  
        session()->flush();  

        return redirect('/');  
    }
}
