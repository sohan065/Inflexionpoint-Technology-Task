<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user is authenticated and has the role of "admin"
        if ($request->user() && $request->user()->role === 'admin') {

            return $next($request);
        }

        return redirect()->route('user.dashboard')->with('error', 'You do not have permission to access this resource.');
    }
}
