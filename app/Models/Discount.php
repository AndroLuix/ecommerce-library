<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    protected $fillable = [
        'name',
        'percent',
        'active',

    ];

   

    public function books(){
       return  $this->hasMany(Book::class,'discount_id');
    }
}
