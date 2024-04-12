<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // show dashboard with books with all categoires
        $categories = Category::all();
        $books = Book::orderBy('updated_at', 'desc')->get();
        return view('admin.book.bookslist', compact('books','categories'));
    }

    public function booksCategory(Request $request){
        
        $req = $request->all();

        if($req['category_id'] == 'tutti'){
            return redirect()->route('admin.book');
        }
        $categories = Category::all();
        $books = Book::orderBy('updated_at', 'desc')->where('category_id', $req['category_id'])->get();
        //dd($books);
        return view('admin.book.bookslist', compact('books','categories'));

    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        // validazione
        $rules = [
            'image' => 'required|max:2048',
        ];
    
        $customMessages = [
            'max' => "Immagine di dimensione troppo grande",
            'required' => "è richiesta un'immagine"
        ];

        $validator =  Validator::make($request->all(),$rules,$customMessages);
        // Verifica se la validazione fallisce
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        //In caso si validazione
        $data = $request->except('_token');
        // file
        $file = $request->file('image');
        // path
        $pathGrezza = $file->store('public/covers');
        // nome path salvata nel DB
        $data['image'] = str_replace('public/','', 'storage/'.$pathGrezza);;
        Book::create($data);
        
        return redirect()->back()->with('success','Libro Pubblicato sul tuo sito!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book, $categoryName)
    {
        
        $categories = Category::all();
   
        $category = Category::where('name',$categoryName)->first();
     
        $books = Book::orderBy('updated_at', 'desc')->where('category_id', $category->id)->get();
        //dd($books);
        return view('admin.book.bookslist', compact('books','categories'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
    return view('admin.book.editbook', compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        if($request->hasFile('image')){
        // validazione
        $rules = [
            'image' => 'max:2048',
        ];
    
        $customMessages = [
            'max' => "Immagine di dimensione troppo grande",
        ];
        


        $validator =  Validator::make($request->all(),$rules,$customMessages);
        // Verifica se la validazione fallisce
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
    }

        // aggiornamento dati
        $data = $request->all();

        if(request()->hasFile('image')){
            $file = $request->file('image');
        // path
        $pathGrezza = $file->store('public/covers');
        // nome path salvata nel DB
        $data['image'] = str_replace('public/','', 'storage/'.$pathGrezza);

        }else{
            unset($data['image']);
        }
        

        
        $book->update($data);

        return back()->with('success','Sono stati aggiornati i dati del libro');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('success','Libro Eliminato!');
    }
}
