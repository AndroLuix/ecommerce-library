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
                       
                   
                        <img src="{{asset($order->product->image)}}" alt=""
                            style="width: 100px; height: 130px" class="rounded" />
                        <div class="ms-5">
                            <p class="fw-bold mb-1"></p>
                            <h3 class="text-muted mb-0">{{$order->product->title}}</h3>
                            <h5 class="text-muted mb-0">{{$order->product->author}}</h5>
                           
                            <p class="text-muted mb-0">{{$order->product->category->name}}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{$order->product->description}}</p>
                   
                </td>
                <td>
                  {{$order->status}}
                </td>
                <td class="">
                    <p class="ms-4">Prezzo: {{$order->product->price}} €</p>
                    <p class="ms-2"><i class="fa fa-minus mypointer p-1"></i> Quantità: {{$order->quantity}} <i class="fa fa-plus mypointer p-1"></i></p>
                </td>
                
                <td>
                    <button type="button" onclick="return confirm('Sicuro di voler eliminare il prodotto {{$order->product->title}} ?')" class="btn btn-link btn-sm btn-rounded">
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
 
    <button class="btn btn-secondary p-3">Totale{{$totalPrice}} €</button>
</div>
