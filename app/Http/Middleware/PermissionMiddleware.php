<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware extends \Spatie\Permission\Middlewares\RoleMiddleware
{
    public function handle($request, Closure $next, $permission)
    {
        if (app('auth')->guest()) {
            return response()->json([
                'data' => 'Từ chối truy cập',
                'error' => true,
            ], Response::HTTP_FORBIDDEN);
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
            if (app('auth')->user()->can($permission)) {
                return $next($request);
            }
        }

        return response()->json([
            'data' => 'Từ chối truy cập',
            'error' => true,
        ], Response::HTTP_FORBIDDEN);
    }
}
