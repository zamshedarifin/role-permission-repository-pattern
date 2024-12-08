<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkIsPermited
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = auth()->user();
        if (!$user->hasPermission($permission)) {
            return response()->json(['message' => 'Forbidden: You do not have the required permission'], 403);
        }
        return $next($request);
    }
}
