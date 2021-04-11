<?php

namespace App\Http\Livewire;

use Livewire\Component;

/* Nos va a permitir cachar el error en caso de que no tenga fondos una tarjeta */
use Laravel\Cashier\Exceptions\IncompletePayment;

class Subscriptions extends Component
{
    /* Escuchamos un evento emitido por el compoente de methodCreate y asignamo que se ejecute el método render */
    protected $listeners = ['render'];

    public $price;

    public $name = 'Curso pasarela de pagos';

    public $coupon;

    public function mount($price)
    {
        $this->price = $price;
    }

    public function render()
    {
        return view('livewire.subscriptions');
    }

    /* Funcion para agregar una nueva suscripción */
    public function newSubscription()
    {

        /* Cachamos un error en caso de que la tarjeta no tenga fondos */
        try {

            if($this->coupon)
            {
                /* Creamos la subscripciòn con un cupon */
                auth()->user()->newSubscription($this->name, $this->price)
                                ->withCoupon($this->coupon)
                                /* Este metodo es para dar dias de prueba */
                                /* ->trialDays(7) */
                                /* Creamos la nueva subscripción */
                                ->create();
            }else {
                /* Creamos la subscripciòn  con un periodo de prueba*/
                auth()->user()->newSubscription($this->name, $this->price)
                                /* Este metodo es para dar dias de prueba */
                                /* ->trialDays(7) */
                                /* Creamos la nueva subscripción */
                                ->create();
            }

            /* Emitimos un evento para los registos de las facturas */
            $this->emitTo('invoices', 'render');

            /* Emitimos un evento para este componente para que los botones se actualizen*/
            $this->emitTo('subscriptions', 'render');

        } catch (IncompletePayment $exception) {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('billing.index')]
            );
        }

    }

    /* Esta funcion nos permite cambiar de plan */
    public function changingPlans()
    {
        auth()->user()->subscription($this->name)->swap($this->price);

        /* Emitimos un evento para los registos de las facturas */
        $this->emitTo('invoices', 'render');

        /* Emitimos un evento para este componente para que los botones se actualizen*/
        $this->emitTo('subscriptions', 'render');
    }

    /* Funcion para cancelar una suscripción */
    public function cancellingSubscription()
    {
        auth()->user()->subscription($this->name)->cancel();

        /* Emitimos un evento para este componente para que los botones se actualizen*/
        $this->emitTo('subscriptions', 'render');
    }

    /* Funcion para reanudar una subscripcion */
    public function resuminSubscription()
    {
        auth()->user()->subscription($this->name)->resume();

        /* Emitimos un evento para este componente para que los botones se actualizen*/
        $this->emitTo('subscriptions', 'render');
    }
}
