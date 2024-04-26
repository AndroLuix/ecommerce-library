<div class="card">

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="d-flex flex-wrap gap-2 justify-content-around">

            @foreach ($books as $book)
                <div class="col-2 cardbook propriety-card">
                    <div class="card h-100 shadow-sm"> <img src="{{ asset($book->image) }}" height="200px"
                            class="card-img-top object-fit-scale border rounded" alt="...">
                        <div class="card-body ">
                            <div class="clearfix mb-3">
                                @isset($book->discount->percent)
                                    <span class="float-start badge rounded-pill bg-primary">
                                        {{ $book->discount->percent }} %
                                    </span>
                                @endisset

                                <?php
                                if (isset($book->discount->percent)) {
                                    $discountedPrice = $book->price - $book->price * ($book->discount->percent / 100);
                                }
                                
                                ?>
                                <span class="float-end price-hp">
                                    @isset($book->discount_id)
                                        <del><span class="text-muted">{{ $book->price }} &euro;</span> </del> <br>
                                        <span style="color: green">{{ round($discountedPrice, 2) }}
                                            &euro;</span></span>
                                @else
                                    <span style="color: green">{{ $book->price }} &euro;</span></span>
                                @endisset



                            </div>
                            <h5 class="card-title propriety-card">{{ $book->title }} <small>{{$book->author}}</small></h5>

                            <p><i class="propriety-card">{{ $book->category->name }}</i></p>






                        </div>
                        <div class="text-center my-4" style="margin-top: 100%">
                            <p > Rimasti: <span class="propriety-card">{{ $book->quantity }}</span> </p>


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
                </div>
            @endforeach

        </div>
    </div>
</div>
