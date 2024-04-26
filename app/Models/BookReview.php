<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReview extends Model
{
    use HasFactory; 
   // use HasCompositePrimaryKey;


   // protected $primaryKey = ['book_id', 'client_id'];

    protected $fillable = [
        'book_id',
        'client_id',
        'review_text',
        'rating',
        
    ];

}
