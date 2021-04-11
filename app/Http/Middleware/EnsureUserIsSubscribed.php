<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    /*
            Este middleware nos permite validar si el usuario autenticado tiene o no la subscripcion pasada,
            en caso de que no la tenga nos va redirigir a los metodos de pago,
            en caso de que sí la tenga, permiet que pueda seguir normal
    */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && ! $request->user()->subscribed('Curso pasarela de pagos'))
        {
            return redirect('billing');
        }

        return $next($request);
    }
}
