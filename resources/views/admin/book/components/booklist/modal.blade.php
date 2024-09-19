<style>
    .custom-modal .modal-dialog {
    max-width: 80%;
}

.custom-modal .modal-content {
    border-radius: 0;
}

</style>

<!-- Modali Personalizzati -->
<div class="modal custom-modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookModalLabel">Inserisci un libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.book.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group my-2">
                        <input required placeholder="Titolo" type="text" name="title" class="form-control" />
                    </div>
                    <div class="form-group my-2">
                        <textarea required name="description" class="form-control" cols="50" rows="20" placeholder="Inserisci una descrizione..."></textarea>
                    </div>
                    <div class="form-group my-2">
                        <input required placeholder="Autore" max="50" type="text" name="author" class="form-control" />
                    </div>
                    <div class="form-group my-2">
                        <input type="file" hidden id="img" name="image" accept="image/*" class="custom-file-input">
                        <label class="custom-file-label btn btn-outline-primary" for="img" data-browse="Inserisci immagine di copertina"></label>
                    </div>
                    <img id="blah" class="m-2" width="100px" height="200" src="#" alt="Inserisci l'immagine" />
                    <select class="form-select" name="category_id" placeholder="Seleziona Categoria" required aria-label="Default select example">
                        <option value="" disabled selected>Seleziona la categoria del libro</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    <div class="form-group my-2 d-flex flex-row gap-2">
                        <input required placeholder="Prezzo €" style="width: 40%" type="number" min="0.01" step="any" name="price" class="form-control" />
                        <input required placeholder="Quantità Magazzino" style="width: 40%" type="number" min="1" name="quantity" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Crea Libro</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal custom-modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Inserisci una Nuova Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.category.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group my-2">
                        <input required placeholder="Nome della nuova categoria" type="text" name="name" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crea Categoria</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Script per aprire i modali -->
<script>
function openModal(id) {
    $(id).modal('show');
}

function toggleList(id) {
    $(id).toggle();
}
</script>

