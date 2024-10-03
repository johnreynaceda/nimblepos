<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cashier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        switch (auth()->user()->user_type) {
            case 'admin':
                return redirect()->route('dashboard');
            case 'manager':
                return redirect()->route('dashboard');
               
            case 'cashier':
                return $next($request);
            
            default:
               return redirect()->route('logout');
                
        }
    }
}
