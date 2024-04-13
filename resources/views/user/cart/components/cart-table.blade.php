<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
            <th>Nome</th>
            <th>Descrizione</th>
            <th>Status</th>
            <th>Prezzo e Quantità</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalPrice = 0;
        @endphp
        @foreach ($cart as $order)
            <tr>
                <td>
                    <div class="d-flex align-items-center">


                        <img src="{{ asset($order->product->image) }}" alt="" style="width: 100px; height: 130px"
                            class="rounded" />
                        <div class="ms-5">
                            <p class="fw-bold mb-1"></p>
                            <h3 class="text-muted mb-0">{{ $order->product->title }}</h3>
                            <h5 class="text-muted mb-0">{{ $order->product->author }}</h5>

                            <p class="text-muted mb-0">{{ $order->product->category->name }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{ $order->product->description }}</p>

                </td>
                <td>
                    {{ $order->status }}
                </td>
                <td class="">
                    <p class="ms-4">Prezzo: {{ $order->product->price }} €</p>

                    <p class="ms-2"><i
                            onclick="minusCard('{{ $order->id }}', '{{ route('carrello.minus', $order->id) }}')"
                            class="fa fa-minus mypointer p-1">
                        </i>
                        Quantità: {{ $order->quantity }}
                        <i onclick="plusCard('{{ $order->id }}', '{{ route('carrello.plus', $order->id) }}')"
                            class="fa fa-plus mypointer p-1">
                        </i>
                    </p>
                </td>

                <td>
                    <button type="button"
                        onclick="return confirm('Sicuro di voler eliminare il prodotto {{ $order->product->title }} ?')"
                        class="btn btn-link btn-sm btn-rounded">
                        Elimina
                    </button>
                </td>
            </tr>
            @php

                // Calcola il prezzo totale per questo ordine e aggiungilo al totale complessivo
                $orderTotalPrice = $order->product->price * $order->quantity;
                $totalPrice += $orderTotalPrice;
            @endphp
        @endforeach

    </tbody>
</table>
<div class="text-end py-2 px-3">

    <button class="btn btn-secondary p-3"><i><strong>Totale:</strong></i> {{ $totalPrice }} €</button>
</div>


<script>
    // Funzione per aggiungere una quantità all'elemento nel carrello
    function plusCard(itemId, url) {
        // Esegui la chiamata AJAX per aumentare la quantità dell'elemento nel carrello
        $.ajax({
            url: url,
            method: 'POST',
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            data: {
                itemId: itemId
            },
            success: function(response) {
                // Ricarica i dati del carrello dopo l'aggiunta della quantità
                loadCartData(itemId);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Funzione per sottrarre una quantità all'elemento nel carrello
    function minusCard(itemId, url) {
        // Esegui la chiamata AJAX per diminuire la quantità dell'elemento nel carrello
        $.ajax({
            url: url,
            method: 'POST',
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            data: {
                itemId: itemId
            },
            success: function(response) {
                // Ricarica i dati del carrello dopo la sottrazione della quantità
                loadCartData(itemId);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function loadCartData(itemId) {
    $.ajax({
        url: '/carrello/getdata/'+itemId, // Sostituisci con l'URL corretto per ottenere i dati del carrello
        method: 'GET',
        success: function(response) {
            // Aggiorna la tabella del carrello con i dati ottenuti dalla risposta JSON
            $('#cartTable tbody').html(response.cartItems);
            // Aggiorna il totale con il valore ottenuto dalla risposta JSON
            $('#totalAmount').text(response.totalPrice);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

</script>
