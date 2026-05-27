<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $userAccount = $request->session()->get('user_account');

        if (!$userAccount) {
            return redirect()->route('login')
                ->withErrors(['login' => 'Please log in first to continue.']);
        }

        if (!in_array($userAccount['role'] ?? null, $roles, true)) {
            return redirect()->route('dashboard')
                ->withErrors(['access' => 'You are not allowed to access that page.']);
        }

        return $next($request);
    }
}
