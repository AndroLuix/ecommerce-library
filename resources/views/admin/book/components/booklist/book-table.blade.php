<div class="card">
    <div class="card-header d-flex flex-row justify-content-between">
        <div style="width: 70%" class="d-flex flex-row">
            <input class="form-control" onkeyup="searchBookTable()" id="searchBookTable" type="search"
                placeholder="Cerca Libro per Nome" aria-label="Search">
        </div>
        <div class="d-flex flex-row">
            @if (count($categories) > 0)
                <form action="{{ route('admin.book.category') }}" method="GET">
                    <select onchange="this.form.submit()" class="form-select select2" name="category_id"
                        aria-label="multiple select example">
                        <option selected disabled>Seleziona Categoria</option>
                        <option value="tutti">Visualizza Tutti</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </form>
            @endif
        </div>
    </div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Immagine</th>
                    <th>Titolo</th>
                    <th>Autore</th>
                    <th>Categoria</th>
                    <th>Prezzo</th>
                    <th>Azioni</th>
                </tr>
            </thead>
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
                        <td>{{ $book->price }} €</td>
                        <td class="d-flex justify-content-center gap-3">
                            <form action="{{ route('admin.book.delete', $book->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Sicuro di voler eliminare il libro {{ $book->title }}?')"
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
    function searchBookTable() {
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

