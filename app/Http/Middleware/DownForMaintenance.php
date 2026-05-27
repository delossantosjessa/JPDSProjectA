<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DownForMaintenance
{
    /**
     * Show the maintenance page when the app is manually flagged as unavailable.
     *
     * Set APP_DOWN_FOR_MAINTENANCE=true in .env to enable this middleware.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isMaintenanceEnabled = (bool) env('APP_DOWN_FOR_MAINTENANCE', false);

        if ($isMaintenanceEnabled && !$request->routeIs('maintenance')) {
            return response()->view('maintenance', [], 503);
        }

        return $next($request);
    }
}
