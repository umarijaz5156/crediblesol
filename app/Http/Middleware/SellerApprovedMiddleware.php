<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SellerApprovedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->is_seller && !Auth::user()->seller->is_approved) {
            $errorMessage = 'Please wait until admin approves your seller account.';
            $request->session()->flash('error', $errorMessage);

            return redirect()->route('seller.dashboard')->with('error', $errorMessage);       
         }
        return $next($request);
    }
}
