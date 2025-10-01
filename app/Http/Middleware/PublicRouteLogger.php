<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublicRouteLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $startTime = microtime(true);
        
        $response = $next($request);
        
        $endTime = microtime(true);
        $duration = ($endTime - $startTime) * 1000; // Convert to milliseconds

        $logData = [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status_code' => $response->status(),
            'duration_ms' => round($duration, 2),
            'referer' => $request->header('referer'),
            'query_params' => $request->query(),
            'timestamp' => now()->toIso8601String()
        ];

        // Log the request details
        Log::channel('public-access')->info('Public route accessed', $logData);

        return $response;
    }
}