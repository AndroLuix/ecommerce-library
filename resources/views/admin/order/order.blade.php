@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-header text-center pb-5">
                    <h3>{{ __('Ordini') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- messaggi di errore e di scuccesso -->
                    @include('components.message')


                    <div class="d-flex flex-row flex-wrap gap-2 justify-content-around">
                        <!-- lista opzioni -->
                    </div>
                </div>

                <div class="d-flex flex-row flex-wrap">
                    {{ $orders->onEachSide(-1)->links() }}
                    <div style="width: 60%" class="ms-5 ">

                        <!-- barra di ricerca -->
                        <form action="" class="d-flex flex-row" style="height: 40px" method="POST">
                            @csrf
                            <input class="form-control" name="input" onkeyup="searchItems();" id="searchBook"
                                type="search" placeholder="cerca ordine..." aria-label="Search">
                            <button type="submit" class="btn btn-dark btn-sm display-6">Cerca Cleinte</button>

                        </form>



                    </div>
                </div>
                <!-- tabella con ordini non spediti-->
                <div class="card-body">
                  
                        <form action="{{ route('admin.order') }}" method="GET">
                            <select  class="form-select" name="type" aria-label="Default select example" onchange="this.form.submit()">
                                <option selected disabled>Filtra</option>
                                <option value="tutti">Tutti</option>

                                <option value="spediti">Spediti</option>
                                <option value="nonspediti">Non spediti</option>
                            </select>
                            <noscript><button type="submit">Submit</button></noscript>
                        </form>
                        

                </div>
                @include('admin.order.components.table-orders')

            </div>
        </div>
    </div>



    <script src="{{ asset('js/modal.js') }}"></script>
@endsection
