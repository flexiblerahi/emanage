<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Activation
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            // Get the user's status
            $userStatus = auth()->user()->status;

            // Check if the status is 0
            if ($userStatus === 0 ) {
                abort(403, 'Your account is currently inactive.');
            }
        }

        return $next($request);
    }
}
