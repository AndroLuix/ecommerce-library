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
        $books = Book::orderBy('updated_at', 'desc')->get();
        $categories = Category::all();
        
        return view('home',compact('books','categories'));
    }

    public function show( Request $request)
    {
        
        $categoryId = $request->all();

        if($categoryId['category_id'] == 'tutti'){
            return redirect()->route('home');
            
        }
        
        $categories = Category::all();
     
        $books = Book::orderBy('updated_at', 'desc')->where('category_id', $categoryId['category_id'])->get();
        //dd($books);
        return view('home', compact('books','categories'));
    }

    public function showCateogry($category_name){
        $categories = Category::all();
        $category_selected = Category::where('name',$category_name)->first();
        
        $books = Book::orderBy('updated_at','desc')->where('category_id',$category_selected->id)->get();
        return view('home',compact('books','categories'));
    }
}
