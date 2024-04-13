<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Card;
use App\Models\cardUser;
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
        if(!Auth::check()){
            return redirect()->route('home')->withErrors('Bisogna Iscriversi per visualizzare le altre pagine');
        }

       $cart= OrderItem::where('user_id',Auth::id())->get();
        return view('user.cart.cart',compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( Request $request)
    {
        if(!Auth::check()){
            return redirect()->route('home')->withErrors('Bisogna Iscriversi per visualizzare le altre pagine');
        }
    
        $data = $request->all();

        $data['user_id'] = Auth::id();

       $orderItem =  OrderItem::create($data); 

       
     return back()->with('success','Ordine dell\'Articolo Aggiunto'); 
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
        //
    }
}
