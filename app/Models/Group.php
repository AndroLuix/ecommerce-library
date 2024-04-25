<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'group';

    protected $fillable = [
        'name',
           
     ];

    public function books(){
        return $this->hasMany(Book::class);
    }

}
