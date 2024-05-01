<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $table = 'order_payments';
    protected $fillable = [
        'order_id',
        'card_credit_id',
        'mark',
        'amount',
        'transiction_id'
    ];

    public function order(){
        return $this->belongsTo(OrderItem::class,'order_id');
    }
    public function orderReturn(){
        return $this->hasOne(OrderReturn::class);
    }
    
}
