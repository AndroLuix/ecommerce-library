<div class="card">
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped" align="center">
                <thead>
                    <tr>
                        <th colspan="2"  onclick="sortTable(0)">Libro - titolo
                            <i class="fa fa-sort" aria-hidden="true"></i>
                        </th>
                       
                        <th style="min-width: 200px;">
                            Recensioni
                          
                        </th>
                        <th >
                        </th>
                        <th style="min-width: 200px;">
                        </th>
                        <th onclick="sortTable(5)">
                            <i class="fa fa-sort" aria-hidden="true"></i>
                        </th>

                    </tr>
                </thead>

                <tbody class="">
                    <!-- inizio lista cards -->
                    @foreach ($reviews as $review)
                        <tr class="cardbook">
                            <td>
                                <div class="mt-5">
                                    {{ $review->book->title }}
                                </div>
                            </td>
                            <td> <img class="object-fit-scale border rounded shadow mt-3" width="150" height="150"
                                    src="{{ asset($review->book->image) }}" alt="">
                            </td>
                            <td>


                                <div class="card p-3">
                                    <div>
                                        <p>{{ $review->review_text }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">

                                        <div class="ratings">
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                <i class="fa fa-star rating-color "></i>
                                            @endfor
                                        </div>
                                        <h5 class="review-count">{{ $review->rating }}</h5>
                                    </div>
                                    <p><strong></strong></p>
                            </td>

                            <td>
                                <div class="d-flex justify-content-between align-items-center ms-5 mt-2">

                                    <img class="rounded-circle" width="120px" height="120px"
                                        src="{{ asset($review->user->image) }}" alt="">

                                </div>
                                <h4 class="text-center mt-2"> {{ $review->user->name }}</h4>

                            </td>

                            <td class="mb-5">
                                <form class="mt-5 text-center"
                                    action="{{ route('admin.review.delete', ['clientID' => $review->client_id, 'bookID' => $review->book_id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        onclick="return confirm('Sicuro di voler eliminare la recensione di {{ $review->user->name }}?')"
                                        type="submit" class="card-link btn btn-outline-danger btn-sm">Elimina
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function sortTable(columnIndex) {

        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.querySelector(".table");
        switching = true;

        while (switching) {
            switching = false;
            rows = table.rows;

            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;

                x = rows[i].getElementsByTagName("td")[columnIndex];
                y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }

            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
</script>
