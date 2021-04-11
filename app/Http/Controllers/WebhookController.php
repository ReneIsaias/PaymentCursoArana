<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleInvoicePaymentSucceeded($payload)
    {
        // Handle the incoming event...
    }

    /*

    En este controlador vamos a crear los metodos que de acuerdo los eventos que agregamos en el webhook de stripe
    se va a crear uno por cada evento agregado.

    Como agregamos uno para qeu cada que se agregue una subscripción es el siguiente:
    customer.subscription.created

    Ahora veremos como debería funcionar
    */

    public function customerSubscriptionCreated()
    {
        /* Enviar correo electronico */
    }
}
