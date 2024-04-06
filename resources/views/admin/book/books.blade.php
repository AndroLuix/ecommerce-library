@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

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


                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-around">
                            <h3>Inserisci un nuovo libro</h3>

                            <div class="d-flex gap-3 pb-1">
                                @if (count($categories) > 0)
                                    <button onclick="openModal('#bookModal')" class="btn btn-primary">Nuovo Libro</button>
                                @endif
                                <button onclick="openModal('#cateogryoModal')" class="btn btn-secondary">Nuova
                                    Categoria</button>
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
                <form action="{{ route('admin.book.create') }}" method="POST">
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
                        <select class="form-select" placeholder="Seleziona Categroia" required
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
@endsection
