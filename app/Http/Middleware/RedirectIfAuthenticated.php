<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        $response = $next($request);
        if ($response->getStatusCode()) {
            Log::error($response->getStatusCode() . get_response_description($response->getStatusCode()) . '--: ' . $request->url());
        }
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // return redirect(RouteServiceProvider::HOME);
                if(Auth::user()->hasRole('gis-engineer') === true){
                    return redirect(url('gis-engineer/dashboard'));
                }
                if(Auth::user()->hasRole('surveyor')){
                    return redirect()->route('surveyor.dashboard');
                }
            }
        }
        
    
          

        return $next($request);
    }
}
