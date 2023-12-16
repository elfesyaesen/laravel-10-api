<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Guard;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role, $guard = null)
    {
        $authGuard = Auth::guard($guard);

        $user = $authGuard->user();

        // For machine-to-machine Passport clients
        if (! $user && $request->bearerToken() && config('permission.use_passport_client_credentials')) {
            $user = Guard::getPassportClient($guard);
        }

        if (! $user) {
            return response()->json([
                "status" => "error",
                "message"=> "Giriş Yapmalısınız..."
            ], 401);
        }

        if (! method_exists($user, 'hasAnyRole')) {
            return response()->json([
                "status" => "error",
                "message"=> "Bu Role Sahip Değilsiniz..."
            ], 401);
        }

        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        if (! $user->hasAnyRole($roles)) {
            return response()->json([
                "status" => "error",
                "message"=> "{$role} : Bu Role Sahip Değilsiniz..."
            ], 401);
        }

        return $next($request);
    }

    /**
     * Specify the role and guard for the middleware.
     *
     * @param  array|string  $role
     * @param  string|null  $guard
     * @return string
     */
    public static function using($role, $guard = null)
    {
        $roleString = is_string($role) ? $role : implode('|', $role);
        $args = is_null($guard) ? $roleString : "$roleString,$guard";

        return static::class.':'.$args;
    }
}
