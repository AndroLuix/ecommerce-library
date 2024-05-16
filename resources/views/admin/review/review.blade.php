@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-header text-center pb-5">
                    <h3>{{ __('Guarda cosa pensano dei libri') }}</h3>

                    <div class="card">
                        <div class="card-header d-flex flex-row justify-content-around bg-dark text-white font-weight-bold">
                             <p>Recensioni Totali: {{$count}}</p>
                             
                               <div>
                                Media
                                @for ($i = 0; $i <round($averageRating,0); $i++)
                               <i class="fa fa-star rating-color text-white "></i>
                           @endfor
                               </div>
                            
                            </div>
                               
                      
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- tabella recensioni -->
                </div>


                <div class="d-flex flex-row flex-wrap my-3">
                    <div style="width: 60%" class="ms-5 ">

                        <!-- barra di ricerca -->
                        <form action="{{ route('admin.review.search') }}" class="d-flex flex-row my-3" style="height: 40px"
                            method="POST">
                            @csrf
                            <input class="form-control" name="input" onkeyup="searchItems()" id="searchBook"
                                type="search" placeholder="cerca..." aria-label="Search">
                            <button type="submit" class="btn btn-dark btn-sm display-6 mx-2">Cerca</button>

                        </form>



                        @if (request()->isMethod('GET'))
                            {{ $reviews->onEachSide(0)->links() }}
                        @endif


                    </div>
                </div>

                <div class="d-flex flex-row flex-wrap gap-2 justify-content-around">
                    @include('admin.review.components.table-review')
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('js/modal.js') }}"></script>
@endsection
