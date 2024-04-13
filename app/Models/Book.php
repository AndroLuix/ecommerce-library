<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'image',
        'author',
    ];

    public function category(){
       return $this->belongsTo(Category::class);
    }

   /*  public function order(){
      return   $this->belongsTo()
    }
 */
}
