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
                <div class="card">
                    <div class="card-header">Libri</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-around">

                            <div class="d-flex flex-row flex-wrap gap-3 pb-1">
                                @foreach ($books as $book)
                                    {{--   <div class="card" style="width: 18rem;">
                                        <img src="{{ asset($book->image) }}" class="card-img-" alt="...">
                                        <div class="card-body">
                                          <h5 class="card-title">{{$book->title}}</h5>
                                          <p class="card-text">Categoria: <strong>{{$book->category->name}}</strong></p>
                                          <hr>
                                          <p class="card-text">{{$book->description}}</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                          <li class="list-group-item">Prezzo {{$book->price}} €</li>
                                          <li class="list-group-item"><small>Pubblicato il {{$book->created_at}}</small></li>
                                          <li class="list-group-item"><small>Ultima Moodifica {{$book->updated_at}}</small></li>
                                        </ul>
                                        <div class="card-body">
                                          <a href="#" class="card-link">Modifica</a>
                                          <a href="#" class="card-link">Elimina</a>
                                        </div>
                                      </div> --}}

                                    <div class="card flex-row">
                                        <div>
                                            <img class="card-img-left example-card-img-responsive" width="180px"
                                                height="300px" src="{{ asset($book->image) }}" />

                                            <div class="card-body d-flex flex-row justify-content-around">

                                                <form action="{{ route('admin.book.delete', $book->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        onclick="return confirm('Sicuro di voler eliminare il libro {{ $book->title }}?')"
                                                        type="submit" class="card-link btn btn-outline-danger">Elimina
                                                    </button>
                                                </form>

                                                <a href="#" class="card-link btn btn-outline-primary" style="margin-left:10px">Modfica</a>

                                            </div>
                                        </div>

                                        <div class="card-body " style="width: 16rem">
                                            <div class="card-body col-md-12">
                                                <h5 class="card-title">{{ $book->title }}</h5>
                                                <p class="card-text">{{ $book->author }}</p>

                                                <p class="card-text">Categoria:
                                                    @isset($book->category->name)
                                                        <strong>{{ $book->category->name }}</strong>
                                                    </p>
                                                @endisset
                                                <hr>
                                            </div>
                                            <ul class="list-group list-group-flush col-md-10">
                                                <li class="list-group-item">Prezzo {{ $book->price }} €</li>
                                                {{--  <li class="list-group-item"><small>Pubblicato il {{$book->created_at}}</small></li>
                                                <li class="list-group-item"><small>Ultima Moodifica {{$book->updated_at}}</small></li> --}}
                                            </ul>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>


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

                <div class="card mt-5">
                    <div class="card-header">Filtra Per Categoria</div>
                    <div class="card-body">
                        <div class="d-flex gap-3 pb-1">
                            @if (count($categories) > 0)
                            <form action="" method="GET">
                                <select class="form-select select2" name="category_id" aria-label="multiple select example">
                                    <option selected disabled>Seleziona Categoria</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                
                                </form>
                            @else
                                <h5>Nessuna Categoria Presente</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </div>
    </div>

    <!-- Modal book -->
    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel">Inserisci un libro</h5>

                </div>
                <form action="{{ route('admin.book.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Aggiungi qui il tuo form per inserire un libro -->

                        <div class="form-group my-2">
                            <input required placeholder="Titolo" type="text" name="title" class="form-control" />
                        </div>

                        <div class="form-group my-2">
                            <input required placeholder="Descrizione" max="50" type="text" name="description"
                                class="form-control" />
                        </div>

                        <div class="form-group my-2">
                            <input required placeholder="Autore" max="50" type="text" name="author"
                                class="form-control" />
                        </div>

                        <div class="form-group my-2">
                            <input type="file" hidden id="img" name="image" accept="image/*"
                                class="custom-file-input">
                            <label class="custom-file-label btn btn-outline-primary" for="img"
                                data-browse="Inserisci immagine di copertina"></label>
                        </div>


                        <select class="form-select" name="category_id" placeholder="Seleziona Categroia" required
                            aria-label="Default select example">
                            <option value="" disabled selected>Seleziona la categoria del libro</option>

                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach

                        </select>

                        <div class="form-group my-2">
                            <input required placeholder="Prezzo €" type="currency" min="0.01" step="any"
                                name="price" class="form-control" />
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Crea Libro</button>
                        <button type="button" class="btn btn-secondary" onclick="closeModal('#bookModal')"
                            data-dismiss="modal">Chiudi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal category -->
    <div class="modal fade" id="cateogryoModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel">Inserisci un libro</h5>

                </div>
                <form action="{{ route('admin.cateogory.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group my-2">
                            <input required placeholder="Nome della nuova categoria" type="text" name="name"
                                class="form-control" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Crea Categoria</button>

                        <button type="button" class="btn btn-secondary" onclick="closeModal('#cateogryoModal')"
                            data-dismiss="modal">Chiudi</button>
                    </div>
                </form>
            </div>
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
                    label.textContent = label.getAttribute('datae-oooo');
                }
            });
        });


        // live search
        <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

    </script>
@endsection
