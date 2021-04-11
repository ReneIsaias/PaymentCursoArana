@props(['name', 'price'])

<div class="w-full">

    {{-- validamos si tiene agregado un metodo de pago --}}
    @if (auth()->user()->hasDefaultPaymentMethod())

        {{-- Validamos si el usuario ya esta suscrito a un plan --}}
        @if (auth()->user()->subscribed($name))

            {{-- Ahora preguntamos que precio y plan tiene el usuario --}}
            @if (auth()->user()->subscribedToPlan($price, $name))

                {{-- Validamos si el usuario esta en periodo de gracia --}}
                @if (auth()->user()->subscription($name)->onGracePeriod())

                    {{-- Este boton aparecera cuando el usuario ya haya cancelado una suscripción y este en periodo de gracia --}}
                    <button
                        {{-- Con este evento hacemos que se cambie el plan que se haya seleccionado --}}
                        wire:click="resuminSubscription('{{$name}}')"
                        {{-- Es para que se oculte mientras esta cargando o trabajando en el metodo --}}
                        wire:loading.remove
                        {{-- Solo hara cuando se active este metodo con los unicos datos que se le pasan, es decir para cada nombre y precio --}}
                        wire:target="resuminSubscription('{{$name}}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        Reanudar
                    </button>

                    {{-- Este boton aparecera cuando el metodo de arriba se active --}}
                    <button wire:loading.flex
                        {{-- Y solo aparecera cuando los datos que se le pasan, sean los mismos, es decir para cada forma de pago --}}
                        wire:target="resuminSubscription('{{$name}}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        <x-spinner size="6" class="mr-2"/>
                        Reanudar
                    </button>

                @else

                    {{-- Este boton aparecera cuando el usuario ya haya hecho una subscripción pero no sea el plan que eligio --}}
                    <button
                        {{-- Con este evento hacemos que se cambie el plan que se haya seleccionado --}}
                        wire:click="cancellingSubscription('{{$name}}')"
                        {{-- Es para que se oculte mientras esta cargando o trabajando en el metodo --}}
                        wire:loading.remove
                        {{-- Solo hara cuando se active este metodo con los unicos datos que se le pasan, es decir para cada nombre y precio --}}
                        wire:target="cancellingSubscription('{{$name}}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        Cancelar
                    </button>

                    {{-- Este boton aparecera cuando el metodo de arriba se active --}}
                    <button wire:loading.flex
                        {{-- Y solo aparecera cuando los datos que se le pasan, sean los mismos, es decir para cada forma de pago --}}
                        wire:target="cancellingSubscription('{{$name}}')"
                        class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                        <x-spinner size="6" class="mr-2"/>
                        Cancelar
                    </button>

                @endif

            @else

                {{-- Este boton aparecera cuando el usuario ya haya hecho una subscripción pero no sea el plan que eligio --}}
                <button
                    {{-- Con este evento hacemos que se cambie el plan que se haya seleccionado --}}
                    wire:click="changingPlans('{{$name}}', '{{$price}}')"
                    {{-- Es para que se oculte mientras esta cargando o trabajando en el metodo --}}
                    wire:loading.remove
                    {{-- Solo hara cuando se active este metodo con los unicos datos que se le pasan, es decir para cada nombre y precio --}}
                    wire:target="changingPlans('{{$name}}', '{{$price}}')"
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    Cambiar de plan
                </button>

                {{-- Este boton aparecera cuando el metodo de arriba se active --}}
                <button wire:loading.flex
                    {{-- Y solo aparecera cuando los datos que se le pasan, sean los mismos, es decir para cada forma de pago --}}
                    wire:target="changingPlans('{{$name}}', '{{$price}}')"
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    <x-spinner size="6" class="mr-2"/>
                    Cambiar de plan
                </button>

            @endif

        @else

            {{-- Al precionar el boton, se activa el método y le pasamos esos dos parametros--}}
            <button wire:click="newSubscription('{{$name}}', '{{$price}}')"
                {{-- Es para que se oculte mientras esta cargando o trabajando en el metodo --}}
                wire:loading.remove
                {{-- Solo hara cuando se active este metodo con los unicos datos que se le pasan, es decir para cada nombre y precio --}}
                wire:target="newSubscription('{{$name}}', '{{$price}}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
                Suscribirse
            </button>

            {{-- Este boton aparecera cuando el metodo de arriba se active --}}
            <button wire:loading.flex
                {{-- Y solo aparecera cuando los datos que se le pasan, sean los mismos, es decir para cada forma de pago --}}
                wire:target="newSubscription('{{$name}}', '{{$price}}')"
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                <x-spinner size="6" class="mr-2"/>
                Suscribirse
            </button>

        @endif

    @else

        {{-- Este boton aparecera cuando el usuario no ya haya agrgago un metodo de pago --}}
        <button
            class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
            Agregar método de pago
        </button>

    @endif

</div>
