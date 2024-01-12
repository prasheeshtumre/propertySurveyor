<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Log;
use Closure;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //  'https://egovindia.co.in/csr/enquiry-forms-get',
    ];
    
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->getStatusCode()) {
            Log::error($response->getStatusCode() . get_response_description($response->getStatusCode()) . ': ' . $request->url());
        }

        return $response;
    }
}
