<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // se ha la carta
        if (CreditCard::where('user_id', Auth::id())) :
            //
            $data = $request->all();
            dd($data);
            foreach ($data as $id) {
                OrderPayment::create();
            }
        else:
            return redirect()->route('user.newcard')->with('success','Inserisci Metodo di pagamento');
        endif;
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
    public function show(OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderPayment $orderPayment)
    {
        //
    }
}
