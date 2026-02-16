<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated via JWT
        $user = auth('api')->user();

        if (!$user || $user->role !== 'admin') {
            return response()->json([
                'error' => 'Unauthorized. Admins only.'
            ], 403);
        }

        return $next($request);
    }
}
