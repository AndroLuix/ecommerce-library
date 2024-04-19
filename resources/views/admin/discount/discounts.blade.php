@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pagina Gestione Sconti') }} </div>

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
                            @if (count($discounts) <= 0)
                                <!-- se NON ci sono entità di sconti nel database -->
                                <div class="card" style="width: 15rem;">
                                    <div class="text-center p-5  bg-warning">
                                        <i class="fa fa-percent card-img-top" style="font-size:80px"></i>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Crea La tua prima categoria di sconti</h5>
                                        <p class="card-text">Crea uno sconto</p>
                                        <button onclick="openModal('#scontiModal')" class="btn btn-dark">Inizia</button>
                                    </div>
                                </div>
                            @else
                                <!-- se sono presenti entità di sconti del database -->

                                <div class="card" style="width: 15rem;">
                                    <div class="text-center p-5  bg-warning">
                                        <i class="fa fa-percent card-img-top" style="font-size:80px"></i>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Crea Sconto</h5>
                                        <p class="card-text">Crea una nuova categoria di sconto</p>
                                        <button onclick="openModal('#scontiModal')" class="btn btn-dark">Crea</button>
                                    </div>
                                </div>

                                <div class="card" style="width: 15rem;">
                                    <a href="{{ route('admin.massive') }}">
                                        <div class="text-center p-5  bg-primary text-dark">
                                            <i class="fa fa-bars card-img-top" style="font-size:80px"></i>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title">Crea un Massive!</h5>
                                        <p class="card-text"> Applica lo stesso sconto su diversi libri</p>
                                        <a href="{{route('admin.massive')}}" class="btn btn-dark">Applica Sconti</a>
                                    </div>
                                </div>
                            @endif


                        </div>


                    </div>
                </div>

                <!-- tabella con sconti -->
                @include('admin.discount.components.table-discount')
            </div>
        </div>
    </div>

    @include('admin.discount.components.modal')

    <script src="{{ asset('js/modal.js') }}"></script>
@endsection
