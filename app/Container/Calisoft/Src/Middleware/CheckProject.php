<?php

namespace App\Container\Calisoft\Src\Middleware;

use Closure;

class CheckProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
          $user = $request->user();
          return $user->proyectos()->count() ? $user->goHome() : $next($request);
    }
}
