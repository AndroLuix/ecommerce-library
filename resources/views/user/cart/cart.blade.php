@extends('layouts.app')

@section('content')
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex flex-row justify-content-between">
                        <h3 class="mt-1">Carrello</h3>

                        <div>
                            <i class="fa fa-cart-plus ms-4 mt-1 aria-hidden="true" style="font-size: 35px">
                            </i>


                            <button class="btn btn-dark rounded mx-2 ">
                                {{ count($cart) }}
                            </button>

                        </div>
                    </div>

                    @include('components.message')



                    <div>
                        @include('user.cart.components.cart-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
