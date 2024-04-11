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