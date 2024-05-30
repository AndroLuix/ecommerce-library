<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container p-5 m-5">
        <img class="ax-center my-10 w-24" src="" />
        <div class="card p-6 p-lg-10 space-y-4 p-3">
            <h1 class="h3 fw-700">
                Ciao, {{ $costumer->name }}. Ci dispiace informarti che purtroppo il tuo ordine
                << {{ $order->product->title }} >> è stato rifiutato.
            </h1>
            <h5>ID Transazione: </h5> 
            <strong>{{$order->payment->transaction_id}}</strong>

            <div class="card">
                <div class="card-header">Dettaglio Ordine</div>
               <a href="">
                <img class="card-img-top object-fit-scale border rounded" width="100%" height="300px" src="{{ asset($order->product->image) }}" alt="{{ $order->product->title }}">
             

                <div class="card-text p-4">
                    <p>Nome: {{ $order->product->title }}</p>
                    <p>Autore: {{ $order->product->author }}</p>
                    <?php 
                    $total =  $order->product->price * $order->quantity;
                    if(isset($order->product->discount)){
                     $total = $total * (1 - $order->product->discount->percent / 100);
                     $total = round($total,2);
       
                    }
                   ?>
                 
                    <p>Quantità ordinate: {{ $order->quantity }}</p>
                    <p>Totale: {{$total}} &euro;</p>
                    <p><i>Prezzo singolo prodotto: {{ $order->product->price }} &euro;</i></p>

                </div>
              </a>
            </div>
            @if($order->mark == 1)
            
            <p class="p-5">
                Spero che questo non ti crei disagio, il tuo importo di {{ $total }} &euro;
                verrà rimborsato sulla
                carta di credito selezionata per quest'ordine. <br>
                <strong>Il tuo rimborso è stato inviato, verrà elaborato entro 15 giorni lavorativi</strong>

               
              </p>
              @endif
            <a class="btn btn-primary p-3 fw-700" href="{{ route('welcome') }}">Visit Website</a>
        </div>
        <img width="100%" height="100%" class="ax-center mt-10 w-20 object-fit-scale border rounded"
            src="https://cdn.pixabay.com/photo/2019/04/26/07/14/store-4156934_1280.png" />

        <div class="text-muted text-center my-6">
            Sent with <3 Laravel Mail. <br>
                Questa è un mail generata automaticamente<br>
                Non rispondere a questa mail.<br>
        </div>
    </div>
</body>

</html>
