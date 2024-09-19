<div class="card">

<style>
    .hidden {
    display: none !important;
}

</style>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Percentuale</th>
                    <th>Libri <i style="color: dodgerblue" title="Libri che hanno questo sconto">?</i></th>
                    <th>Creato Il</th>
                    <th>Aggiornato al</th>
                    <th>Azioni</th>

                </tr>
            </thead>
            <tbody>
                <!-- inizio lista cards -->

                @foreach ($discounts as $discount)
                    <tr class="cardbook">
                        <td>
                            {{ $discount->name }}
                        </td>
                        <td><strong>{{ $discount->percent }} <span class="text-success"> %</span></strong> </td>
                        <td>
                            <h4>{{ count($discount->books) }}</h4>
                            <span onclick="showListBooks('#discount-{{ $discount->id }}')"
                                class=" btn btn-outline-dark">Open List</span>
                            <ul style="display: none" id="discount-{{ $discount->id }}">
                                @foreach ($discount->books as $book)
                                    <li class="border-bottom-0 shadow my-3 p-4 d-flex flex-column col-10"
                                        id="hidden-book-{{ $book->id }}">
                                        {{ $book->title }}
                                        <?php
                                        if (isset($book->discount->percent)) {
                                            $discountedPrice = $book->price - $book->price * ($book->discount->percent / 100);
                                        }
                                        ?>
                                        <div>
                                            <div class="float-center py-3 price-hp px-3">
                                                @isset($book->discount_id)
                                                    <del><span class="text-muted">{{ number_format($book->price, 2) }}
                                                            &euro;</span></del> <br>
                                                    <span style="color: green">{{ number_format($discountedPrice, 2) }}
                                                        &euro;</span>
                                                @else
                                                    <span style="color: green">{{ number_format($book->price, 2) }}
                                                        &euro;</span>
                                                @endisset
                                            </div>



                                            <div>
                                                <button class="btn btn-danger shadow"
                                                    onclick="togliSonto('{{ $book->id }}')">Rimuovi Sconto su
                                                    questo libro</button>
                                            </div>


                                        </div>


                                    </li>
                                @endforeach

                            </ul>




                        </td>
                        <td>{{ $discount->created_at }}</td>

                        <td>{{ $discount->updated_at }} </td>
                        <td class="d-flex justify-content-center gap-3">
                            <form action="{{ route('admin.discount.delete', $discount) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Sicuro di voler eliminare l\'offerta {{ $discount->name }}?')"
                                    type="submit" class="card-link btn btn-outline-danger btn-sm">Elimina
                                </button>
                            </form>
                            <a href="{{ route('admin.discount.edit', $discount) }}"
                                class="card-link btn btn-outline-primary btn-sm" style="margin-left:5px">Modifica
                            </a>
                        </td>


                    </tr>
                @endforeach

                <script>
                    const showListBooks = (discountId) => {
                        $(discountId).slideToggle()

                    }
                </script>

                <script>
                    const togliSonto = (bookId) => {
                        const ListBook = $(`#hidden-book-${bookId}`);

                        if (ListBook.length) {
                            axios.get(`/admin/discount-remove-book/${bookId}`)
                                .then(response => {
                                    console.log('Quantity updated successfully');
                                    ListBook.addClass('hidden');
                                    console.log('Element hidden:', ListBook.hasClass('hidden'));
                                })
                                .catch(error => {
                                    console.error('There was an error updating the quantity:', error);
                                });
                        } else {
                            console.error('Element not found:', `#hidden-book-${bookId}`);
                        }
                    };
                </script>



            </tbody>
        </table>
    </div>
</div>

<script>
    function searchDiscountPercentNameTable() {
        var input, filter, rows, row, title, i, txtValue;
        input = document.getElementById("searchBookTable");
        filter = input.value.toUpperCase();
        rows = document.getElementsByTagName("tr"); // Seleziona tutte le righe della tabella

        for (i = 0; i < rows.length; i++) {
            row = rows[i];
            title = row.getElementsByTagName("td")[1]; // Seleziona il secondo <td> (indice 1) che contiene il titolo
            if (title) {
                txtValue = title.textContent || title.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        }
    }
</script>
