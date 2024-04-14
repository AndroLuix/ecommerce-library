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