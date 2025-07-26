<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class SkipCsrfForWebhook extends Middleware
{
    protected $except = [
        '/greq-web', // exclude GitHub webhook route
        '/greq-web/'
    ];
}
