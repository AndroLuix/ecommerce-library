<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';
    
    protected $fillable = [
        'user_id',
        'user_address',
        'city',
        'postal_code',
        'country',
        'telephone',
        'mobile',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
