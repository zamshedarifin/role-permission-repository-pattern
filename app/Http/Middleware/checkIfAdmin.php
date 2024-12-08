<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user->roles->contains('name', 'Admin')) {
            return response()->json(['message' => 'Forbidden: Admin access required'], 403);
        }

        return $next($request);
    }
}
