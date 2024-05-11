<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Discount;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MassiveController extends Controller
{
    //
    
    public function index(){
        
        $books = Book::orderBy('updated_at', 'desc')->get();
        $discounts = Discount::orderBy('updated_at','desc')->get();

        $massive = Group::orderBy('updated_at','desc')->get();

        return view('admin.massive.massive',compact('books','discounts','massive'));
 
     }

     public function create(Request $request){

        $rules = [
            'name' => 'required|min:5|unique:group,name',
        ];
    
        $customMessages = [
            'required' => "Inserire un nome.",
            'min' => 'Insrisci un nome più lungo',
            'unique'=>'Nome già presente'
        ];

        $validator =  Validator::make($request->all(),$rules,$customMessages);
        // Verifica se la validazione fallisce
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
 
       
       $massive = Group::create(['name' => $request->name]);
       // dd($request->id);
        foreach($request->id as $id){
            $book = Book::find($id);
            $book->group_id = $massive->id;
            $book->discount_id = $request->discount_id;
            $book->save();
        }
       
        return redirect()->back()->with('success',"Massive {$massive->name} Creato!");

     }

 

     public function edit($massive_id){
        $massive = Group::findOrFail($massive_id);
        $discounts = Discount::all();
        $books = Book::orderBy('created_at', 'desc')->paginate(100);

        return view('admin.massive.edit-massive',compact('massive','discounts','books'));
     }

     public function update(Request $request, Group $massive){
        dd(request()->all());
        return redirect()->back()->with('success',"Massive {$massive->name} Aggiornato con Successo!");
     }

     public function updateDiscount(Request $request,$massive_id){

       $massive =  Group::firstWhere('id',$massive_id);
       $discountId = $request->discount_id;
       if($request->discount_id == 'null'){
        $discountId = null;
       }
        foreach($massive->books as $book){
            if($book->discount_id == $request->discount_id){
                return redirect()->back()->with('primary','Promozione già presente per il massive scelto, nessuna modifica svolta.');
            }
          $book->discount_id  = $discountId;
          $book->save();
        }
      
        return redirect()->back()->with('success',"Sconto Massive per il gruppo {$massive->name} modificato con successo!");
     }

     public function dissociateBook(Book $book){

        $group = Group::find($book->group_id);

        //dd($group->books()->count());
        if($group->books()->count() <= 1){
            $group->delete();
            return redirect()->route('admin.massive')->with('success','Massive Eliminato, poiché non conteneva più libri');
        }
     
        $book->group_id = null;
        $book->save();
        
        return redirect()->back()->with('success',"Libro {$book->title} dissociato");
     }

     public function addBook(Request $request)
     {
         $bookId = $request->input('book_id');
         $massiveId = $request->massive_id;
         $book = Book::find($bookId);
         $massive = Group::find($massiveId);
        
     
         if ($book ) {
            $book->group_id = $massive->id;
            $book->discount_id = $massive->books()->first()->discount_id;
            $book->save();
             return response()->json(['success' => true, 'message' => "Libro Aggiunto: {$book->title}"]); 
            
         } else {
             return response()->json(['success' => false, 'message' => 'Libro non trovato']);
         }
     }
     
}
