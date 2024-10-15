<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ProvidersRouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }
        if(auth('web')->check()){
            return redirect(RouteServiceProvider::HOME);
        }

        if(auth('admin')->check()){
            return redirect(RouteServiceProvider::ADMIN);
        }

        if(auth('doctor')->check()){
            return redirect(RouteServiceProvider::DOCTOR);
        }

        if(auth('ray_employee')->check()){
            return redirect(RouteServiceProvider::RayEmployee);
        }

        if(auth('laporatory_employee')->check()){
            return redirect(RouteServiceProvider::LaporatoryEmployee);
        }

        if(auth('patient')->check()){
            return redirect(RouteServiceProvider::PATIENT);
        }

        return $next($request);
    }
}
