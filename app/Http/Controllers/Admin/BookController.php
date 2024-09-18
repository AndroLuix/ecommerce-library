<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Book;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     // funzione che permette di risparmiare tempo 
     private function loadCommonData()
     {
         return [
             'categories' => Category::all(),
             'discounts' => Discount::all(),
         ];
     }
    public function index()
    {
        $dataModels = $this->loadCommonData();

        $dataModels['books'] = Book::orderBy('updated_at', 'desc')->paginate(5);
        return view('admin.book.bookslist', $dataModels);
    }

    public function search(Request $request){
    
        $dataModels = $this->loadCommonData();
        // prendo l'input della barra di ricerca
        $input = $request->input;
        $books = Book::where('title',$input)
        ->orWhere('title','LIKE',"%{$input}%")
        ->orWhere('price','LIKE',"%{$input}%")
        ->orWhere('author','LIKE',"%{$input}%")
        ->orWhere('description','LIKE',"%{$input}%")
        ->orWhere('quantity','LIKE',"%{$input}%")
        ->paginate(5);

        if(count($books) == 0){
            return redirect()->route('admin.book')->with('warning','Nessun contenuto trovato... ');
        }
        $dataModels['books'] = $books;
        return view('admin.book.bookslist', $dataModels);
    }

    public function booksCategory(Request $request){
        $categoryId = $request->category_id ;

           // prendo tutte le categorie e offerte
           $categories = Category::all();
           $discounts = Discount::all();

        if($request->category_id == 'tutti'){
            return redirect()->route('admin.book');
        }
        $categories = Category::all();
        $books = Book::orderBy('updated_at', 'desc')->where('category_id', $categoryId)->paginate(5);
        //dd($books);
        return view('admin.book.bookslist', compact('books','categories','categoryId','request','categories', 'discounts'));

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

       // Genera un nome univoco per il file
       $fileName = time() . '_' . $file->getClientOriginalName();
        
       // Sposta il file nella directory pubblica
       $file->move(public_path('images'), $fileName);
       
       // Aggiungi il percorso relativo dell'immagine ai dati
       $data['image'] = 'images/' . $fileName;
        // nome path salvata nel DB
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
        $dataModels = $this->loadCommonData();
        
        $category = Category::where('name',$categoryName)->first();
     
        $dataModels['books'] = Book::orderBy('updated_at', 'desc')->where('category_id', $category->id)->paginate(5);
       
        return view('admin.book.bookslist',$dataModels);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $discounts = Discount::all();
        $categories = Category::all();
    return view('admin.book.editbook', compact('book','categories','discounts'));
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
         // Genera un nome univoco per il file
         $fileName = time() . '_' . $file->getClientOriginalName();
        
         // Sposta il file nella directory pubblica
         $file->move(public_path('images'), $fileName);
         
         // Aggiungi il percorso relativo dell'immagine ai dati
         $data['image'] = 'images/' . $fileName;
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
