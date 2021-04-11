<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Invoices extends Component
{

    /* Escuchamos un evento emitido por el compoente de subscriptions y asignamo que se ejecute el método render */
    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $invoices = auth()->user()->invoices();

        return view('livewire.invoices', compact('invoices'));
    }
}
