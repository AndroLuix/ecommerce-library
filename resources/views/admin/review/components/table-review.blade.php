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
                        <th  onclick="sortTable(0)">Libro - titolo
                          
                        </th>
                       
                        <th style="min-width: 200px;">
                            Recensioni
                          
                        </th>
                        <th >
                        </th>
                        <th style="min-width: 200px;">
                        </th>
                        <th >
                            
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
