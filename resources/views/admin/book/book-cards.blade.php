<div class="card">

    <div class="card-header d-flex flex-row justify-content-between">
        <div style="width: 70%" class="d-flex flex-row">

            <input class="form-control" x onkeyup="searchBook()" id="searchBook" type="search" placeholder="Cerca Libro per Nome" aria-label="Search">      
          
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

        <div class="d-flex justify-content-around">

            <div class="d-flex flex-row flex-wrap gap-3 pb-1 justify-content-around">
                @foreach ($books as $book)
                    <div class="card cardbook flex-row shadow">
                        <div>
                            <img class="card-img-left example-card-img-responsive p-2" style="width: 180px" 
                                height="300px" src="{{ asset($book->image) }}" />

                            
                        </div>

                        <div class="card-body " style="width: 11rem">
                            <div class="card-body col-md-12">
                                <h6 class="propriety-card card-title">{{ $book->title }}</h6>
                                <p class="propriety-card card-text small">{{ $book->author }}</p>

                                <p class="card-text">Categoria:
                                    @isset($book->category->name)
                                        <strong class="propriety-card small">{{ $book->category->name }}</strong>
                                    </p>
                                @endisset
                                <hr>
                            </div>
                            <ul class="list-group list-group-flush col-md-10">
                                <li class="list-group-item propriety-card small">Prezzo {{ $book->price }} €</li>
                            </ul>
                            <!-- form for book -->
                            <div class=" d-flex flex-row justify-content-around mt-3">

                                <form action="{{ route('admin.book.delete', $book->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        onclick="return confirm('Sicuro di voler eliminare il libro {{ $book->title }}?')"
                                        type="submit" class="card-link btn btn-outline-danger btn-sm">Elimina
                                    </button>
                                </form>

                                <a href="{{route('admin.book.edit', $book)}}" class="card-link btn btn-outline-primary btn-sm"
                                    style="margin-left:5px">Modfica</a>

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

<script>
    function searchBook() {
        var input, filter, cards, card, title, i, txtValue;
        input = document.getElementById("searchBook");
        filter = input.value.toUpperCase();
        cards = document.getElementsByClassName("cardbook");

        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            title = card.querySelector(".propriety-card");
            txtValue = title.textContent || title.innerText;

            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                card.style.display = "";
            } else {
                card.style.display = "none";
            }
        }
    }
</script>
