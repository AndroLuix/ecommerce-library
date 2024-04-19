<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Discount;
use App\Models\Group;
use Illuminate\Http\Request;
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
        //dd($request->id);
        foreach($request->id as $id){
            $book = Book::find($id);
            $book->group_id = $massive->id;
            $book->discount_id = $request->discount_id;
            $book->save();
        }
       
        return redirect()->back()->with('success',"Massive {$massive->name} Creato!");

     }
}
