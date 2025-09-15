<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $role = session('role');

        if (!$role || !in_array($role, $roles)) {
            if ($role === 'admin') {
                return redirect()->route('users.index')
                    ->with('error', 'You do not have permission to access that page.');
            }

            if ($role === 'student') {
                return redirect()->route('students.index')
                    ->with('error', 'You do not have permission to access that page.');
            }

            // if no session at all
            return redirect()->route('login');
        }

        return $next($request);
    }
}
