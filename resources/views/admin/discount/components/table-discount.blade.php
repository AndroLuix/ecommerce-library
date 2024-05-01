<div class="card">


    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Percentuale</th>
                    <th>Libri <i style="color: dodgerblue" title="Libri che hanno questo sconto">?</i></th>
                    <th>Creato Il</th>
                    <th>Aggiornato al</th>
                    <th>Azioni</th>

                </tr>
            </thead>
            <tbody>
                <!-- inizio lista cards -->

                @foreach ($discounts as $discount)
                    <tr class="cardbook">
                        <td>
                            {{ $discount->name }}
                        </td>
                        <td><strong>{{ $discount->percent }} <span class="text-success"> %</span></strong> </td>
                        <td> {{count($discount->books)}}</td>
                        <td>{{ $discount->created_at }}</td>

                        <td>{{ $discount->updated_at }} </td>
                        <td class="d-flex justify-content-center gap-3">
                            <form action="{{ route('admin.discount.delete', $discount) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Sicuro di voler eliminare l\'offerta {{ $discount->name }}?')"
                                    type="submit" class="card-link btn btn-outline-danger btn-sm">Elimina
                                </button>
                            </form>
                            <a href="{{ route('admin.discount.edit', $discount) }}"
                                class="card-link btn btn-outline-primary btn-sm" style="margin-left:5px">Modifica
                            </a>
                        </td>
                    

                    </tr>
                @endforeach



            </tbody>
        </table>
    </div>
</div>

<script>
    function searchDiscountPercentNameTable() {
        var input, filter, rows, row, title, i, txtValue;
        input = document.getElementById("searchBookTable");
        filter = input.value.toUpperCase();
        rows = document.getElementsByTagName("tr"); // Seleziona tutte le righe della tabella

        for (i = 0; i < rows.length; i++) {
            row = rows[i];
            title = row.getElementsByTagName("td")[1]; // Seleziona il secondo <td> (indice 1) che contiene il titolo
            if (title) {
                txtValue = title.textContent || title.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        }
    }
</script>
