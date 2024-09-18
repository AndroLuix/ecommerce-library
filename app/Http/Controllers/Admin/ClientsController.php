<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $clients = User::paginate(20);

        if(isset($request->input)){
            $input = $request->input;
            $clients = User::where('name','LIKE',"%{$input}%")
            ->orWhere('email','LIKE',"%{$input}%")
            ->orWhere('created_at','LIKE',"%{$input}%")
            ->orWhere('email_verified_at','LIKE',"%{$input}%")
            ->paginate(20)->appends( $input);
    
        }
        return view('admin.client.client', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
