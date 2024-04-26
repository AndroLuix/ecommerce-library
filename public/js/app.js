function showButton(buttonId) {
    $(buttonId).show('slow');
}

function openModal(idElement) {
    $(idElement).modal('show');
}
function openModalPagination(idElement){
    $(idElement).modal('show');
}

function closeModal(idElement) {
    $(idElement).modal('hide')
}

// funzione filtri ricerca per card e table per books
function searchItems() {
    var input, filter, cards, card, title, rows, row, i, txtValue;

    // Otteniamo l'input di ricerca
    input = document.getElementById("searchBook");

    // Convertiamo il testo di ricerca in maiuscolo per rendere la ricerca case-insensitive
    filter = input.value.toUpperCase();

    // Cerchiamo nelle carte
    cards = document.getElementsByClassName("cardbook");
    for (i = 0; i < cards.length; i++) {
        card = cards[i];
        title = card.querySelector(".propriety-card");
        txtValue = title.textContent || title.innerText;

        // Mostra o nascondi la carta in base al testo di ricerca
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    }

    // Cerchiamo nelle righe della tabella
    var rows = document.getElementsByTagName("tr");
    var filter = filter.toUpperCase(); // Converte il testo di ricerca in maiuscolo una volta per tutte

    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        var cells = row.getElementsByTagName("td"); // Selezioniamo tutti i td all'interno della riga

        // Mostra o nascondi la riga in base al testo di ricerca
        if (filter) {
            var found = false;
            for (var j = 0; j < cells.length; j++) {
                var txtValue = cells[j].textContent || cells[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break; // Esci dal ciclo se trovi una corrispondenza
                }
            }
            row.style.display = found ? "" : "none";
        } else {
            row.style.display = ""; // Mostra tutte le righe se il testo di ricerca è vuoto
        }
    }

}
