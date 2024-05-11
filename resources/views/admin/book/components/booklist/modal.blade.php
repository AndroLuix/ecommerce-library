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
                        <textarea required name="description"
                            class="form-control" cols="50" rows="20" placeholder="Inserisci una descrizione..." /></textarea>
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
                    <!-- visualizza immagine : premette di visualizzare l'immagine grazie 
                        a una funzione jquery, non modificare l'id dell'input ne di questo tag img -->
                    <img id="blah" class="m-2" width="100px" height="200" src="#" alt="Inserisci l'immagine" />


                    <select class="form-select" name="category_id" placeholder="Seleziona Categroia" required
                        aria-label="Default select example" >
                        <option value="" disabled selected>Seleziona la categoria del libro</option>

                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach

                    </select>

                    
              



                    <div class="form-group my-2 d-flex flex-row gap-2">
                        <input required placeholder="Prezzo €" style="width: 40%" type="currency" min="0.01" step="any"
                            name="price" class="form-control" />
                            <input required placeholder="Quantità Magazzino" style="width: 40%"  type="number" min="1" 
                            name="quantity" class="form-control" />
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
                <h5 class="modal-title" id="bookModalLabel">Inserisci una Nuova Categoria</h5>

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
                    <button type="submit" class="btn btn-primary" >Crea Categoria</button>

                    <button type="button" class="btn btn-secondary" onclick="closeModal('#cateogryoModal')"
                        data-dismiss="modal">Chiudi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit category -->
<div class="modal fade" id="categoryEditModal" tabindex="-1" aria-labelledby="categoryEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleForEdit"> </h5>

            </div>
            <form action="{{ route('admin.cateogory.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <!-- valore inserito da javascript -->
                    <input type="number" hidden name="id" >


                    <!-- valore che deve inserire l'admin -->
                    <div class="form-group my-2">
                        <input required placeholder="Modifica Nome"
                         type="text" name="name"  
                            class="form-control" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Modifica Categoria</button>

                    <button type="button" class="btn btn-secondary" onclick="closeModal('#categoryEditModal')"
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

    function editModalForCategory(idElement, idCategory, NameCategory) {
    $(idElement).find('input[name="id"]').val(idCategory);
    $(idElement).find('#titleForEdit').text('Modifica Categoria ' + NameCategory);
    $(idElement).find('input[name="name"]').val(NameCategory)
    $(idElement).modal('show');
}
    
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#img").change(function(){
    readURL(this);
})
</script>