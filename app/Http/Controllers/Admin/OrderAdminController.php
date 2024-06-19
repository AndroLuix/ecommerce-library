<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MailBackOrder;
use App\Mail\MailSendOrder;
use App\Models\Book;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use Exception;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $result = $request->type;
        $search = $request->input;
        $queryLike =   '%' . $search . '%';
        $queryLikeAddress =   '%' . $search . '%';
    
        if(isset($search)){
            $orders = OrderItem::has('payment')
            ->whereHas('user', function ($query) use ($queryLike) {
                $query->where('name', 'like', $queryLike)
                      ->orWhere('email', 'like', $queryLike);
            })
            ->whereHas('address', function ($query) use ($queryLikeAddress) {
                    $query->orWhere('user_address', 'like', $queryLikeAddress)
                          ->orWhere('city', 'like', $queryLikeAddress)
                          ->orWhere('postal_code', 'like', $queryLikeAddress)
                          ->orWhere('country', 'like', $queryLikeAddress)
                          ->orWhere('telephone', 'like', $queryLikeAddress)
                          ->orWhere('mobile', 'like', $queryLikeAddress);
                })
            ->orderBy('orders.user_id', 'desc')
            ->paginate(20)
            ->appends('input', $search);
        
        
        }else{
            $orders = match ($result) {
                null => OrderItem::has('payment')->orderBy('orders.user_id','desc')->paginate(20),
                
                'spediti' => OrderItem::has('paymentNotSend')
                ->orderBy('orders.user_id','desc')->paginate(20),
    
                'nonspediti' =>  OrderItem::has('paymentSend')
                ->orderBy('orders.user_id','desc')->paginate(20),
    
                'tutti' => OrderItem::has('payment')->orderBy('orders.user_id','desc')
                ->paginate(20),
            };
        }
        
        
        return view('admin.order.order',compact('orders'));


    }

    public function send(OrderItem $order)
    {
        try {
            $order->payment->confirmed = true;
            $order->payment->save();

            $user = $order->user;

            $pickAndSendQuantityBooks = $this->PickFromWarehouse($order);

            Mail::to($user->email)->send(new MailSendOrder($order));

            return redirect()->back()->with('success', "Ordine inviato con successo! $pickAndSendQuantityBooks libri sono stati prelevati dal magazzino. Mail inviata a $user->email");
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Errore nell'invio dell'ordine: " . $e->getMessage());
        }
    }
    // annulla ordine e ripristina libri nel magazzino
    public function backOrder(OrderItem $order){

        
        $order->payment->confirmed = false;
        $order->payment->save();
        $user = $order->user;
        $back = $this->backOrderInMagazine($order);
        
        Mail::to($user->email)->send(new MailBackOrder($order));
        
        return redirect()->back()->with('success','Ordine Annullato con Successo!! '.$back. ' Libri inseriti nel magazzino. Mail inviata a '. $user->email);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

  
     /**
      * Questa funzione serve per aggiungere nel magazzino la quantità di libri per gli ordini annullati / non spediti
      */

      public function PickFromWarehouse(OrderItem $order)
    {
        $quantity = $order->quantity;
        $book = Book::find($order->book_id);

        if (!$book) {
            throw new Exception("Il libro non esiste.");
        }

        if ($book->quantity < $quantity) {
            throw new Exception("Libro $book->title esaurito, non è stato possibile effettuare l'ordine.");
        }

        $book->quantity -= $quantity;
        $book->save();

        return $quantity;
    }
    public function backOrderInMagazine(OrderItem $order){
        $backQuantity = $order->quantity;
        $book = Book::find($order->book_id);
        $book->quantity += $backQuantity;
        $book->save();

        return $backQuantity;
    }
    public function delete(OrderItem $order)
    {
        // Eliminando l'ordine si invierà una mail di eliminazione ordine

        
      

        //invio email all'utente
        $user = $order->user;
        Mail::to($user->email)->send(new MailBackOrder($order));

        // eliminazione dell'ordine
        $order->delete();
        /**
         * Importante: bisegnerebbe rimborsare, ma siccome è una simulazione non è previsto ciò
         */
        return redirect()->back()->with('success','Ordine Eliminato definitvamente con Successo!! Mail inviata al cliente');


    }
}
