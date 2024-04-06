<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'price',
        'image',
        'author',
        
    ];

}
