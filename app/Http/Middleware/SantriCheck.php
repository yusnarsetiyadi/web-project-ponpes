<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SantriCheck
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (Auth::guard('santris')->check() || Auth::guard('web')->check()) {
            return $next($request); // Pass the request to the next middleware or controller
        } else {
            return redirect('/santri/login'); // Redirect to member login page
        }
    }
}
