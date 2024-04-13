<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCards extends Model
{
    use HasFactory;

    protected $table = 'cards_user';

    protected $fillable = [
        'id',
        'user_id',
        'cards_id',
    ];
}
