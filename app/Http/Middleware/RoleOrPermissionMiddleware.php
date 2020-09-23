<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleOrPermissionMiddleware extends \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware
{
    public function handle($request, Closure $next, $roleOrPermission)
    {
        if (Auth::guest()) {
            return response()->json([
                'data' => 'Từ chối truy cập',
                'error' => true,
            ], Response::HTTP_FORBIDDEN);
        }

        $rolesOrPermissions = is_array($roleOrPermission)
            ? $roleOrPermission
            : explode('|', $roleOrPermission);

        if (! Auth::user()->hasAnyRole($rolesOrPermissions) && ! Auth::user()->hasAnyPermission($rolesOrPermissions)) {
            return response()->json([
                'data' => 'Từ chối truy cập',
                'error' => true,
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
