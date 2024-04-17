<div class="card-header d-flex flex-row justify-content-between flex-wrap gap-y-1">
    <div style="width: 80%" class=" ">

        <!-- barra di ricerca -->
        <form action="{{ route('admin.book.search') }}" class="d-flex flex-row" method="POST">
            @csrf
            <input class="form-control" name="input" onkeyup="searchItems();" id="searchBook" type="search"
                placeholder="Cerca Libro per Titolo" aria-label="Search">
            <button type="submit" class="btn btn-dark">Ricerca Globale</button>

        </form>



    </div>

    <div>
        @if (count($categories) > 0)

            <form action="{{ route('admin.book.category') }}" style="height: 100%" method="GET">
                <select onchange="this.form.submit()" class="form-select " style="height: 100%" name="category_id"
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

    <div class="d-flex flex-row gap-5">
        <!-- paginazione -->

        @isset($request)
            {{ $books->onEachSide(-1)->appends(['category_id' => $request->category_id])->links() }}
        @else
            {{ $books->onEachSide(-1)->links() }}
        @endisset

        <button class="toggle-view tables btn btn-dark">Tabella</button>
        <button class="toggle-view cards btn btn-dark">Cards</button>


    </div>
</div>
