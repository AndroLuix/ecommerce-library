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
                <div>

                    <div class="card my-2">
                        <div class="card-header d-flex flex-row gap-5 flex-wrap ">




                        </div>
                    </div>
                </div>


                <!-- Visualizza i link di paginazione con classi Bootstrap -->

                <!-- barra di ricerca -->
                <div class="card">
                    <div class="card-header d-flex flex-row justify-content-between flex-wrap gap-y-1">
                        <div style="width: 80%" class=" ">

                            <!-- barra di ricerca -->
                            <form action="{{ route('admin.book.search') }}" class="d-flex flex-row" method="POST">
                                @csrf
                                <input class="form-control" name="input" onkeyup="searchItems();" id="searchBook"
                                    type="search" placeholder="Cerca Libro per Titolo" aria-label="Search">
                                <button type="submit" class="btn btn-dark">Ricerca Globale</button>
                            </form>



                        </div>

                        <div>
                            @if (count($categories) > 0)
                                <form action="{{ route('admin.book.category') }}" style="height: 100%" method="GET">
                                    <select onchange="this.form.submit()" class="form-select " style="height: 100%"
                                        name="category_id" aria-label="multiple select example">
                                        <option selected disabled>Seleziona Categoria</option>
                                        <option value="tutti">Visualizza Tutti</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            @endif
                        </div>

                        <div class="d-flex flex-row flex-sm-wrap gap-5">
                            <!-- paginazione -->

                            <div>
                                @isset($request)
                                    {{ $books->onEachSide(-1)->appends(['category_id' => $request->category_id])->links() }}
                                @else
                                    {{ $books->onEachSide(-1)->links() }}
                                @endisset
                            </div>


                            <div class="flex-sm-wrap">
                                <button id="tableBtn"  class="toggle-view table btn btn-dark">Table</button>
                                <button id="newCardsBtn" class="toggle-view new-cards btn btn-dark">New Cards</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="list-table">
                    @include('admin.book.components.booklist.book-table')
                </div>
                <div id="list-new-cards" style="display:none;">
                    @include('admin.book.components.booklist.book-new-cards')
                </div>

                <!-- paginazione -->
                <div class="card card-header">
                    @isset($request)
                        {{ $books->onEachSide(1)->appends(['category_id' => $request->category_id])->links() }}
                    @else
                        {{ $books->onEachSide(1)->links() }}
                    @endisset
                </div>




                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

                <!-- qui vengono salvate le preferenze tra la visualizzazione della lista dei libri -->
                <script>
                    $(document).ready(function() {
                        // Funzione per mostrare la vista salvata
                        function applyUserSelection() {
                            var selectedView = localStorage.getItem('selectedView');
                            if (selectedView === 'new-cards') {
                                $('#list-table').hide();
                                $('#list-new-cards').show();
                            } else {
                                // Default o se l'utente ha scelto "Cards"
                                $('#list-table').show();
                                $('#list-new-cards').hide();
                            }
                        }

                        // Applica la selezione dell'utente salvata
                        applyUserSelection();

                        // Evento click sul bottone "Cards"
                        $('#tableBtn').on('click', function() {
                            $('#list-table').show();
                            $('#list-new-cards').hide();
                            localStorage.setItem('selectedView', 'cards'); // Salva la selezione
                        });

                        // Evento click sul bottone "New Cards"
                        $('#newCardsBtn').on('click', function() {
                            $('#list-table').hide();
                            $('#list-new-cards').show();
                            localStorage.setItem('selectedView', 'new-cards'); // Salva la selezione
                        });
                    });
                </script>
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

        // Funzione filtro barra di ricerca
    </script>
@endsection
