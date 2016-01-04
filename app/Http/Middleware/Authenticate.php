<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(!$this->auth->check())
        {
            return redirect()->route('auth.login')
                ->with('status', 'success')
                ->with('message', 'Please login.');
        }

        if($role == 'all')
        {
            return $next($request);
        }

        if( $this->auth->guest() || !$this->auth->user()->hasRole($role))
        {
            abort(403);
        }

        return $next($request);
    }
}
