<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->is_admin === 1) {
            return $next($request);
        }
        abort(403, 'Bu işlemi yapmaya yetkiniz yok.');
    }
}
