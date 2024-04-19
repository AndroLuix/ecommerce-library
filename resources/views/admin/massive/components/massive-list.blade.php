@foreach ($massive as $mass)
    <div class="card mt-5">
        <div class="card-header d-flex flex-row justify-content-between ">
            <h4> {{ $mass->name }}</h4>
            <div class="ms-5 d-flex row col-xs-12 col-sm-6 ">
                <form action="" method="POST" class="d-flex flex-row">
                    <select class="form-select form-select-lg mt-2 bg-warning focus-bg-white col-xs-8 col-sm-8" name="discount_id" onchange="showButton('#cambia-id-{{$mass->id}}')">
                        <option value="" disabled selected>Cambia Sconto</option>
                        @foreach ($discounts as $discount)
                            <option value="{{ $discount->id }}">{{ $discount->name }}</option>
                        @endforeach
                    </select>
                    <button id="cambia-id-{{$mass->id}}" type="submit" class="btn btn-link col-xs-4 col-sm-4" style="display: none">Cambai</button>
                </form>
            </div>
            
        </div>

        <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                @foreach ($mass->books as $book)
                    <div class="col">
                        <div class="card h-100 shadow-sm"> <img src="{{ asset($book->image) }}" class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <div class="clearfix mb-3"> <span class="float-start badge rounded-pill bg-primary">

                                        {{ $book->discount->percent }} %</span>
                                    @php
                                        $discountedPrice =
                                            $book->price - $book->price * ($book->discount->percent / 100);
                                    @endphp
                                    <span class="float-end price-hp">
                                        @isset($book->discount_id)
                                            <del><span class="text-muted">{{ $book->price }} &euro;</span> </del> <br>
                                        @endisset


                                        <span style="color: green">{{ round($discountedPrice, 2) }} &euro;</span></span>
                                </div>
                                <h5 class="card-title">{{ $book->title }}</h5>



                            </div>
                            <div class="text-center my-4" style="margin-top: 100%">
                                <a href="#" class="btn btn-warning">Rimuovi</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endforeach
