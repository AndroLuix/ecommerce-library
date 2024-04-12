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

                Benvenuto {{Auth::user()->name  }}
            </div>

                <div class="card-body">
                    
                </div>

                <div>
                    @include('user.book.cards-book')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
