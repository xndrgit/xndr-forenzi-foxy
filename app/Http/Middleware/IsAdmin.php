<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $super_admin = env('SUPER_ADMIN', 'info@foxybox.it');

        if (auth()->check() && auth()->user() && auth()->user()->email == $super_admin) {
            return $next($request);
        }

        return redirect()->to('/');
    }
}
