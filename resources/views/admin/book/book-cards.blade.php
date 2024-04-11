<div class="card">
    <div class="card-header d-flex flex-row justify-content-between">
        <h3>Libri</h3>
        <div>
            @if (count($categories) > 0)
                <form action="{{ route('admin.book.category') }}" method="GET">
                    <select onchange="this.form.submit()" class="form-select select2" name="category_id"
                        aria-label="multiple select example">
                        <option selected disabled>Seleziona Categoria</option>
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

            <div class="d-flex flex-row flex-wrap gap-3 pb-1">
                @foreach ($books as $book)
                    <div class="card flex-row">
                        <div>
                            <img class="card-img-left example-card-img-responsive" width="180px"
                                height="300px" src="{{ asset($book->image) }}" />

                            <div class="card-body d-flex flex-row justify-content-around">

                                <form action="{{ route('admin.book.delete', $book->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        onclick="return confirm('Sicuro di voler eliminare il libro {{ $book->title }}?')"
                                        type="submit" class="card-link btn btn-outline-danger">Elimina
                                    </button>
                                </form>

                                <a href="#" class="card-link btn btn-outline-primary"
                                    style="margin-left:10px">Modfica</a>

                            </div>
                        </div>

                        <div class="card-body " style="width: 16rem">
                            <div class="card-body col-md-12">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">{{ $book->author }}</p>

                                <p class="card-text">Categoria:
                                    @isset($book->category->name)
                                        <strong>{{ $book->category->name }}</strong>
                                    </p>
                                @endisset
                                <hr>
                            </div>
                            <ul class="list-group list-group-flush col-md-10">
                                <li class="list-group-item">Prezzo {{ $book->price }} €</li>
                            </ul>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>