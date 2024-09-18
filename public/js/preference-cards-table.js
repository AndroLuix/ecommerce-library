
$(document).ready(function() {
    // Funzione per mostrare la vista salvata
    function applyUserSelection() {
        var selectedView = localStorage.getItem('selectedView');
        if (selectedView === 'new-cards') {
            $('#list-table').hide();
            $('#list-new-cards').show();
        } else {
            // Default o se l'utente ha scelto "Cards"
            $('#list-table').show();
            $('#list-new-cards').hide();
        }
    }

    // Applica la selezione dell'utente salvata
    applyUserSelection();

    // Evento click sul bottone "Cards"
    $('#cardsBtn').on('click', function() {
        $('#list-table').show();
        $('#list-new-cards').hide();
        localStorage.setItem('selectedView', 'cards'); // Salva la selezione
    });

    // Evento click sul bottone "New Cards"
    $('#newCardsBtn').on('click', function() {
        $('#list-table').hide();
        $('#list-new-cards').show();
        localStorage.setItem('selectedView', 'new-cards'); // Salva la selezione
    });
});