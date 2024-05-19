# ADMIN
## Crud Categoria
- ✅ pulsante per creare una categoria (con controllo se già presente)
- ✅ Permettere all'admin di poter SOLO modificare la categoria scelta 

# LIBRI
## magazzino 
- ✅ inserire nel campo di creazione libro la quantità nel magazzino
- per il metodo delete, elimina il file  nello storage e public 

### barre di ricerca in sospeso
#### pagina lista utente
- controller e action nel form per la ricerca dell'utente
#### pagina recensioni
- controller e action nel form per la ricerca dell'della recensione
# SCONTI 
## CRUD sconti
- ✅ Modal per inserire Nuovi Sconti
- ✅ Crea possibilità di poter sospendere lo sconto per tutti i libri con quello specifico sconto
- ✅ possibilità di modificare e di eliminare  gli sconti

## CRUD MASSIVE
#### ✅ possibilità di fare sconti di diversi libri simultaneamente. 
- ✅ implementazione DB aggiungendo group table
- ✅ CRUD del 'massive'
- ✅ poter aggiungere altri libri nel singolo 'massive'
- [x] implementare funzioni js per poter vedere l'aggiunta del libro sulla pagina modifica massive

- [v] Pagina con possibilità poter vedere una lista di libri con specifici sconti:
Possibilità di vedere una tabella con tutti i prodotti scontati e non.
- Rimozione sconto del massive:
[v] aggiungere opzione per levare gli sconti
- [v] Modificare Modal per inserimento nuovo libro:
 

## Algoritmo per attivare lo sconto al singolo prodotto
- Modifica Pagina Book per admin:
ogni Book ha il proprio sconto, pertanto bisognerà applicare un algoritmo di scontistica
## pagina clienti: 
- ✅ Aggiungere i diversi indirizzi dei clienti
- aggiungere controller per tasto di ricerca

## CRUD Ordini
- [v] pagina ordini
- logica per confermare ordine
: ogni volta che l'admin accetta un ordine, verrà inviata tramite mail al cliente e admin i dettagli dell'ordine

-  pagina ordini reso
: il server, una volta che il cliente ha fatto il reso, invierà una mail all'admin e all'user



## ANALISI DATI
### visualizza pag. statistiche libri.
- libri più venduti con grafico
- zone dove sono iscritti gli utenti con mappa
- zone dove sono stati effettuati più ordini


// molto probabilmente ignorerò la parte clienti per il momento.

# CLIENTI
## aggiustare home per i libri che vedrà i clienti
link categoria
- dividere le cards per tipologia di libro e sconti
- libri più venduti
- inserire filtro per prezzo, recensione, sconto, tipologia
### Algoritmo per visualizzare lo sconto del singolo prodotto
- Modifica Pagina Book per cleinti:
ogni Book ha il proprio sconto, pertanto bisognerà applicare un algoritmo di scontistica.
1. mostrare il prezzo non scontato
2. mostrare la percentuale dello sconto
3. mostrare prezzo scontato

## Creazione pagina inserimento dati Carta di credito
- pagina con form per i dati
- tecnologia Encrypt
- Permettere la decriptazione
- l'utente può aggiungere più carte
- modificate tabella per selezionare la carta preferita

## Creazione pagina indirizzi Per i Clienti
- l'utente può aggiungere più indirizzo e numeri di telefono e mobile (nullable quest'utlime)
- creazione e gestione 
- modificare tabella indirizzo per poter inserire l'indirizzo preferito


# Implementazioni seedee DB 
- stressare il software
1. ✅ incrementare il numero di libri generati dal seedee
 permettere la paginazione sia per ecommerce che gestione libri
✅ implemntazione DB user con più indirizzi
2. [v] seeder per tutto


# implementazione DB e tanto altro
1. gestione ordini e tempistiche con costi di spedizione
2. gestione file PDF ed excel degli ordini 
3 permettere all'utente di inserire un file excel dei libri anziché mettere input manuali. trovare dataset con caratteristiche necessarie.
4. creazione grafici analisi dei dati.

