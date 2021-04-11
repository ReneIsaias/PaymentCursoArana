<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

use Exception;

class ProductPay extends Component
{
    protected $listeners = ['paymentMethodCreate'];

    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.product-pay');
    }

    /* Funcion para hacer un pago unico */
    public function paymentMethodCreate($paymentMethodCreate)
    {
        try {
            /* Se hace el pago */
            auth()->user()->charge($this->product->price * 100, $paymentMethodCreate);

            /* Emitimos un evento para notificar al usuario */
            $this->emit('resetStripe');

        } catch (\Throwable $th) {
            //Cachamos en caso de que haya un error
            $this->emit('errorPayment');
        }

    }
}
