@extends('layouts.app')

@section('content')
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}@if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Benvenuto {{ Auth::user()->name }}
                    </div>

                    <div class="card-body">
                        <!-- gestione errori -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Errore!</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- gestione successo -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                <strong>Inviato!</strong>
                                {{ session('success') }}
                            </div>
                        @endif

                    </div>

                    <div>
                        @include('user.book.cards-book')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
