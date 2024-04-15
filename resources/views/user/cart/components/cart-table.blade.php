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
                    <p class="ms-4">Prezzo: <span class="priceSingleProduc"
                            id="totalAmount{{ $order->id }}">{{ $order->TotalPrice }}</span> €</p>

                    <p class="ms-2"><i title="Rimuovi 1"
                            onclick="minusCard('{{ $order->id }}', '{{ route('carrello.minus', $order->id) }}')"
                            class="fa fa-minus mypointer p-1" style="font-size: 30px">
                        </i>

                        <i title="Aggiungi"
                            onclick="plusCard('{{ $order->id }}', '{{ route('carrello.plus', $order->id) }}')"
                            class="fa fa-plus mypointer p-1" style="font-size: 30px">
                        </i>
                    </p>

                    <p class="ms-2"> Quantità: <span
                            id="quantityItem{{ $order->id }}">{{ $order->quantity }}</span></p>
                </td>

                <td>
                    <form action="{{ route('book.destroy', $order->id)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="sumbit"
                            onclick="return confirm('Sicuro di voler eliminare il prodotto {{ $order->product->title }} ?')"
                            class="btn btn-link btn-sm btn-rounded">
                            Romuovi
                        </button>
                    </form>
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
<div class="text-end py-2 px-5 ">

    <i class="p-3"><i><strong>Totale:</strong></i> <span id="total">{{ $totalPrice }}</span> €</i>
<form action="{{route('user.payment')}}" method="POST">
    @csrf
    @foreach ( $cart as $order)
    <input type="number" hidden name="TotalPrice[]" value="{{$order->id}}" id="">
    @endforeach
    
    <button type="submit"  class="btn btn-primary">Procedi All'Ordine</button>
</form>
  
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

    function updateTotalPrice() {
        // Inizializza la variabile per il totale
        let totalPrice = 0;

        // Itera su tutti gli elementi con la classe priceSingleProduc
        $('.priceSingleProduc').each(function() {
            // Ottieni il valore testuale dell'elemento e convertilo in un numero
            let price = parseFloat($(this).text());

            // Aggiungi il prezzo corrente al totale
            totalPrice += price;
        });

        // Aggiorna il totale nel tuo elemento HTML
        $('#total').text(totalPrice.toFixed(2));
    }

    function loadCartData(itemId) {
        $.ajax({
            url: '/carrello/getdata/' +
                itemId, // Sostituisci con l'URL corretto per ottenere i dati del carrello
            method: 'GET',
            success: function(response) {
                // Aggiorna la tabella del carrello con i dati ottenuti dalla risposta JSON
                //console.log(response.quantity)
                $('#quantityItem' + itemId).text(response.quantity);
                // Aggiorna il prezzo  con il valore ottenuto dalla risposta JSON
                $('#totalAmount' + itemId).text(response.totalPrice);

                // aggiorna il prezzo totale del carrello
                updateTotalPrice();



            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
