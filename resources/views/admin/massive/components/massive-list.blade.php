@foreach ($massive as $mass)
    <div class="card mt-5">
        <div class="card-header d-flex flex-row justify-content-between ">
            <h4> {{ $mass->name }}</h4>
            <div class="ms-5 d-flex row col-xs-12 col-sm-6 ">
                <form action="{{ route('admin.massive.discount.update', $mass) }}" method="POST" class="d-flex flex-row">
                    @csrf
                    @method('PUT')
                    <select onkeydown="if(event.keyCode==13) this.form.submit()"
                        onchange="showButton('#cambia-id-{{ $mass->id }}')"
                        class="form-select form-select-lg mt-2 bg-warning focus-bg-white col-xs-8 col-sm-8"
                        name="discount_id">
                        @foreach ($discounts as $discount)
                        @isset($mass->books[0]->discount_id)
                            @if ($mass->books[0]->discount_id == $discount->id)
                                <option value="{{ $discount->id }}" selected>{{ $discount->name }}</option>
                            @endif
                            @endisset
                            <option value="{{ $discount->id }}">{{ $discount->name }}</option>
                        @endforeach
                        <option value="null">Deseleziona | Rimuovi sconto ai libri </option>

                    </select>
                    <button id="cambia-id-{{ $mass->id }}" type="submit" class="btn btn-link col-xs-4 col-sm-4"
                        style="display: none">Cambai</button>
                </form>


            </div>
            <a href="{{ route('admin.massive.edit', $mass->id) }}" class="btn btn-link">Modifica</a>

        </div>

        <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                <?php $discountExist = false; ?>
                @foreach ($mass->books as $book)
                    <div class="col">
                        <div class="card h-100 shadow-sm"> <img src="{{ asset($book->image) }}" height="200px"
                                class="card-img-top object-fit-scale border rounded" alt="...">
                            <div class="card-body">
                                <div class="clearfix mb-3">

                                    @isset($book->discount->percent)
                                        <span class="float-start badge rounded-pill bg-primary">
                                            {{ $book->discount->percent }} %
                                        </span>
                                    @endisset

                                    <?php
                                    
                                    if (isset($book->discount->percent)) {
                                        $discountExist = true;
                                        $discountedPrice = $book->price - $book->price * ($book->discount->percent / 100);
                                    }
                                    ?>


                                    @isset($book->discount_id)
                                        <span class="float-end price-hp">

                                            <del><span class="text-muted">{{ $book->price }} &euro;</span> </del> <br>
                                            <span style="color: green">{{ round($discountedPrice, 2) }}
                                                &euro;</span>
                                        </span>
                                    @else
                                        <span style="color: green">{{ $book->price }} &euro;
                                        @endisset






                                </div>
                                <h5 class="card-title">{{ $book->title }}</h5>



                            </div>
                            <div class="text-center my-4" style="margin-top: 100%">
                                <form action="{{ route('admin.massive.dissociate', $book) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning">Rimuovi</button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- aggiungi un nuovo libro -->
                @if ($discountExist)
                    <div class="col">
                        <div class="card h-100 shadow-sm text-center align-items-center mb-5">
                            <i class="card-img-top fa fa-plus" style="font-size: 12em; color: dodgerblue;"></i>

                            <div class="card-body">
                                <div class="clearfix mb-3">

                                    <h5 class="card-title">Aggiungi un nuovo libro</h5>

                                </div>
                                <div class="text-center my-4" style="margin-top: 100%">
                                    <a href="{{ route('admin.massive.edit', $mass->id) }}"
                                        class="btn btn-primary">Aggiungi</a>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        @endif


</div>
</div>
@endforeach
