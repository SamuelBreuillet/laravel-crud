<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureUserIsActiveMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        abort_if(!$user?->is_active, Response::HTTP_UNAUTHORIZED);

        return $next($request);
    }
}
