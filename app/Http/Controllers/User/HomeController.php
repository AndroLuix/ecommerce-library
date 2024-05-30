<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

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
        $books = Book::orderBy('updated_at', 'desc')->paginate(25);
        $categories = Category::all();
        
        return view('home',compact('books','categories'));
    }

    public function show( Request $request)
    {
        
        $categoryId = $request->category_id;

        if($categoryId == 'tutti'){
            return redirect()->route('home');
            
        }
       
        
        $categories = Category::all();
     
        $books = Book::orderBy('updated_at', 'desc')
        ->where('category_id', $categoryId)
        ->paginate(25);
        return view('home', compact('books','categories','categoryId','request'));
    }

    public function showCateogry($category_name){
        $categories = Category::all();
     
        $category_selected = Category::where('name',$category_name)->first();
        
        $books = Book::orderBy('updated_at','desc')
        ->where('category_id',$category_selected->id)
        ->paginate(25);

        return view('home',compact('books','categories','category_name'));
    }
}
