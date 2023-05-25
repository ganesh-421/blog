<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Support\Facades\Gate;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

// class AdminsOnly
// {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
//     public function handle(Request $request, Closure $next)
//     {
//         if (auth()->user()?->cannot('admin')) //? specifies if auth()->user() is null or not
//             abort(Response::HTTP_FORBIDDEN);
//         return $next($request);
//     }
// }
// gate is defined from appservice provide hence middleware can be removed..
