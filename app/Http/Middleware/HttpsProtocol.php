<?php
namespace App\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
        $request->server->set('HTTPS', 'on');
        if ($request->header('x-forwarded-proto') <> 'https') {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}