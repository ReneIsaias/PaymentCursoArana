<div>
    <div class="card relative">

        <div wire:loading.flex class="absolute w-full h-full bg-gray-100 bg-opacity-25 z-30 items-center justify-center">
            <x-spinner size="20" />
        </div>

        <div class="card-body">

            <div class="flex justify-between items-center mb-4">
                <h1 class="text-lg font-bold text-gray-700">Método de pago</h1>
                <img class="h-8" src="http://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" alt="metodos pago">
            </div>

            <form id="card-form" action="">

                <div class="form-group">
                    <label class="form-label">Nombre de la tarjeta</label>
                    <input class="form-control" id="card-holder-name" type="text" placeholder="Ingrese el nombre del titular de la tarjeta" required>
                </div>

                <!-- Stripe Elements Placeholder -->
                <div class="form-group">
                    <label class="form-label" >Numero de tarjeta</label>
                    <div class="form-control" id="card-element"></div>
                    <span class="invalid-feedback" id="card-error"></span>
                </div>

                <button class="btn btn-primary" id="card-button">
                    Process Payment
                </button>

            </form>
        </div>
    </div>

    @slot('js')

        <script>

            document.addEventListener('livewire:load', function(){
                stripe();
            })

            Livewire.on('resetStripe', function(){
                /* Función para resetear los campos del formulario */
                document.getElementById('card-form').reset();

                stripe();

                alert('La compra se realizo con exito');
            })


            Livewire.on('errorPayment', function(){
                /* Funcion para validar si hay un posible error en la compra */
                document.getElementById('card-form').reset();

                stripe();

                alert('Hubo un error en la compra, intentelo de nuevo');
            })
        </script>

        <script>
            /* Funcion que ejecuta todo los scripts para hacer el pago */
            function stripe(){
                const stripe = Stripe("{{env('STRIPE_KEY')}}");

                const elements = stripe.elements();
                const cardElement = elements.create('card');


                cardElement.mount('#card-element');

                /* Método de pago unico */
                const cardHolderName = document.getElementById('card-holder-name');
                const cardButton = document.getElementById('card-button');
                const cardForm = document.getElementById('card-form');

                cardForm.addEventListener('submit', async (e) => {

                    e.preventDefault();

                    const { paymentMethod, error } = await stripe.createPaymentMethod(
                        'card', cardElement, {
                            billing_details: { name: cardHolderName.value }
                        }
                    );

                    if (error) {
                        document.getElementById('card-error').textContent = error.message;
                    } else {
                        Livewire.emit('paymentMethodCreate', paymentMethod.id);
                    }
                });
            }
        </script>

    @endslot
</div>
