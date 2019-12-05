<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
dump(session('locale'));
        if (!session()->has('locale')) {
            $locale = config('app.locale');
            session(['locale' => $locale]);
        }

        App::setLocale(session('locale'));
        return $next($request);
    }
}
