<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\BookReview;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class ReviewController extends Controller
{
   /**
    * FOR ADMIN
    */

   public function AdminIndex()
   {
      $reviews = BookReview::orderBy('created_at', 'desc')->paginate(40);


      $allRev = BookReview::all();
      $totalRatings = 0;
      $count = $allRev->count();

      foreach ($allRev as $rev) {
         $totalRatings += $rev->rating;
      }

      if ($count > 0) {
         $averageRating = $totalRatings / $count;
      } else {
         $averageRating = 0; 
      }


      return view('admin.review.review', compact('reviews','count','averageRating'));
   }

   public function destroy($clientID, $bookID)
   {
   BookReview::where('book_id', $bookID)->where('client_id', $clientID)->delete();

      return back()->with('success', 'Recensione eliminata con successo!');
   }
   public function search(Request $request)
   {
      $input = $request->input;
      $searchLike = "{$input}";
      $reviews = BookReview::where(function ($query) use ($searchLike) {
         $query->whereHas('user', function ($query) use ($searchLike) {
            $query->where('name', 'like', '%' . $searchLike . '%');
         })
            ->orWhereHas('book', function ($query) use ($searchLike) {
               $query->where('title', 'like', '%' . $searchLike . '%');
            })
            ->orWhere('rating', 'like', '%' . $searchLike . '%')
            ->orWhere('review_text', 'like', '%' . $searchLike . '%');
      })
         ->orderBy('created_at', 'desc')
         ->with('book', 'user')
         ->get();

      $allRev = BookReview::all();
      $totalRatings = 0;
      $count = $allRev->count();

      foreach ($allRev as $rev) {
         $totalRatings += $rev->rating;
      }

      if ($count > 0) {
         $averageRating = $totalRatings / $count;
      } else {
         $averageRating = 0; 
      }



      return view('admin.review.review', compact('reviews', 'count', 'averageRating'));
   }
}
