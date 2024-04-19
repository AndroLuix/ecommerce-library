@extends('layouts.admin')

@section('content')
<div class="container d-flex flex-column flex-wrap flex-lg-nowrap flex-md-wrap flex-sm-wrap flex-xs-wrap gap-y-1">
    <div class="row justify-content-between">
        <div class="col-lg-12 col-md-8 col-sm-8 col-12">
            <!-- form massive -->
            @include('admin.massive.components.massive-discounts')
        </div>
    </div>
    <div class="col-lg-10 col-md-8 col-sm-8 col-12">
        <!-- tabella con sconti -->
        @include('admin.massive.components.form-massive')
    </div>
</div>

    <!-- div massime lsit -->
    <div class="container d-flex flex-row ">
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-12">
                @include('admin.massive.components.massive-list')
            </div>
        </div>
    </div>


    @include('admin.discount.components.modal')

    <script src="{{ asset('js/modal.js') }}"></script>

    <script>
        function ListBooks() {
            let selectedOption = document.getElementById('select-book').querySelector('option:checked');

            // mostra bottone 
            let submitMassive = document.getElementById('button-massive');
            submitMassive.style.display = 'block';
            // il div che conterrà il massive
            let form = document.getElementById('form-massive');

            let bookTitle = selectedOption.getAttribute('data-title');
            let bookAuthor = selectedOption.getAttribute('data-author');
            let bookPrice = selectedOption.getAttribute('data-price');
            let bookId = selectedOption.getAttribute('data-id');



            // Creiamo un input nascosto per l'ID del libro
            let inputID = document.createElement('input');
            inputID.setAttribute('type', 'hidden');
            inputID.setAttribute('name', 'id[]');
            inputID.value = bookId;

            let inputTitle = document.createElement('p');
            // inputTitle.setAttribute('type', 'text');
            //inputTitle.setAttribute('name', 'title');
            inputTitle.setAttribute('class', ''); // Aggiungi la classe Bootstrap
            inputTitle.innerHTML = '<small>Titolo </small><br>' + bookTitle + ' ';

            let inpAuthor = document.createElement('p');
            //inpAuthor.setAttribute('type', 'text');
            //inpAuthor.setAttribute('name', 'author');
            inpAuthor.setAttribute('class', '');
            inpAuthor.innerHTML = '<small>Autore </small><br>' + bookAuthor + ' ';

            let inpPrice = document.createElement('p');
            // inpPrice.setAttribute('type', 'text');
            //inpPrice.setAttribute('name', 'price');
            inpPrice.setAttribute('class', 'mb-5');
            inpPrice.innerHTML = '<small>Prezzo </small><br>' + bookPrice;

            // separatore hr
            let hrSeparate = document.createElement('hr'); // Creiamo l'elemento hr
            hrSeparate.getAttribute('class', 'color-dark')

            // Aggiungiamo gli elementi al form
            form.appendChild(inputID);
            form.appendChild(inputTitle);
            form.appendChild(inpAuthor);
            form.appendChild(inpPrice);
            form.appendChild(hrSeparate); // Aggiungiamo l'elemento hr al form

        }

        $(function() {
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection
