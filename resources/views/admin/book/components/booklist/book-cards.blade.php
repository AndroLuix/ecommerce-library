<div class="card">

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="d-flex justify-content-around">

            <div class="d-flex flex-row flex-wrap gap-3 pb-1 justify-content-around">
                <!-- inizio lista cards -->
                @foreach ($books as $book)
                    <div class="card cardbook flex-row shadow ">
                        <div>
                            <img class="card-img-left example-card-img-responsive p-1" style="width: 160px" height="300px"
                                src="{{ asset($book->image) }}" />


                        </div>

                        <div class="card-body propriety-card" style="width: 11rem">
                            <div class="card-body col-md-12">
                                <h6 class="propriety-card card-title">{{ $book->title }}</h6>
                                <p class="propriety-card card-text small">{{ $book->author }}</p>

                                @isset($book->category->name)
                                    <p class="card-text">Categoria:
                                        <strong class="propriety-card small">{{ $book->category->name }}</strong>
                                    </p>
                                    <p><small class="propriety-card">Magazzino: {{ $book->quantity }}</small> </p>
                                @endisset

                                @isset($book->discount)
                                    @if ($book->discount->active == true)
                                        <small> Sconto <i class="propriety-card">{{ $book->discount->name }}</i> Attivo</small>
                                        <p> <strong style="color: green">{{ $book->discount->percent }} %</strong></p>
                                    @endif
                                @endisset




                            </div>
                            <ul class="list-group list-group-flush col-md-10">
                                <li class="list-group-item propriety-card small">Prezzo {{ $book->price }} €</li>
                                @isset($book->discount)
                                    @php
                                        $prezzoFinale = $book->price - $book->price * ($book->discount->percent / 100);

                                    @endphp
                                    <li class="list-group-item propriety-card small" id="sconto">
                                        Scontato <strong style="color: green" class="propriety-card">{{ round($prezzoFinale, 2) }}</strong>
                                    </li>
                                @endisset


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

                                <a href="{{ route('admin.book.edit', $book) }}"
                                    class="card-link btn btn-outline-primary btn-sm" style="margin-left:5px">Modfica</a>

                            </div>

                        </div>
                    </div>
                @endforeach


               

            </div>
        </div>
    </div>
</div>
