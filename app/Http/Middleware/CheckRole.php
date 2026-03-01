<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Log the role being checked
        Log::info('Role in middleware: ' . $role);

        // Check if the user is authenticated and has the required role
        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request);
        }

        // Redirect or abort if the user does not have the required role
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
