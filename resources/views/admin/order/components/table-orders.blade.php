<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped" align="center">
            <thead>
                <tr>
                    <th>Libro</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <!-- inizio lista cards -->
                @foreach ($orders as $order)
                    <tr class="cardbook">
                        <td>
                            <h5> {{ $order->product->title }}</h5>
                            <p>{{ $order->product->author }}</p>
                            <div>
                                <img width="150" height="150"
                                    class="card-img-left example-card-img-responsive p-2 rounded shadow object-fit-scale border rounded"
                                    style="width: 150px" height="" src="{{ asset($order->product->image) }}" />

                            </div>
                        </td>
                        <td>
                           <p> Quantità in magazzino: <strong>{{$order->product->quantity}}</strong></p>
                        </td>
                        <td>
                            <p>Quantità richiesta <strong>{{$order->quantity}}</strong></p>
                            @isset($order->product->discount->percent)
                            <p>Sconto applicato <span style="color:green"><strong>{{$order->product->discount->percent}} %</strong></span></p>

                            @endisset
                        </td>
                        <td>
                            Dati Utente:
                            <p>Utente: {{$order->user->name}}</p>

                            <p> Paese: {{$order->address->country}}</p>
                            <p> Città: {{$order->address->city}}</p>
                            <p> Codice Postale: {{$order->address->postal_code}}</p>
                            <p> Indirizzo: {{$order->address->user_address}}</p>
                            <p> Fisso: {{$order->address->telephone}}</p>
                            <p> Mobile: {{$order->address->mobile}}</p>
                        </td>






                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    function sortTable(columnIndex) {

        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.querySelector(".table");
        switching = true;

        while (switching) {
            switching = false;
            rows = table.rows;

            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;

                x = rows[i].getElementsByTagName("td")[columnIndex];
                y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }

            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
</script>
