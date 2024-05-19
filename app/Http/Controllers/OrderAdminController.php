<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\OrderPayment;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;

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

    public function send(OrderItem $order){

        $order->confirmed = true;
        $order->save();
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
