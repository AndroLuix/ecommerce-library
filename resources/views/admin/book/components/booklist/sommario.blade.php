<div class="card mt-1">
    <div class="card-header mypointer" title="Apri / Chiudi" onclick="toggleList('#list-category-incard')">
        Quantità libri presenti in questa lista @if (count($books) > 0)
            <button class="btn btn-light"> {{ count($books) }}</button>
        @else
            <h5>Nessun Libro Presente</h5>
        @endif
    </div>

    <div class="card-body" id="list-category-incard">
        <strong>Categorie Presenti</strong>
        <ul>
            @php
                $printedCategories = [];
                $count = 0;
            @endphp
            @foreach ($books as $book)
                @php

                    
                @endphp
                @if (!in_array($book->category->name, $printedCategories))
                    <li class="d-flex justify-content-between py-1">
                        <a class="" href="{{ route('admin.book.show', $book->category->name) }}">
                             {{ $book->category->name }}
                        </a>


                        <button class="btn btn-light btn-sm" title="Modifica il Nome della categoria"
                            onclick="editModalForCategory('#categoryEditModal','{{ $book->category->id }}','{{ $book->category->name }}')">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                        </button>

                    </li>
                    @php

                    @endphp
                @endif
                @php
                    $printedCategories[] = $book->category->name;

                @endphp
            @endforeach
        </ul>

    </div>
</div>
