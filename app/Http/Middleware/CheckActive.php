<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Flasher\SweetAlert\Prime\SweetAlertInterface;

class CheckActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->is_active == true) {
            return $next($request);
        }else{
            Auth::logout();
            sweetalert()->error('Your Account has been deactivated. Please contact your administrator');
            return redirect()->route('login');
        }
    }
}
