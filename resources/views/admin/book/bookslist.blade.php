@extends('layouts.admin')


@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>

    <style>
        .custom-file-input:lang(it)~.custom-file-label::after {
            content: "Sfoglia";
        }

        .custom-file-input~.custom-file-label::after {
            content: "Inserisci Immagine di copertina";
        }
    </style>
    <div class="container-fluid">

        @include('admin.book.col.col')
    </div>

    @include('admin.book.modal')

    <script>
        function openModal(idElement) {
            $(idElement).modal('show');
        }

        function closeModal(idElement) {
            $(idElement).modal('hide')
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFile = document.getElementById('img');
            const label = inputFile.nextElementSibling;

            inputFile.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    label.textContent = file.name;
                } else {
                    // Non è necessario modificare questo codice
                    label.textContent = label.getAttribute('datae-oooo');
                }
            });
        });


        // live search
        <
        script >
            $(document).ready(function() {
                $('.select2').select2();
            });
    </script>

    </script>
@endsection
