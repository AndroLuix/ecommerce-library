@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex flex-row"> 
                        <p class="btn btn-outline-primary" style="font-weight: 700">{{ __('Modifica') }}: <i>{{$discount->name}}</i></p>
                        <div class="ms-5"> <a href="{{route('admin.discount')}}" class="btn btn-dark">Torna alla pagina Sconti</a></div>
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
                            <form action="{{route('admin.discount.update', $discount)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="d-flex flex-row gap-3">
                                    <small>Nome dell'offerta</small>
                                    <input name="name" value="{{$discount->name}}" type="text" class="form-control" id="inputEmail4" placeholder="Nome dell'Offerta">
                                  
                                    <small>Percentuale <strong style="color: green">%</strong></small>
                                    <input name="percent" value="{{$discount->percent}}" type="number" class="form-control" id="inputPassword4" placeholder="Percentuale"> 
                                  
                                <button type="submit" class="btn btn-primary mt-2">Aggiorna</button>
                              </form>


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
