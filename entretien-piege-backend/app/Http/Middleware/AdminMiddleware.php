<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifiez si l'utilisateur est connecté et a le rôle "admin"
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Si l'utilisateur n'est pas admin, on retourne une réponse 403
        return response()->json(['message' => 'Accès interdit. Seuls les administrateurs peuvent accéder à cette ressource.'], 403);
    }
}