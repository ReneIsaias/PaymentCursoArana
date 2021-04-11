<div class="w-full">

    {{-- validamos si tiene agregado un metodo de pago --}}
    @if (auth()->user()->hasDefaultPaymentMethod())

        {{-- Validamos si el usuario ya esta suscrito a un plan --}}
        @if (auth()->user()->subscribed($name))

            {{-- Ahora preguntamos que precio y plan tiene el usuario --}}
            @if (auth()->user()->subscribedToPlan($price, $name))

                {{-- Validamos si el usuario esta en periodo de gracia --}}
                @if (auth()->user()->subscription($name)->onGracePeriod())

                    <div>
                        {{-- Este boton aparecera cuando el usuario ya haya cancelado una suscripción y este en periodo de gracia --}}
                        <button
                            {{-- Con este evento hacemos que se cambie el plan que se haya seleccionado --}}
                            wire:click="resuminSubscription"
                            {{-- Es para que se oculte mientras esta cargando o trabajando en el metodo de aquí arriba --}}
                            wire:loading.attr='disabled'
                            {{-- Solo hara cuando se active este metodo con los unicos datos que se le pasan, es decir para cada nombre y precio --}}
                            wire:target="resuminSubscription"
                            class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                            <x-spinner wire:loading wire:target="resuminSubscription" size="6" class="mr-2"/>
                            Reanudar plan
                        </button>
                    </div>

                @else

                    <article>
                        {{-- Este boton aparecera cuando el usuario ya haya hecho una subscripción pero no sea el plan que eligio --}}
                        <button
                            {{-- Con este evento hacemos que se cambie el plan que se haya seleccionado --}}
                            wire:click="cancellingSubscription"
                            {{-- Es para que se oculte mientras esta cargando o trabajando en el metodo de aquí arriba --}}
                            wire:loading.attr='disabled'
                            {{-- Solo hara cuando se active este metodo con los unicos datos que se le pasan, es decir para cada nombre y precio --}}
                            wire:target="cancellingSubscription"
                            class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                            <x-spinner wire:loading wire:target="cancellingSubscription" size="6" class="mr-2"/>
                            Cancelar plan
                        </button>
                    </article>

                @endif

            @else

                {{-- Este boton aparecera cuando el usuario ya haya hecho una subscripción pero no sea el plan que eligio --}}
                <button
                    {{-- Con este evento hacemos que se cambie el plan que se haya seleccionado --}}
                    wire:click="changingPlans"
                    {{-- Es para que se oculte mientras esta cargando o trabajando en el metodo de aquí arriba --}}
                    wire:loading.attr='disabled'
                    {{-- Solo hara cuando se active este metodo con los unicos datos que se le pasan, es decir para cada nombre y precio --}}
                    wire:target="changingPlans"
                    class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                    <x-spinner wire:loading wire:target="changingPlans" size="6" class="mr-2"/>
                    Cambiar de plan
                </button>

            @endif

        @else

                <input type="text" wire:model="coupon" class="form-control mb-3" placeholder="Ingrese un cupon ...">
            {{-- Al precionar el boton, se activa el método y le pasamos esos dos parametros--}}
            <a wire:click="newSubscription"
                {{-- Es para que se oculte mientras esta cargando o trabajando en el metodo de aquí arriba --}}
                wire:loading.attr='disabled'
                {{-- Solo hara cuando se active este metodo con los unicos datos que se le pasan, es decir para cada nombre y precio --}}
                wire:target="newSubscription"
                class="cursor-pointer font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
                <x-spinner wire:loading wire:target="newSubscription" size="6" class="mr-2"/>
                Suscribirse
            </a>

        @endif

    @else

        {{-- Este boton aparecera cuando el usuario no ya haya agrgago un metodo de pago --}}
        <button
            class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
            Agregar método de pago
        </button>

    @endif

</div>
