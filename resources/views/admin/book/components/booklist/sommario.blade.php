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