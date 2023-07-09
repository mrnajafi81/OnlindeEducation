<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user)
            return $next($request);
        else
            return redirect(route('auth.index'))
                ->with('login', true)
                ->withErrors('برای دسترسی به این قسمت باید اول درسایت لاگین کنید.');
    }
}
