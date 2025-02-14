<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FinancialAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role_id == 2) {
            return $next($request);
        }
        return abort(403, 'Alleen een financiële beheerder heeft toegang tot deze pagina');
    }
}
