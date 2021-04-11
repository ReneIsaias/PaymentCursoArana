<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        /* Esto nos va a permitir que la conexión entre stripe y mi aplicación se comunique correctamente, aunque eso sí, debe de estar ya en producción */
        /* 'stripe/*' */
    ];
}
