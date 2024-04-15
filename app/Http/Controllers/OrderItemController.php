<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Card;
use App\Models\cardUser;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\UserCards;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($userId)
    {
        if (!Auth::check()) {
            return redirect()->route('home')->withErrors('Bisogna Iscriversi per visualizzare le altre pagine');
        }

        $cart = OrderItem::where('user_id', Auth::id())->where('status','Nel Carrello')->get();
        return view('user.cart.cart', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('home')->withErrors('Bisogna Iscriversi per visualizzare le altre pagine');
        }

        $data = $request->all();

        $book = Book::find($data['book_id']);
        $data['user_id'] = Auth::id();
        //dd($book);
        $data['TotalPrice'] = $book->price;

        OrderItem::create($data);

        return back()->with('success', 'Ordine dell\'Articolo Aggiunto');
    }

    public function plus($orderId)
    {
        // Trova l'elemento nel carrello
        $orderItem = OrderItem::findOrFail($orderId);

        // Aggiungi una quantità
        $orderItem->quantity += 1;
        $orderItem->TotalPrice +=$orderItem->product->price;
        $orderItem->save();

      
        // Restituisci una risposta JSON o reindirizza a una pagina appropriata
        return response()->json(['success' => true]);
    }

    public function minus($orderId)
    {
        // Trova l'elemento nel carrello
        $orderItem = OrderItem::findOrFail($orderId);

        // Verifica se la quantità è maggiore di 1 prima di diminuire
        if ($orderItem->quantity > 1) {
            // Rimuovi una quantità
            $orderItem->quantity -= 1;
            $orderItem->TotalPrice -=$orderItem->product->price;
            $orderItem->save();
        }

        // Restituisci una risposta JSON o reindirizza a una pagina appropriata
        return response()->json(['success' => true]);
    }

    public function getCarrelloData($orderId)
    {
        // Recupera l'ordine dal database utilizzando l'ID
        $orderUp = OrderItem::find($orderId);

        // Verifica se l'ordine esiste
        if (!$orderUp) {
            // Se l'ordine non esiste, restituisci un messaggio di errore o un array vuoto
            return response()->json(['error' => 'Ordine non trovato'], 404);
        }

        // Recupera i dettagli dei prodotti nel carrello dell'ordine
        // Recupera il dettaglio del prodotto associato a questo ordine
        $quantity = $orderUp->quantity;

        // Calcola il totale del carrello per questo ordine
        $totalPrice = $orderUp->product->price * $orderUp->quantity;

        // Costruisci e restituisci un array JSON con i dati del carrello
        return response()->json([
            'quantity' => $quantity,
            'totalPrice' => round($totalPrice,2),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderItem $orderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return back();
    }
}
