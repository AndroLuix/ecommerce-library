<?php

?>
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
                    <th style="min-width: 200px;">Libro </th>
                    <th style="min-width: 300px;">Dettaglio Ordine</th>
                    <th>Dati Utente</th>
                    <th>Opzioni</th>
                </tr>
            </thead>

            <tbody>
                <!-- inizio lista cards -->
                @foreach ($orders as $order)
                    <tr class="cardbook">
                        <!-- dettaglio articolo -->
                        <td>
                            <h5> {{ $order->product->title }}</h5>
                            <p>{{ $order->product->author }}</p>
                            <div>
                                <img width="150" height="150"
                                    class="card-img-left example-card-img-responsive p-2 rounded shadow object-fit-scale border rounded"
                                    style="width: 150px" height="" src="{{ asset($order->product->image) }}" />

                                <h2> {{ $order->product->price }} &euro;</h2>
                                <p> Quantità in magazzino: <strong>{{ $order->product->quantity }}</strong></p>

                            </div>
                        </td>
                        <!-- dettagli ordone -->
                        <td>
                            <div class="border p-3 rounded shadow-sm">

                                <p><strong>Ordine creato il:</strong> {{ $order->payment->created_at }}</p>
                                <p><strong>Quantità richiesta:</strong> {{ $order->quantity }}</p>

                                @if (isset($order->product->discount))
                                    <p><strong>Sconto:</strong>
                                        <span style="color:green">{{ $order->product->discount->percent }}%</span>
                                    </p>
                                    @php
                                        $sconto = ($order->TotalPrice / 100) * $order->product->discount->percent;
                                        $totaleConSconto = round($order->TotalPrice - $sconto, 2);
                                    @endphp
                                    <h5><strong>Totale con sconto:</strong> {{ $totaleConSconto }} &euro;</h5>
                                    <del>
                                        <p><strong>Totale originale:</strong> {{ $order->TotalPrice }} &euro;</p>
                                    </del>
                                @else
                                    <h4><strong>Totale:</strong> {{ $order->TotalPrice }} &euro;</h4>
                                @endif
                                <h4 class="mt-5"> Metodo: {{ $order->payment->mark ? 'Contrassegno' : 'Carta' }}</h4>

                            </div>
                        </td>

                        <!-- dettaglio utente -->
                        <td>
                            <div class="border p-3 rounded shadow-sm">
                                <strong>Nome:</strong> {{ $order->user->name }} <br>
                                <div class="d-flex flex-row mt-2">
                                    <div><strong>Paese:</strong> {{ $order->address->country }}</div>
                                    <div class="mx-3"><strong>Città:</strong> {{ $order->address->city }}</div>
                                </div>
                                <div>
                                    <strong>Codice Postale:</strong> {{ $order->address->postal_code }} <br>
                                    <strong>Indirizzo:</strong> {{ $order->address->user_address }} <br>
                                </div>
                                <hr>
                                <div class="d-flex flex-column mt-2">
                                    <h6>Contatti</h6>
                                    <small>Email: <a
                                            href="mailto:{{ $order->user->email }}?subject=
                                        Messaggio per l'ordine {{ $order->product->name }} creato 
                                        il {{ $order->created_at }}">{{ $order->user->email }}</a></small>
                                    <small>Fisso:
                                        <a href="tel:{{ $order->address->telephone }}">
                                            {{ $order->address->telephone }}</a>
                                    </small> <br>
                                    <small>Mobile:
                                        <a href="tel:{{ $order->address->mobile }}">
                                            {{ $order->address->mobile }}
                                        </a>
                                    </small>


                                </div>
                            </div>
                        </td>

                        <!-- opzioni -->
                        <td style="width: 400px;">
                            <div
                                class="flex-grap gap-5 mb-5 justify-content-center m-2 p-2 
                            rounded">

                                @if ($order->payment->confirmed == true)
                                    <div class="card">
                                        <div class="card-header">Ordine Inviato</div>
                                        <a class="btn btn-warning m-3"
                                            href="{{ route('admin.order.back', $order) }}">Annulla Ordine</a>

                                    </div>
                                @else
                                    <div class="card">
                                        <div class="card-header">Ordine in attesa</div>
                                        <a class="btn btn-primary m-3"
                                            href="{{ route('admin.order.send', $order) }}">Invia Ordine</a>

                                        <form  action="{{ route('admin.order.delete', $order) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger m-3" 
                                            onclick="return confirm('Sei sicuro di eliminare l\'ordine di {{ $order->user->name }}?. Questo comporterà la totale cancellazione dell\'ordine e sarà inviato l\'eventuale rimborso')">
                                             Rifiuta l'ordine
                                            </button>
                                        </form>
                                    </div>
                                @endif




                            </div>
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
