<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use Closure;
use Illuminate\Http\Request;

class SuggestAppeal
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('appealed') === true) {
            return $next($request);
        }

        if ($request->session()->missing('suggest_counter')) {
            $request->session()->put('suggest_counter', 0);
            $request->session()->put('transaction_counter', 0);
        }
        $setting = app(Settings::class);
        if ($request->session()->get('suggest_counter') < $setting->max_attempts) {
            if ($request->session()->get('transaction_counter') < $setting->frequency) {
                $request->session()->increment('transaction_counter');
            } else {
                $request->session()->now('suggest', true);
                $request->session()->put('suggest_shown', true);
                $request->session()->increment('suggest_counter');
                $request->session()->put('transaction_counter', 0);
            }
        }
        return $next($request);
    }
}
