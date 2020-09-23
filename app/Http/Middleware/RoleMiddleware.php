<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Middlewares\RoleMiddleware as LaravelRoleMiddleware;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware extends LaravelRoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest()) {
            return response()->json([
                'data' => 'Từ chối truy cập',
                'error' => true,
            ], Response::HTTP_FORBIDDEN);
        }

        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        if (! Auth::user()->hasAnyRole($roles)) {
            return response()->json([
                'data' => 'Từ chối truy cập',
                'error' => true,
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
