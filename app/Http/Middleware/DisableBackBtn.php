<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DisableBackBtn
{
    public function handle(Request $request, Closure $next)
    {
        //önbelleklemeyi engelleyerek geri butonunu pasif hale getirir.
        // önbllek süresi geçmişe ayarlanınca tarayıcı önbelleği kullanamaz.
        $response = $next($request);
        $response->header('Cache-Control', 'no-store, max-age=0, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;

    }
}
