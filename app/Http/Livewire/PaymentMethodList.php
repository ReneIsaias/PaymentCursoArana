<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PaymentMethodList extends Component
{
    /* Escuchamos un evento emitido por el compoenete que hace pagos y asignamo que se ejecute el método o que carge de nuevo el componente */
    protected $listeners = ['render' => 'render'];

    public function render()
    {

        $paymentMethods = auth()->user()->paymentMethods();

        return view('livewire.payment-method-list', compact('paymentMethods'));
    }

    /* Metodo que nos permite eliminar un metod de pago */
    public function deletePaymentMethod($paymentMethodId)
    {
        $paymentMethod = auth()->user()->findPaymentMethod($paymentMethodId);

        $paymentMethod->delete();
    }

    /* Este metodo nos permite elegir un metodo de pago determinado, es decir que se elige entre todos los metodos de pago que se tiene */
    public function defaultPaymentMethod($paymentMethodId)
    {
        auth()->user()->updateDefaultPaymentMethod($paymentMethodId);
    }
}
