<?php

namespace App\Http\Middleware\Admin;

use App\Constants\AdminRoleConst;
use App\Models\Admin\SystemMaintenance as AdminSystemMaintenance;
use Closure;
use Illuminate\Http\Request;

class SystemMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Allow all access in development environment
        if (config('app.env') === 'local' || env('DISABLE_MAINTENANCE_GUARD', false)) {
            return $next($request);
        }

        $system_maintenance = AdminSystemMaintenance::first();
        // Guard against null (fresh installs or missing record) and only act when enabled
        if (!$system_maintenance || (int) $system_maintenance->status !== 1) {
            return $next($request);
        }

        if ($request->routeIs('admin.*')) {
            return $next($request);
        } else {
            if ($request->path() !== '/') {
                return redirect('/'); // Redirect to home page
            }
            abort(503);
        }
    }
}
