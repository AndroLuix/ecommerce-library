<?php

namespace App\Http\Controllers;

use App\Models\BookReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * FOR ADMIN
     */

     public function AdminIndex(){
        $reviews = BookReview::orderBy('created_at','desc')->paginate(40);

        return view('admin.review.review',compact('reviews'));
     }

     public function destroy($clientID, $bookID){
        $review = BookReview::where('book_id',$bookID)->where('client_id',$clientID)->delete();

        return back()->with('success','Recensione eliminata con successo!');
     }
}
