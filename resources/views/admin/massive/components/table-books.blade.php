<div class="card">


    <form action="">
        <div class="card-body" id="table">

            <input class="form-control" name="input" onkeyup="searchItems();" id="searchBook" type="search"
                placeholder="Cerca Libro per Titolo" aria-label="Search">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h2 id="updateSection">

            </h2>
            <div class="table-responsive">
                <table class="table table-striped" align="center">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)" >Immagine
                                <i class="fa fa-sort" aria-hidden="true"></i>
                            </th>
                            <th onclick="sortTable(1)" >Titolo
                                <i class="fa fa-sort" aria-hidden="true"></i>
                            </th>
                            <th onclick="sortTable(2)" >Autore
                                <i class="fa fa-sort" aria-hidden="true"></i>
                            </th>
                            <th onclick="sortTable(3)">Categoria
                                <i class="fa fa-sort" aria-hidden="true"></i>
                            </th>
                            <th onclick="sortTable(4)">Prezzo €
                                <i class="fa fa-sort" aria-hidden="true"></i>
                            </th>
                            <th onclick="sortTable(5)" >Sconto
                                <i class="fa fa-sort" aria-hidden="true"></i>
                            </th>
                            <th onclick="sortTable(6)" style="min-width: 100px;">Magazzino
                                <i class="fa fa-sort" aria-hidden="true"></i>
                            </th>
                            <th>Aggiungi</th>
                        </tr>
                    </thead>

                    {{ $books->onEachSide(1)->fragment('table')->links() }}
                    <tbody>
                        <!-- inizio lista cards -->
                        @foreach ($books as $book)
                            <tr class="cardbook" id="book-id-{{ $book->id }}">
                                <td>
                                    <img class="card-img-left example-card-img-responsive p-2" style="width: 80px"
                                        height="120px" src="{{ asset($book->image) }}" />
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
                                            $prezzoFinale =
                                                $book->price - $book->price * ($book->discount->percent / 100);

                                            $stato = $book->discount->active ? 'Attivo' : 'Disattivato';

                                        @endphp

                                        <p class="list-group-item propriety-card small" id="sconto">
                                            Stato Sconto: {{ $stato }}
                                            @if ($stato == 'Attivo')
                                                Scontato <strong
                                                    style="color: green">{{ round($prezzoFinale, 2) }}</strong>€
                                            @endif
                                        </p>
                                    @endisset
                                </td>
                                <td>{{ $book->quantity }}</td>
                                <td>
                                    <button type="button" class="btn btn-dark" type="checkbox"
                                        onclick="addBook('#book-id-{{ $book->id }}','{{ $book->id }}','{{ $massive->id }}')"
                                        id="flexCheckIndeterminate{{ $book->id }}">Aggiungi</button>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>

<script>
    function addBook(idTr, book, massive) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: '/admin/massive/addBook',
            data: {
                book_id: book,
                massive_id: massive,
                _token: csrfToken
            },
            success: function(response) {
                // Gestisci la risposta
                $(idTr).hide(1000);
                $('#updateSection').html(response.message);
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Gestisci gli errori
                console.error(error);
            }
        });
    }
</script>
