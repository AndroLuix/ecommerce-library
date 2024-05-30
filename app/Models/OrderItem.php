<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'quantity',
        'nel_carrello',
        'TotalPrice',
    ];

    public function product(){
       return  $this->belongsTo(Book::class, 'book_id');
    }
    

    public function user(){
        return $this->belongsTo((User::class),'user_id');
    }
    public function address(){
        return $this->belongsTo(Address::class,'address_id');
    }

    public function payment(){
        return $this->hasOne(OrderPayment::class,'order_id');
    }

    public function paymentNotSend(){
        return $this->hasOne(OrderPayment::class,'order_id')
        ->where('confirmed', 1);
    }
    public function paymentSend(){
        return $this->hasOne(OrderPayment::class,'order_id')
        ->where('confirmed', 0);
    }

    public function reso(){
        return $this->hasOne(OrderPayment::class,'order_id')->with('orderReturn');
    }


   
}
