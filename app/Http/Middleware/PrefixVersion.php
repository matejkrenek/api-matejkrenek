<?php

namespace App\Http\Middleware;

use App\Facades\API;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrefixVersion
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
        $url = $request->getRequestUri();

        if (!Str::startsWith($url, '/' . API::version())) {
            return redirect('/' . API::version() . $url);
        }

        return $next($request);
    }
}
