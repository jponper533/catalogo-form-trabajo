<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LdapSessionAuth
{
    public function handle(Request $request, Closure $next)
    {
        // comprobar si existe el usuario en sesión
        if (!session()->has('username')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}