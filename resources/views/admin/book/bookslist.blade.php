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
                @include('components.message')
                <div>

                    <div class="card my-2">
                        <div class="card-header d-flex flex-row gap-5 flex-wrap ">
                           
                            <a href="{{ route('admin.discount') }}" class="btn btn-dark">
                                Sconti <i class="fa fa-percent" aria-hidden="true"></i>
                            </a>
                            <a href="" class="btn btn-dark">
                                 In Consegna <i class="fa fa-truck" aria-hidden="true"></i>
                            </a>

                            <a href="" class="btn btn-dark">
                                Ordini 

                                    <svg fill="#fff" width="20" height=20" 
                                    version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" 
                                    xmlns:xlink="http://www.w3.org/1999/xlink" 
                                     viewBox="0 0 425.832 425.833"
                                    xml:space="preserve">
                               <g>
                                   <path d="M377.763,83.169l-86.238-80.33c-1.957-1.83-4.54-2.839-7.21-2.839H55.291c-5.855,0-10.597,4.742-10.597,10.59v404.647
                                       c0,5.843,4.742,10.595,10.597,10.595H370.54c5.854,0,10.599-4.74,10.599-10.595V90.92
                                       C381.134,87.979,379.915,85.172,377.763,83.169z M108.599,388.26c0-8.273,6.735-15.011,15.018-15.011
                                       c8.282,0,15.012,6.737,15.012,15.011c0,8.284-6.73,15.016-15.012,15.016C115.334,403.276,108.599,396.544,108.599,388.26z
                                        M185.611,388.26c0-8.273,6.736-15.011,15.019-15.011c8.275,0,15.003,6.737,15.003,15.011c0,8.284-6.728,15.016-15.003,15.016
                                       C192.347,403.276,185.611,396.544,185.611,388.26z M360.118,404.654l-135.527-0.131c3.152-4.641,5.007-10.238,5.007-16.258
                                       c0-15.983-12.993-28.974-28.968-28.974c-15.981,0-28.983,12.99-28.983,28.974c0,6.003,1.839,11.574,4.972,16.214l-28.979-0.031
                                       c3.126-4.618,4.952-10.191,4.952-16.183c0-15.983-12.994-28.974-28.975-28.974c-15.98,0-28.98,12.99-28.98,28.974
                                       c0,5.971,1.814,11.519,4.925,16.132l-33.844-0.033l0.252-134.205L87.207,355.1h144.215l69.822-160.598h21.06
                                       c5.79,0,10.476-4.69,10.476-10.473c0-5.782-4.686-10.471-10.476-10.471h-34.79l-69.828,160.589h-114.13l-17.453-69.821h108.77
                                       c5.79,0,10.473-4.691,10.473-10.468c0-5.791-4.684-10.486-10.473-10.486H66.021l0.005-3.951V21.17h197.629v79.471
                                       c0,5.844,4.738,10.585,10.583,10.585h85.88V404.654z"/>
                               </g>
                               </svg>
                                  
                           </a>

                         
                        </div>
                    </div>
                </div>


                <!-- Visualizza i link di paginazione con classi Bootstrap -->

                <!-- barra di ricerca -->
                <div class="card">
                    @include('admin.book.components.booklist.searchbar')
                </div>

                <div id="list-cards">
                    @include('admin.book.components.booklist.book-cards')
                </div>
                <div id="list-table">
                    @include('admin.book.components.booklist.book-table')
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
                <script src="{{ asset('js/preference-cards-table.js') }}"></script>

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


        
    </script>

@endsection
