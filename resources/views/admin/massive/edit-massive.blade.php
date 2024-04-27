@extends('layouts.admin')


@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>

   
    <div class="container col-md-12">
        <div class="row justify-content-around">


           <!-- message -->
           @includeIf('components.message')


            <form action="{{ route('admin.massive.update', $massive->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body con-md-8">
                    <!-- Aggiungi qui il tuo form per inserire un libro -->

                    <div class="modal-body con-md-8">
                        @include('admin.massive.components.edit.single-list-massive')
                    </div>
                    <div>
                        @include('admin.massive.components.edit.table-books')

                    </div>
                   
                </div>
                <div class="d-grid gap-2 m-5">
                    <button type="submit" class="btn btn-primary">Modifica Massive</button>
                </div>
        </div>




        </form>


    </div>
    </div>


@endsection
