<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is logged and role is in the allowed list
        if (auth()->check() && in_array(auth()->user()->role, $roles)) {
         return $next($request);
        }

        return redirect('dashboard')->with('error', 'You do not have the permission for this action');
    }
}
