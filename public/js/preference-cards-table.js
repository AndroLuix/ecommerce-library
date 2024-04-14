$(document).ready(function() {
    // Controlla se è presente un cookie per l'impostazione delle visualizzazioni
    var viewSetting = $.cookie('viewSetting');
    if (viewSetting === 'table') {
        // Nasconde le cards se l'impostazione salvata è "table"
        $("#list-cards").hide();
        $("#list-table").show();
    } else if (viewSetting === 'cards') {
        // Nasconde la tabella se l'impostazione salvata è "cards"
        $("#list-table").hide();
        $("#list-cards").show();
    }

    // Gestisce il clic sulle opzioni "Tabella" e "Cards"
    $(".toggle-view").click(function() {
        // Se l'elemento cliccato è "Tabella"
        if ($(this).hasClass("tables")) {
            $("#list-cards").hide();
            $("#list-table").show();
            // Salva l'impostazione nell cookie per una settimana
            $.cookie('viewSetting', 'table', { expires: 7, path: '/' });
        }
        // Se l'elemento cliccato è "Cards"
        else if ($(this).hasClass("cards")) {
            $("#list-table").hide();
            $("#list-cards").show();
            // Salva l'impostazione nell cookie per una settimana
            $.cookie('viewSetting', 'cards', { expires: 7, path: '/' });
        }
    });
});
