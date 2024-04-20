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

            <table class="table" align="center">
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
                        <th>Aggiungi</th>
                    </tr>
                </thead>

                {{$books->onEachSide(1)->fragment('table')->links()}}
                <tbody>
                    <!-- inizio lista cards -->
                    @foreach ($books as $book)
                        <tr class="cardbook">
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
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckIndeterminate{{ $book->id }}">
                                <label class="form-check-label" for="flexCheckIndeterminate{{ $book->id }}">
                                </label>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
</div>
