<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $role = Auth::user()->role;

            // Allow access only if the user is a 'superadmin'
            if ($role === 'superadmin') {
                return $next($request);
            }
        }

        // Abort with 403 Forbidden if the user does not have access
        abort(403, 'Unauthorized This Page.');
    }
}
