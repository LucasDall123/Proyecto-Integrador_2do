<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsTecnico
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'tecnico')) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Acceso no autorizado.');
    }
}
