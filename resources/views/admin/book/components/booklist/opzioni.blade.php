
    <div class="card">
        <div class="card-header mypointer" onclick="toggleList('#button-for-modal')">Inserisci Un Nuovo Libro
        </div>


        <div class="card-body" id="button-for-modal">
            <div class="d-flex gap-1">
                @if (count($categories) > 0)
                    <button onclick="openModal('#bookModal')" class="btn btn-primary  btn-sm"><small>Nuovo
                            Libro</small></button>
                @endif
                <button onclick="openModal('#cateogryoModal')" class="btn btn-secondary  btn-sm">
                    <small>Nuova
                        Categoria</small></button>
            </div>
        </div>
    </div>
