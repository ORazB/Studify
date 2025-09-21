<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $userRole = session('role');

        // If no session, redirect to login
        if (!$userRole) {
            return redirect()->route('login');
        }

        // Check if user's role is in the allowed roles
        if (!in_array($userRole, $roles)) {
            // Redirect based on their actual role
            if ($userRole === 'admin') {
                return redirect()->route(route: 'users.index')
                    ->with('error', 'You do not have permission to access that page.');
            }

            if ($userRole === 'student') {
                return redirect()->route('students.index')
                    ->with('error', 'You do not have permission to access that page.');
            }

            // Fallback redirect if role doesn't match expected ones
            return redirect()->route('login')
                ->with('error', 'You do not have permission to access that page.');
        }

        // If user has the required role, allow access
        return $next($request);
    }
}