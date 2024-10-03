<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        switch (auth()->user()->user_type) {
            case 'admin':
                return $next($request);
            case 'manager':
                return redirect()->route('dashboard');
            case 'cashier':
                return redirect()->route('dashboard');
            
            default:
               return redirect()->route('logout');
                
        }
    }
}
