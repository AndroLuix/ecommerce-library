<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;
    protected $table = 'credit_cards';

    protected $fillable = [
        'user_id',
        'name', // titolare carta
        'number',
        'expiration', //scadenza
        'is_favorite'

    ];

    protected $hidden = 
    [
        'cvv'
    ];
    
}
