<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        /**
         * this middleware must be used with auth middleware
         */

        //get user
        $user = auth()->user();

        //check user exist
        if (!$user)
            return 403;

        // check user role
        if (in_array($user->role, $roles))
            return $next($request);
        else
            return 403;
    }
}
