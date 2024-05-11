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
            content: "Cambia Immagine di copertina";
        }
    </style>
    <div class="container col-md-12">
        <div class="row justify-content-around">


           


            <form action="{{ route('admin.book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body con-md-8">
                    <!-- Aggiungi qui il tuo form per inserire un libro -->

                    <div class="d-flex flex-row gap-3 justify-content-around my-3">

                        <small>Titolo</small>
                        <input required placeholder="Titolo" value="{{ $book->title }}" maxlength="30" type="text" name="title"
                            class="form-control" />

                        <small>Autore</small>
                        <input value="{{ $book->author }}" required placeholder="Autore" maxlength="30" type="text"
                            name="author" class="form-control" />

                            
                        <small>Quantità in magazzino</small>
                        <input value="{{ $book->quantity }}" required placeholder="Quantità" 
                         type="number" 
                            name="quantity" class="form-control" />

                            

                    </div>

                    <select class="form-select mt-2 bg-warning" name="discount_id" placeholder="Seleziona Categroia" 
                        aria-label="Default select example" >
                        <option value="" disabled selected><i>Seleziona Sconto - opzionale</i></option>
                        @foreach ($discounts as $d)
                            @if ($d->id == $book->discount_id)
                            <option value="{{ $d->id }}" selected>{{ $d->name }} | <strong style="color: green">{{$d->percent}}%</strong></option>

                            @endif
                            <option value="{{ $d->id }}">{{ $d->name }} | <strong style="color: green">{{$d->percent}}%</strong></option>
                        @endforeach

                    </select>



                    <div class="d-flex flex-row gap-3 justify-content-around my-3">
                        <img id="oldImg" width="180" height="330" src="{{ asset($book->image) }}">
                        <img id="blah" style="display: none" class="m-2" src="#"
                        alt="Inserisci l'immagine" />
                        <small>Descrizione</small>
                        <textarea required name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $book->description }}</textarea>
                       
                    </div>


                    

                    <div  class="col-md-8 mt-5">
                        <div class="form-group my-2">
                            <input type="file" hidden id="img" name="image" accept="image/*" 
                            class="custom-file-input" onchange="readURL(this); hiddenOldImg('oldImg') ">

                            <label class="custom-file-label btn btn-outline-primary" for="img"
                                data-browse="Inserisci immagine di copertina">
                            </label>
                        </div>







                        <small>Categoria</small>
                        <select class="form-select" name="category_id" placeholder="Seleziona Categroia" required
                            aria-label="Default select example">
                            <option value="" disabled selected>Seleziona la categoria del libro</option>

                            @foreach ($categories as $c)
                                @if ($book->category->id == $c->id)
                                    <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                @endif
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach

                        </select>

                        <div class="form-group my-2">
                            <small>Prezzo</small>
                            <input value="{{ $book->price }}" required placeholder="Prezzo €" type="currency"
                                min="0.01" step="any" name="price" class="form-control" />
                        </div>
                    </div>
                    <div class="d-grid gap-2 m-5">
                        <button type="submit" class="btn btn-primary">Modifica Libro</button>
                    </div>
                </div>




            </form>


        </div>
    </div>








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
                    label.textContent = label.getAttribute('data-browse');
                }
            });
        });





        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });




        
        function hiddenOldImg(idElement) {
           let elementImg = document.getElementById(idElement);
           $('#blah').show()
            elementImg.style.display = 'none';
        }
    </script>

@endsection
