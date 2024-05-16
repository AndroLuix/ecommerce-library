    <div class="card mt-2">
        <div class="card-header d-flex flex-row justify-content-between ">
            <div class="d-flex flex-row justify-content-between ">

                <h5>Cambia titolo</h5>
                <input required placeholder="name" value="{{ $massive->name }}" type="text" name="name"
                    class="form-control" />
            </div>
            <div class="ms-5 d-flex row col-xs-12 col-sm-6 ">
                <form action="{{ route('admin.massive.discount.update', $massive) }}" method="POST"
                    class="d-flex flex-row">
                    @csrf
                    @method('PUT')
                    <select
                        class="form-select form-select-lg mt-2 
                        bg-warning focus-bg-white col-xs-8 col-sm-8"
                        name="discount_id">
                        @foreach ($discounts as $discount)
                            @isset($mass->books[0]->discount_id)
                                @if ($mass->books[0]->discount_id == $discount->id)
                                    <option value="{{ $discount->id }}" selected>{{ $discount->name }}</option>
                                @endif
                            @endisset
                            <option value="{{ $discount->id }}">{{ $discount->name }}</option>
                        @endforeach
                    </select>

                </form>


            </div>

        </div>

        <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                @foreach ($massive->books as $book)
                    <!-- grandezza cards -->
                    <div class="col-3 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset($book->image) }}" height="200px"
                                class="card-img-top object-fit-scale border rounded" alt="{{ $book->name }}">
                            <div class="card-body">
                                <div class="clearfix mb-3">
                                    <span class="float-start badge rounded-pill bg-primary">

                                        @if(isset($ $book->discount->percent))
                                            {{ $book->discount->percent }} %</span>
                                            @php
                                        $discountedPrice =
                                            $book->price - $book->price * ($book->discount->percent / 100);
                                    @endphp
                                      <span class="float-end price-hp">
                                        @isset($book->discount_id)
                                            <del><span class="text-muted">{{ $book->price }} &euro;</span> </del> <br>
                                        @endisset


                                        <span style="color: green">{{ round($discountedPrice, 2) }}
                                            &euro;</span></span>
                                        @endif
                                        <span style="color: white">{{ $book->price}}
                                            &euro;</span></span>
                                        
                                    
                                  
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

            </div>
        </div>

        <!-- modal -->
