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
            content: "Cambia Immagine di copertina";
        }
    </style>
    <div class="container col-md-8">
        <div class="row justify-content-around">


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


            <form action="{{ route('admin.book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body con-md-8">
                    <!-- Aggiungi qui il tuo form per inserire un libro -->

                    <div class="d-flex flex-row gap-3 justify-content-around my-3">

                        <small>Titolo</small>
                        <input required placeholder="Titolo" value="{{ $book->title }}" type="text" name="title"
                            class="form-control" />

                        <small>Autore</small>
                        <input value="{{ $book->author }}" required placeholder="Autore" max="50" type="text"
                            name="author" class="form-control" />

                    </div>



                    <div class="d-flex flex-row gap-3 justify-content-around my-3">
                        <img src="{{ asset($book->image) }}">
                        <small>Descrizione</small>
                        <textarea required name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $book->description }}</textarea>
                    </div>


                    <div style="float: " class="col-md-8 mt-5">
                        <div class="form-group my-2">
                            <input type="file" hidden id="img" name="image" accept="image/*"
                                class="custom-file-input">
                            <label class="custom-file-label btn btn-outline-primary" for="img"
                                data-browse="Inserisci immagine di copertina">
                            </label>
                        </div>


                        <small>Categoria</small>
                        <select class="form-select" name="category_id" placeholder="Seleziona Categroia" required
                            aria-label="Default select example">
                            <option value="" disabled selected>Seleziona la categoria del libro</option>

                            @foreach ($categories as $c)
                                @if ($book->category->id == $c->id)
                                    <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                @endif
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach

                        </select>

                        <div class="form-group my-2">
                            <small>Prezzo</small>
                            <input value="{{ $book->price }}" required placeholder="Prezzo €" type="currency"
                                min="0.01" step="any" name="price" class="form-control" />
                        </div>
                    </div>
                    <div class="d-grid gap-2 m-5">
                        <button type="submit" class="btn btn-primary">Modifica Libro</button>
                    </div>
                </div>

               


            </form>


        </div>
    </div>






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
                    label.textContent = label.getAttribute('data-browse');
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
