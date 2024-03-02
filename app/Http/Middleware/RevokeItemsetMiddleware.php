<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RevokeItemsetMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('k-itemset') || session()->has('current_apriori_id')) {
            session()->forget('k-itemset');
            session()->forget('current_apriori_id');
        }

        return $next($request);
    }
}
