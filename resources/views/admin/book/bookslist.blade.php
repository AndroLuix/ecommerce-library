@extends('layouts.admin')


@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>

    <style>
        .custom-file-input:lang(it)~.custom-file-label::after {
            content: "Sfoglia";
        }

        .custom-file-input~.custom-file-label::after {
            content: "Inserisci Immagine di copertina";
        }
    </style>
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-md-9">

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


                <!-- card lista libri -->
                @include('admin.book.book-cards')


            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Inserisci Un Nuovo Libro</div>


                    <div class="card-body">
                        <div class="d-flex gap-3 pb-1">
                            @if (count($categories) > 0)
                                <button onclick="openModal('#bookModal')" class="btn btn-primary">Nuovo Libro</button>
                            @endif
                            <button onclick="openModal('#cateogryoModal')" class="btn btn-secondary">Nuova
                                Categoria</button>
                        </div>
                    </div>
                </div>

                <!-- count libri -->
                <div class="card mt-5">
                    <div class="card-header">Quantità libri presenti in questa lista @if (count($books) > 0)
                            <button class="btn btn-light"> {{ count($books) }}</button> 
                        @else
                            <h5>Nessun Libro Presente</h5>
                        @endif
                    </div>

                    <div class="card-body">
                        <strong>Categorie Presenti</strong>
                        <ul>
                            @php
                                $printedCategories = [];
                            @endphp
                            @foreach ($books as $book)
                                @if (!in_array($book->category->name, $printedCategories))
                                    <li>{{ $book->category->name }}</li>
                                    @php
                                        $printedCategories[] = $book->category->name;
                                    @endphp
                                @endif
                            @endforeach
                        </ul>
                        
                    </div>
                </div>
            </div>





        </div>
    </div>
    </div>

    @include('admin.book.modal')

    <script>
        function openModal(idElement) {
            $(idElement).modal('show');
        }

        function closeModal(idElement) {
            $(idElement).modal('hide')
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFile = document.getElementById('img');
            const label = inputFile.nextElementSibling;

            inputFile.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    label.textContent = file.name;
                } else {
                    // Non è necessario modificare questo codice
                    label.textContent = label.getAttribute('datae-oooo');
                }
            });
        });


        // live search
        <
        script >
            $(document).ready(function() {
                $('.select2').select2();
            });
    </script>

    </script>
@endsection
