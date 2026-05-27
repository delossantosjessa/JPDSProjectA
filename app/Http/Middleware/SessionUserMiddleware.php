<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionUserMiddleware
{
    /**
     * Redirect guests back to the login page.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('user_account')) {
            return redirect('/')
                ->withErrors(['login' => 'Please log in first to continue.']);
        }

        $userAccount = $request->session()->get('user_account');

        if (($userAccount['must_change_password'] ?? false) && !$request->routeIs('password.change.*')) {
            return redirect()->route('password.change.form', ['user' => $userAccount['id'] ?? null])
                ->with('success', 'Please change your password before proceeding.');
        }

        return $next($request);
    }
}
