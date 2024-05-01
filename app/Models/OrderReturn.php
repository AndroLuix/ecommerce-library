<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_payment_id'; // specifica la chiave primaria
    public $incrementing = false; // evita l'autoincrement 
    protected $fillable = [
      'order_payment_id',
        'motivation',
        'returned',
    ];

    public function payment(){
        return $this->belongsTo(OrderPayment::class,'order_payment_id');
    }

    
}
