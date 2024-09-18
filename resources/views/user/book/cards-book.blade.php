<div class="card">

    <div class="card-header d-flex flex-row justify-content-between">
        <div style="width: 70%" class="d-flex flex-row">

            <input class="form-control" x onkeyup="searchBook()" id="searchBook" type="search" placeholder="Cerca Libro per Nome" aria-label="Search">      
          
        </div>
        <div class="d-flex flex-row">
            @if (count($categories) > 0)
                <form action="{{ route('any.home.category') }}" method="GET">
                    <select onchange="this.form.submit()" class="form-select select2" name="category_id"
                        aria-label="multiple select example">
                        <option selected disabled>Seleziona Categoria</option>
                        <option value="tutti">Visualizza Tutti</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id}}">{{ $category->name }}</option>
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
                <div class=" col-sm-3 col-5 cardbook propriety-card">
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

                                <button href="{{route('user.book.add', $book)}}"
                                class="card-link btn btn-outline-success btn-sm mt-3"
                                 >Acquista Ora
                               </button>

                               <button type="submit" class="card-link btn btn-outline-primary btn-sm ">
                                Aggiungi al Carrello <i class="fa fa-cart-plus" aria-hidden="true"></i>

                            </button>

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
