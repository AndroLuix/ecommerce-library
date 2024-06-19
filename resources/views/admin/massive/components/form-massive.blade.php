<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>

<div class="">
    <div class="card-header d-flex flex-row flex-warp">
        <p class="btn btn-outline-primary " style="font-weight: 700">
            {{ __('Aggiungi Sconto massivo') }}:</p>
{{--         <div class="ms-2"> <button onclick="openModal('#scontiModal')" class="btn btn-dark">Crea un nuovo Sconto</button></div>
 --}}    </div>

    <div class="">
        @if (session('status'))
            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
        @endif

        <!-- messaggi di errore e di successo -->

        <form action="{{ route('admin.massive.create') }}" method="POST"> 
            @csrf
            <div class="row">
                <!-- select offerta -->
                <div class="form-group ">
                    <small>Seleziona Offerta</small>
                    <select class="form-control" name="discount_id" id="select-discount">
                        @foreach ($discounts as $discount)
                            <option class="" value="{{ $discount->id }}">
                                {{ $discount->name }}
                                {{ $discount->percent }} <strong style="color: green">%</strong>
                            </option>
                        @endforeach
                    </select>
                </div>

            
                  
                <!-- SELECT BOOKS -->
                <div class="form-group mt-3">
                    <select class="form-control selectpicker " 
                    id="select-book" onchange="ListBooks()" 
                    data-live-search="true">
                        @foreach ($books as $book)
                            <option data-title="{{ $book->title }}" data-id="{{ $book->id }}" data-author="{{ $book->author }}" data-price="{{ $book->price }}">
                                {{ $book->title }} Autore: {{ $book->author }} | € {{ $book->price }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <div class="card">
                        <!-- name del massive -->
                        <input type="text" class="bg-dodge p-2 rounded focus-bg-white form-control" name="name" value="Inserisci titolo del massive">
                    </div>
                    <div class="card-body">
                        <div action="" id="form-massive">
                            <!-- qui verranno inseriti i libri selezionati -->
                        </div>
                    </div>
                    <button id="button-massive" class="btn btn-dark mt-3" style="display: none">Crea il massive</button>
                </div>
            </div>
        </form>
    </div>
</div>

