<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\OrderDetail;
use Illuminate\Http\Request;


class AdminDetailsController extends Controller
{
    public function index(){
        $orderDetails = OrderDetail::distinct('order_id')->paginate(20);

        return view('admin.order.order',compact('orderDetails'));
    }
}
