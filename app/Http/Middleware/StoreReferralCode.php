<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class StoreReferralCode
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('code')) {
            // Store the referral code in a cookie for 30 days
            Cookie::queue('referral', $request->route('code'), 60 * 24 * 30);
            
            // Redirect to the homepage
            return redirect('/');
        }

        return $next($request);
    }
}
