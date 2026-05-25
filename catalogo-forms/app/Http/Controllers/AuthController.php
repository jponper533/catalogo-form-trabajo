<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use LdapRecord\Models\ActiveDirectory\User;
use LdapRecord\Container;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Muestra la vista con el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar campos requeridos
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'El usuario es obligatorio',
            'password.required' => 'La contraseña es obligatoria',
        ]);

        $credentials = $request->only('username', 'password');

        $connection = Container::getConnection();

        // Validar contra LDAP
        if (!$connection->auth()->attempt($credentials['username'] . '@DMSAS', $credentials['password'])) {
            return back()->withErrors(['message' => 'Credenciales inválidas']);
        }

        session(['username' => $credentials['username']]);

        return redirect()->route('dashboard');
    }

    // Cierra la sesión del usuario
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
