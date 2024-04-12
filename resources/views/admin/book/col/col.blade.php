<div class="row ">
    
    <!-- colonna opzioni -->
    <div class="col-md-2">
        <div class="card">
            <div class="card-header mypointer" onclick="toggleList('#button-for-modal')">Inserisci Un Nuovo Libro</div>


            <div class="card-body" id="button-for-modal">
                <div class="d-flex gap-1">
                    @if (count($categories) > 0)
                        <button onclick="openModal('#bookModal')" class="btn btn-primary  btn-sm"><small>Nuovo Libro</small></button>
                    @endif
                    <button onclick="openModal('#cateogryoModal')" class="btn btn-secondary  btn-sm">
                        <small>Nuova
                        Categoria</small></button>
                </div>
            </div>
        </div>

        <!-- count libri -->
        <div class="card mt-1">
            <div class="card-header mypointer" title="Apri / Chiudi" onclick="toggleList('#list-category-incard')">Quantità libri presenti in questa lista @if (count($books) > 0)
                    <button class="btn btn-light" > {{ count($books) }}</button>
                @else
                    <h5>Nessun Libro Presente</h5>
                @endif
            </div>

            <div class="card-body" id="list-category-incard">
                <strong>Categorie Presenti</strong>
                <ul>
                    @php
                        $printedCategories = [];
                    @endphp
                    @foreach ($books as $book)
                        @if (!in_array($book->category->name, $printedCategories))
                            <li>
                                <a href="{{ route('admin.book.show', $book->category->name) }}">
                                    {{ $book->category->name }}
                                </a>
                            </li>
                            @php
                                $printedCategories[] = $book->category->name;
                            @endphp
                        @endif
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

    <!-- colonna  princiapale-->
    <div class="col-md-10 ">

        <!-- gestione errori -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Errore!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- gestione successo -->
        @if (session('success'))
            <div class="alert alert-success">
                <strong>Inviato!</strong>
                {{ session('success') }}
            </div>
        @endif


        <!-- card lista libri -->
        @include('admin.book.book-cards')


    </div>

</div>

<script>
    
    function toggleList(idDiv){
        $(idDiv).slideToggle('slow');
    }
</script>
