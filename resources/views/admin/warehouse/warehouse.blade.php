@extends('layouts.admin')

@section('content')
    <div class="container">


        <table id="myTable" class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Quantità</th>
                    <th scope="col">Libro</th>
                    <th scope="col">Autore</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($books as $book)
                    <tr>
                        <th scope="row">{{ $book->id }}</th>
                        <td>
                            <input type="number" oninput="changeQuantity('{{ $book->id }}')" name="quantity" 
                                id="book-{{ $book->id }}" value="{{ $book->quantity }}">
                                <span class="text-success" id="msg-{{$book->id}}" style="display: none"></span>
                        </td>

                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>



    <script>
        // per la tab responsive
        let table = new DataTable('#myTable', {
            scrollCollapse: true,

            scrollY: '500px',
            paging: false,
        });

        function changeQuantity(bookId) {
        let quantity = document.getElementById('book-' + bookId).value;
        let message = document.getElementById('msg-' + bookId);


        if (quantity < 0) {
        message.style.display = 'block';
        message.classList.add('text-danger');
        message.textContent = "Errore, non inserire numeri negativi!";
        setTimeout(() => {
            message.style.display = 'none';
            message.classList.remove('text-danger');
        }, 4000);
        return; // Esce dalla funzione se l'input è negativo
    }

        axios.get('/admin/warehouse/update-quantity', {
                params: {
                    book_id: bookId,
                    quantity: quantity
                }
            })
            .then(response => {
                console.log('Quantity updated successfully');
                message.style.display = 'block';
                message.classList.add('text-success');
                message.textContent="Aggiornato"
                setTimeout(() => {
                    message.style.display = 'none';
                    message.classList.remove('text-success')


                }, 2000);

            })
            .catch(error => {
                console.error('There was an error updating the quantity:', error);
                message.style.display = 'block';
                message.classList.add('text-danger');
                message.textContent="Errore, Riprova"
                setTimeout(() => {
                    message.style.display = 'none';
                    message.classList.remove('text-danger');

                }, 2000);
            });
    }




    </script>



    <script src="{{ asset('js/modal.js') }}"></script>
@endsection
