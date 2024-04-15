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

                    <form>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <small>Nome titolare carta</small>
                                <input type="text" class="form-control-plaintext" id="staticEmail"
                                    placeholder="Mario Rossi">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <small>Numero Carta</small>
                                <input type="number" min="16" max="16" class="form-control-plaintext" id="staticEmail"
                                    placeholder="43943418067844">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <small>Numero Carta</small> <span style="color: dodgerblue" title="Le 3 crifre ditro la tua carta di credito">?</span>
                                <input type="number" max="3" min="3" class="form-control-plaintext" id="staticEmail"
                                    placeholder="43943418067844">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <small>Data Scadenza</small> <span style="color: dodgerblue" title="Le 3 crifre ditro la tua carta di credito">?</span>
                                <input type="month" max="3" min="3" class="form-control-plaintext" id="staticEmail"
                                    placeholder="43943418067844">
                            </div>
                        </div>

                        <button class="btn btn-primary">Inserisci Metodo di Pagamento</button>





                    </form>


                    <div>
                        @include('user.cart.components.cart-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
