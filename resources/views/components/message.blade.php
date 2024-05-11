<div class="card-body">

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <!-- gestione errori -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Errore!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- gestione successo -->
    @if (session('success'))
        <div class="alert alert-success">
            <strong>Inviato!</strong>
            {{ session('success') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">

            {{ session('warning') }}<strong>!</strong>
        </div>
    @endif

    @if (session('primary'))
        <div class="alert alert-primary">
            <strong>Info</strong>
            {{ session('primary') }}
        </div>
    @endif

</div>
