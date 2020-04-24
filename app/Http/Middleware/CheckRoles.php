<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
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
        //func_get_args() es una funcion de php que devuelve todos los  parametros
        $roles = array_slice(func_get_args(), 2);

        if (auth()->user()->hasRoles($roles)) {
            return $next($request);
        }

        //Si no tiene el rol que autoriza el acceso redirecciona al home
        return redirect('/dashboard');
    }
}
