<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AlreadyLoggedIn //kullanıcı zaten giriş yapmışsa
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            return redirect('admin/dashboard');
        }

        return $next($request);
    }
}
