<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    protected const ROLE_USER = 'USER';

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $payload = getPayload($request);

        if (!is_null($payload) && $payload['role'] === self::ROLE_USER) {
            return $next($request);
        }
        return response()->json([
            'message' => 'Unauthorized',
            'error_code' => FORBIDDEN
        ], STATUS_FORBIDDEN);
    }
}
