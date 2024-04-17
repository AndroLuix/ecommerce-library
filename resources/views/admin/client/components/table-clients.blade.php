<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <table class="table" align="center">
        <thead>
            <tr>
                <th>Profili</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <!-- inizio lista cards -->
            @foreach ($clients as $client)
                <tr class="cardbook">
                    <td>
                        <img class="card-img-left example-card-img-responsive p-2 rounded shadow" style="width: 80px"
                            height="" src="{{ asset($client->image) }}" />
                    </td>
                    <td>
                       <strong> {{ $client->name }}</strong> <br>
                        Indirizzo: <i>{{ $client->address }}</i>
                    </td>
                  
                    <td></td>
                    <td>
                        <small>Iscritto il giorno {{ $client->created_at }}</small>
                        <br>
                        <small>Modifiche del profilo dall'utente {{ $client->updated_at }}</small>
                        <br>
                        <small>Email verificata {{ $client->email_verified_at }}</small>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
