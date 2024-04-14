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
    <div class="container-fluid">

        <div class="row ">
            <!-- colonna sinistra -->
            <div class="col-md-2">

                <!-- colonna opzioni -->
                @include('admin.book.components.booklist.opzioni')

                <!-- sommario libri -->
                @include('admin.book.components.booklist.sommario')

            </div>

            <!-- colonna  princiapale-->
            <div class="col-md-10 ">

                <!-- gestione errori -->
                @include('admin.book.components.booklist.message')


                <!-- lista libri -->


                <div>
                    <div class="card">
                        <div class="card-header d-flex flex-row gap-5 ">
                            Opzioni
                           
                                <button class="toggle-view tables btn btn-dark">Tabella</button>
                                <button class="toggle-view cards btn btn-dark">Cards</button>
                                
                        </div>
                    </div>
                </div>
                <div id="list-cards">
                    @include('admin.book.components.booklist.book-cards')
                </div>
                <div id="list-table">
                    @include('admin.book.components.booklist.book-table')
                </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

                <!-- qui vengono salvate le preferenze tra la visualizzazione della lista dei libri -->
                <script src="{{asset('js/preference-cards-table.js')}}"> </script>

            </div>
        </div>

        <script>
            function toggleList(idDiv) {
                $(idDiv).slideToggle('slow');
            }
        </script>
    </div>

    @include('admin.book.components.booklist.modal')

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
