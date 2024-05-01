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
                    <th></th>
                 
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <!-- inizio lista cards -->

                @foreach ($discounts as $discount)
                    <tr class="cardbook">
                        <td class="m-3" >
                            {{ $discount->name }}  
                            <br>
                            <strong>{{ $discount->percent }} <span class="text-success"> %</span></strong>
                            <br>
                            Libri con questo sconto
                            {{count($discount->books)}}
                        </td>
              
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
                        <td class="d-flex justify-content-center ">
                            @php
                                if ($discount->active == true) {
                                    $stato = 'Attivo';
                                    $btn = 'Disattiva';
                                    //$valueForChange = false;
                                } else {
                                    $stato = 'Disattivato';
                                    $btn = 'Attiva';

                                    //$valueForChange = true;
                                }

                            @endphp




                           

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
