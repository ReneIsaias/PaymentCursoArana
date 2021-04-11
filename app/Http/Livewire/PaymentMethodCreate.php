<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PaymentMethodCreate extends Component
{

    /* Escuchamos un evento emitido por el frotn y asignamo que se ejecute el método */
    protected $listeners = ['paymentMethodCreate' => 'paymentMethodCreate'];


    public function render()
    {
        /* Emitimos un evento para el front */
        $this->emit('resetStripe');

        return view('livewire.payment-method-create', [
            'intent' => auth()->user()->createSetupIntent(),
        ]);
    }

    /* Se encarga de agrear un nuevo metodo de pago */
    public function paymentMethodCreate($paymentMethod)
    {
        if(auth()->user()->hasPaymentMethod())
        {
            auth()->user()->addPaymentMethod($paymentMethod);
        }
        else
        {
            auth()->user()->updateDefaultPaymentMethod($paymentMethod);
        }

        /* Emitimos este evento para que lo escuche el compoente PaymentMethodList donde muestra las metodos de pago */
        $this->emitTo('payment-method-list', 'render');

        /* Emite otro evento para el compoenete de subscription, para que renderize las metodos de pago */
        $this->emitTo('subscriptions', 'render');
    }
}
