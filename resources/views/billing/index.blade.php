<x-app-layout>
    {{-- Vista de donde estan los metodos de pago --}}
    <div class="pb-12">

        {{-- Componente que rederiza las subscripciones --}}
        {{-- @livewire('subscriptions') --}}

        <div class="w-full mx-auto px-5 py-10 text-gray-600 mb-10">
            <div class="text-center max-w-xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold mb-5">Pricing</h1>
                <h3 class="text-xl font-medium mb-10">Lorem ipsum dolor sit amet consectetur adipisicing elit repellat dignissimos laboriosam odit accusamus porro</h3>
            </div>
            <div class="max-w-4xl mx-auto md:flex">
                {{-- Plan mensual --}}
                <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:my-6 rounded-md shadow-lg shadow-gray-600 md:flex md:flex-col">
                    <div class="w-full flex-grow">
                        <h2 class="text-center font-bold uppercase mb-4">PLAN MENSUAL</h2>
                        <h3 class="text-center font-bold text-4xl mb-5">$9.99</h3>
                        <ul class="text-sm px-5 mb-8">
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                        </ul>
                    </div>
                    {{-- Mandomos llamar al compoenete que tiene los botones --}}
                    @livewire('subscriptions', ['price' => 'price_1IeYA9Ap3Kj6tMheth3725Ot'], key('price_1IeYA9Ap3Kj6tMheth3725Ot'))
                    {{-- <x-button-subscription name="Curso pasarela de pagos" price="price_1IeYA9Ap3Kj6tMheth3725Ot" /> --}}
                </div>
                {{-- Plan trimestral --}}
                <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:-mx-3 md:mb-0 rounded-md shadow-lg shadow-gray-600 md:relative md:z-50 md:flex md:flex-col">
                    <div class="w-full flex-grow">
                        <h2 class="text-center font-bold uppercase mb-4">PLAN TRIMESTRAL</h2>
                        <h3 class="text-center font-bold text-4xl md:text-5xl mb-5">$19.99</h3>
                        <ul class="text-sm px-5 mb-8">
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Consectetur</li>
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Adipisicing</li>
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Elit repellat</li>
                        </ul>
                    </div>
                    @livewire('subscriptions', ['price' => 'price_1IeYA9Ap3Kj6tMheA6GX9eW2'], key('price_1IeYA9Ap3Kj6tMheA6GX9eW2'))
                    {{-- <x-button-subscription name="Curso pasarela de pagos" price="price_1IeYA9Ap3Kj6tMheA6GX9eW2" /> --}}
                </div>
                {{-- Plan anual --}}
                <div class="w-full md:w-1/3 md:max-w-none bg-white px-8 md:px-10 py-8 md:py-10 mb-3 mx-auto md:my-6 rounded-md shadow-lg shadow-gray-600 md:flex md:flex-col">
                    <div class="w-full flex-grow">
                        <h2 class="text-center font-bold uppercase mb-4">PLAN ANUAL</h2>
                        <h3 class="text-center font-bold text-4xl mb-5">$89.99</h3>
                        <ul class="text-sm px-5 mb-8">
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Lorem ipsum</li>
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Dolor sit amet</li>
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Consectetur</li>
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Adipisicing</li>
                            <li class="leading-tight"><i class="mdi mdi-check-bold text-lg"></i> Much more...</li>
                        </ul>
                    </div>
                    @livewire('subscriptions', ['price' => 'price_1IeYA9Ap3Kj6tMheZlNEMWaq'], key('price_1IeYA9Ap3Kj6tMheZlNEMWaq'))
                    {{-- <x-button-subscription name="Curso pasarela de pagos" price="price_1IeYA9Ap3Kj6tMheZlNEMWaq" /> --}}
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Componente que renderiza el componente para agregar un metodo de pago --}}
            @livewire('payment-method-create')

            <div class="my-8">
                {{-- Compoenete que muestra la lista de los pagos agreagados   --}}
                @livewire('payment-method-list')
            </div>

            {{-- Componente para emitir las facturas de un cliente --}}
            @livewire('invoices')

        </div>

    </div>

</x-app-layout>
