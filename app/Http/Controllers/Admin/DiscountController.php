<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // pagina di tutti gli sconti
        $discounts = Discount::with(relations: 'books')->orderBy('created_at', 'desc')->get();
        return view('admin.discount.discounts', compact('discounts'));
    }

    public function removeBook($id){
        $book = Book::find($id);
        $book->discount_id =  null;
        $book->save();
        
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // validazione
        $data = request()->all();

        if ($data['percent'] <= 0) {
            return redirect()->back()->withErrors('Devi Inserire una Percentuale maggiore di 0');
        }

        $rules = [
            'name' => 'required|min:5|unique:discounts,name',
        ];

        $customMessages = [
            'percent' => "Sono vietati numeri pari o minori di 0",
            'min' => 'Insrisci un nome più lungo',
            'unique' => "Esiste già uno sconto con il nome {$data['name']} "
        ];

        $validator =  Validator::make($data, $rules, $customMessages);
        // Verifica se la validazione fallisce
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        //dd($data);
        $disocunt = Discount::create($data);

        return redirect()->back()->with('success', "Sconto {$disocunt->name}  Creato");
    }

    public function validateActivation(Discount $discount)
    {


        $discount->active = !$discount->active;
        $discount->save();

        return redirect()->back();
    }
    public function activeDiscount(Discount $discount)
    {
        $discount->active = false;
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
      

        
        $discounts = Discount::with(relations: 'books')->orderBy('created_at', 'desc')->get();
        return view('admin.discount.edit-discount', compact('discount', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        $discount->update($request->all());
        return redirect()->back()->with('success', "Offerta {$discount->name} Aggiornata con successo!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->back()->with('success', 'Sconto Eliminato');
    }
}
