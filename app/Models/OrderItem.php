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
        'inviato',
        'returned_order',
        'TotalPrice'
    ];

    public function product(){
       return  $this->belongsTo(Book::class, 'book_id');
    }
}
