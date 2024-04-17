<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    /**
     * 
     * Registrazioni pagine 
     * */

    public function signin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.signin');
    }

    public function loginPage()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function register(Request $request)
    {
        //
        $data = $request->all();
        //validazione 
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['min:5','required','confirmed']
        ]);

        $data['password'] = Hash::make($data['password']);
        if (Admin::create($data)) {
            return redirect()->route('admin.dashboard');
        }



        return redirect()->back()->withErrors(['email' => 'I dati forniti non sono validi'], ['password.min' => 'Password troppo corta!'],['password.confirmed'=>'Le password non corrispondono']);
    }


    /* admin login */
    public function login(Request $request)
    {

        $data = $request->all();




        //gestione login

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // gestione errori
        return redirect()->back()->withErrors([
            'email' => 'I dati forniti non sono validi',
            'password' => 'I dati forniti non sono validi'
        ]);
    }
    /**
     * Display a listing of the resource.
     */

    public function logout()
    {
        Auth::guard('admin')->logout();
        return view('/welcome');
    }
    public function dashboard()
    {
        //

        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */

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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
        $admin->delete();
        return redirect('admin.register');
    }
}
