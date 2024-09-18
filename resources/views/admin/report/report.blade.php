@extends('layouts.admin')

@section('content')
    <div class="container">


        <h2>Vendite dei libri</h2>
        <table id="myTable" class="table table-striped table-dark display">
            <thead>
                <tr>
                    <th scope="col">Vendite</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Prezzo</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->sales_count }}</td>

                        <td>
                             {{ $book->title }}
                        </td>

                        <td>{{ $book->price }}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>



    <script>
        // per la tab responsive
        let table = new DataTable('#myTable', {
            scrollCollapse: true,

            scrollY: '400px',
            paging: false,
        });
    </script>



    <script src="{{ asset('js/modal.js') }}"></script>
@endsection
