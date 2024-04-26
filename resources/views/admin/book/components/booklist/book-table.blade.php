<div class="card">
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <table class="table"  align="center">
            <thead>
                <tr>
                    <th onclick="sortTable(0)" style="min-width: 150px;">Immagine 
                        <i class="fa fa-sort" aria-hidden="true"></i>
                    </th>
                    <th onclick="sortTable(1)" style="min-width: 150px;">Titolo
                        <i class="fa fa-sort" aria-hidden="true"></i>
                    </th>
                    <th onclick="sortTable(2)" style="min-width: 150px;">Autore
                        <i class="fa fa-sort" aria-hidden="true"></i>
                    </th>
                    <th onclick="sortTable(3)" style="min-width: 150px;">Categoria
                        <i class="fa fa-sort" aria-hidden="true"></i>
                    </th>
                    <th onclick="sortTable(4)" style="min-width: 150px;">Prezzo €
                        <i class="fa fa-sort" aria-hidden="true"></i>
                    </th>
                    <th onclick="sortTable(5)" style="min-width: 150px;">Sconto
                        <i class="fa fa-sort" aria-hidden="true"></i>
                    </th>
                    <th onclick="sortTable(6)" style="min-width: 100px;">Magazzino
                        <i class="fa fa-sort" aria-hidden="true"></i>
                    </th>
                    <th>Azioni</th>
                </tr>
            </thead>
            
            <tbody class="">
                <!-- inizio lista cards -->
                @foreach ($books as $book)
                    <tr class="cardbook">
                        <td>
                            <img class="card-img-left example-card-img-responsive p-2" style="width: 80px" height="120px"
                                src="{{ asset($book->image) }}" />
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            @isset($book->category->name)
                                <p class="card-text">Categoria:
                                    <strong class="propriety-card small">{{ $book->category->name }}</strong>
                                </p>
                            @endisset
                        </td>
                        <td>
                            <strong>{{ $book->price }}</strong>€
                        </td>
                        <td> @isset($book->discount)
                                @php
                                    $prezzoFinale = $book->price - $book->price * ($book->discount->percent / 100);

                                    $stato = $book->discount->active ? 'Attivo' : 'Disattivato';

                                @endphp
                              
                                <p class="list-group-item propriety-card small" id="sconto">
                                    Stato Sconto: {{ $stato }} 
                                    @if ($stato == 'Attivo')
                                        Scontato <strong style="color: green">{{ round($prezzoFinale, 2) }}</strong>€
                                    @endif
                                </p>
                                
                            @endisset
                        </td>
                        <td>{{$book->quantity}}</td>
                        <td class="d-flex justify-content-center gap-3">
                            <form action="{{ route('admin.book.delete', $book->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Sicuro di voler eliminare il libro {{ $book->title }}?')"
                                    type="submit" class="card-link btn btn-outline-danger btn-sm">Elimina
                                </button>
                            </form>
                            <a href="{{ route('admin.book.edit', $book) }}"
                                class="card-link btn btn-outline-primary btn-sm" style="margin-left:5px">Modifica</a>
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
