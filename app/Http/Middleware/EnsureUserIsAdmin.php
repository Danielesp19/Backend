<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->user_type === 'admin') {
        return $next($request);
}


        return response()->json([
            'error' => 'Unauthorized',
            'message' => 'Access restricted to administrators only.',
        ], 403);
    }
}

