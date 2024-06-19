<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    //

    public function index(){
        $books = Book::orderBy('quantity','DESC')->get();

        return view('admin.warehouse.warehouse',compact('books'));
    }

    public function changeQuantity(Request $request){
        
        $book = Book::find($request->book_id);
        $book->quantity = $request->quantity;
        $book->save();
        return response()->json(['success' => true]);
    }
    public function add($book_id){
        
        $book = Book::find($book_id);
        $book->quantity + 1;
        $book->save();
    }
    public function minus($book_id){
        $book = Book::find($book_id);
        $book->quantity -1;
        $book->save();
    }
}
