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