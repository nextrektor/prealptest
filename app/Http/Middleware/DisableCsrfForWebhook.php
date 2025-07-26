<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisableCsrfForWebhook
{
    public function handle(Request $request, Closure $next): Response
    {
        // Only disable CSRF for the GitHub webhook
        if ($request->is('greq-web')) {
            // Simulate the CSRF being valid
            app()->instance('middleware.disable_csrf', true);
        }

        return $next($request);
    }
}
