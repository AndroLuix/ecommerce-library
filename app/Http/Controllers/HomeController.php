<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Book::all();
        $categories = Category::all();
        
        return view('home',compact('books','categories'));
    }

    public function show( Request $request)
    {
        $categoryId = $request->all();
        
        $categories = Category::all();
     
        $books = Book::orderBy('updated_at', 'desc')->where('category_id', $categoryId['category_id'])->get();
        //dd($books);
        return view('home', compact('books','categories'));

    }
}
