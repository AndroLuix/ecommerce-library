<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container p-4 m-4 ">
      <img class="ax-center my-10 w-24" src="" />
      <div class="card p-6 p-lg-10 space-y-4 p-3">
        <h1 class="h3 fw-700">
         Ciao, {{$costumer->name}}. Vogliamo informarti che  il tuo ordine {{$order->product->title}} è andato a buon fine.
        </h1>

        <h5>ID Transazione: </h5> 
        <strong>{{$order->payment->transaction_id}}</strong>
        <p>
          Il tuo ordine dovrebbe arrivare entro 10 giorni lavorativi, il tuo importo di 
          {{$order->payment->amount}} &euro; 
        </p>
        <div class="card">
          <div class="card-header">Dettaglio Ordine</div>
          <img class="card-img-top" src="{{asset($order->product->image)}}" alt="{{$order->product->title}}">

          <div class="card-text p-4">
            <p>Nome: {{$order->product->title}}</p>
            <p>Autore: {{$order->product->author}}</p>
            @isset($order->product->discount)
            <p>Sconto Applicato: {{ $order->product->discount->name }} <span style="color: green">{{ $order->product->discount->percent }} %</span></p>
        @endisset
            <p>Quantità ordinate: {{$order->quantity}}</p>
            <?php 
            $total =  $order->product->price * $order->quantity;
            if(isset($order->product->discount)){
             $total = $total * (1 - $order->product->discount->percent / 100);
             $total = round($total,2);

            }
           ?>
          
             
            
             
            <p>Totale: {{$total}} &euro;</p>
            <p><i>Prezzo singolo prodotto: {{$order->product->price}} &euro;</i></p>


          </div>
        </div>
        <a class="btn btn-primary p-3 fw-700" href="{{route('welcome')}}">Visit Website</a>
      </div>
      <img class="ax-center mt-10 w-20 object-fit-scale border rounded" width="100%" height="100%"
      src="https://cdn.pixabay.com/photo/2019/04/26/07/14/store-4156934_1280.png">
      <div class="text-muted text-center my-6">
        Sent with Laravel. <br>
        Questa è un mail generata automaticamente<br>
        Non rispondere a questa mail.<br>
      </div>
    </div>
  </body>

</html>
