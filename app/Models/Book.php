<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
   use HasFactory;

   protected $fillable = [
      'category_id',
      'discount_id',

      'title',
      'description',
      'price',
      'image',
      'author',
   ];

   public function category()
   {
      return $this->belongsTo(Category::class);
   }

   public function discount(){
      return $this->belongsTo(Discount::class);
   }

   /*  public function order(){
      return   $this->belongsTo()
    }
 */
}
