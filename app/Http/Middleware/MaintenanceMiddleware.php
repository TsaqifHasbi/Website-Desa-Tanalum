<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $maintenanceMode = Setting::getValue('maintenance_mode', '0');

        if ($maintenanceMode === '1') {
            // Allow access for admin users
            if (Auth::check() && Auth::user()->hasAdminAccess()) {
                return $next($request);
            }

            // Allow access to login page
            if ($request->routeIs('login') || $request->routeIs('admin.login') || $request->routeIs('admin.login.submit')) {
                return $next($request);
            }

            $message = Setting::getValue('maintenance_message', 'Website sedang dalam perbaikan. Silakan kembali beberapa saat lagi.');

            return response()->view('maintenance', [
                'message' => $message,
            ], 503);
        }

        return $next($request);
    }
}
