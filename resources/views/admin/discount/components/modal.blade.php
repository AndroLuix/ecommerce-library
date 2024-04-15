
<!-- Modal category -->
<div class="modal fade" id="scontiModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookModalLabel">Inserisci una Nuova Categoria</h5>

            </div>
            <form action="{{ route('admin.discount.create') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="form-group my-2">
                        <input required placeholder="Nome dello sconto" type="text" name="name"
                            class="form-control" />
                    </div>

                    <div class="form-group my-2">
                        <small>Inserisci solo la cifra, senza <i>"%"</i></small>
                        <input required placeholder="Percentuale %" type="number" step="0.01" name="percent"
                            class="form-control" />
                    </div>


                    

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Crea Sconto</button>

                    <button type="button" class="btn btn-secondary" onclick="closeModal('#scontiModal')"
                        data-dismiss="modal">Chiudi</button>
                </div>
            </form>
        </div>
    </div>
</div>
