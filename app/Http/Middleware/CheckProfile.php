<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->profile_id != 1) {
            // Redireciona ou retorna um erro
            return redirect()->route('dashboard')->with([
                'message' => 'Você não tem permissão para acessar esta página.',
                 'alert-type' => 'error'
             ]);
        }
        
        return $next($request);
    }
}
