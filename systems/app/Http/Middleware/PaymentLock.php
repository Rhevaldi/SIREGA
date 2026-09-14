<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentLock
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('app.payment_lock.enabled') || $request->routeIs('payment.lock')) {
            return $next($request);
        }

        return redirect()->route('payment.lock');
    }
}
