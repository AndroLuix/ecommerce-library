<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // page for the show all categories

       $categories = Category::all();
        return view('admin.category.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validazione
    
        $rules = [
            'name' => 'required|min:1|unique:category_books,name',
        ];
    
        $customMessages = [
            'required' => "Inserire l' :attribute .",
            'min' => 'Insrisci un nome più lungo',
            'unique'=>'Categoria già presente'
        ];

        $validator =  Validator::make($request->all(),$rules,$customMessages);
        // Verifica se la validazione fallisce
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        // crezione categoria
        if(Category::create($request->all())){
            return redirect()->back()->with('success','Nuova Categoria Creata!');
        }

        //output errore
        return redirect()->back()->withErrors(['name'=>'Errore dovuto dal sistema, contattaci!']);
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validazione
    

        $rules = [
            'name' => 'required|min:2|unique:category_books,name',
        ];
    
        $customMessages = [
            'required' => "Inserire l' :attribute .",
            'min' => 'Insrisci un nome più lungo',
            'unique'=>'Categoria già presente'
        ];

        $validator =  Validator::make($request->all(),$rules,$customMessages);
        // Verifica se la validazione fallisce
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }


        // Se non ci sono errori, si prosegue...
        $data = $request->all();

       $category = Category::find($data['id']);
       $category->name = $data['name'];
       $category->save();

       return redirect()->back()->with('success','Categoria Aggiornata con Successo!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
