<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPassword
{

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!empty($user) && empty($user->password)) {
            if ($request->route()->getName() !== 'dashboard') { //gidilen rotanın ismi dashboard değilse
                return redirect()->route('create-password');
            }
        }
        return $next($request);
    }
}
