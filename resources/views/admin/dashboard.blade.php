@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }} | Benvenuto {{ Auth::guard('admin')->user()->name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif



                        <div class="d-flex flex-row flex-wrap gap-2 justify-content-around">
                            <!-- lista opzioni -->

                            <div class="card" style="width: 15rem;">
                                <div class="text-center p-5 bg-success ">
                                    <i class="fa fa-book card-img-top" style="font-size:80px"></i>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">I tuoi libri</h5>
                                    <p class="card-text">Visualizza i tuoi libri.</p>
                                    <a href="{{ route('admin.book') }}" class="btn btn-primary">Vai alla pagina</a>
                                </div>
                            </div>

                            <div class="card" style="width: 15rem;">

                                <div class="text-center p-5  bg-warning">
                                    <i class="fa fa-users card-img-top" style="font-size:80px"></i>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Clienti</h5>
                                    <p class="card-text">Visualizza i profili dei tuoi clienti</p>
                                    <a href="#" class="btn btn-primary">Vai alla pagina</a>
                                </div>
                            </div>

                            <div class="card" style="width: 15rem;">

                                <div class="text-center p-5 bg-info">
                                    <i class="fa fa-truck card-img-top" style="font-size:80px"></i>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Ordini</h5>
                                    <p class="card-text">Visualizza gli ordini</p>
                                    <a href="#" class="btn btn-primary">Vai alla pagina</a>
                                </div>
                            </div>

                            <div class="card" style="width: 15rem;">

                                <div class="text-center p-5 bg-success">
                                    <i class="fa fa-file-excel-o card-img-top" style="font-size:80px"></i>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Dati</h5>
                                    <p class="card-text">Scarica dati in file Excell</p>
                                    <a href="#" class="btn btn-primary">Vai alla pagina</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
