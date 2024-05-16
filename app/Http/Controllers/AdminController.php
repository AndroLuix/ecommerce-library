<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Mail\AdminResetPassword;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use  Illuminate\Support\Str;

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
            'password' => ['min:5', 'required', 'confirmed']
        ]);

        $data['password'] = Hash::make($data['password']);
        if (Admin::create($data)) {
            return redirect()->route('admin.dashboard');
        }



        return redirect()->back()->withErrors(['email' => 'I dati forniti non sono validi'], ['password.min' => 'Password troppo corta!'], ['password.confirmed' => 'Le password non corrispondono']);
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

    public function forgotPassword()
    {
        return view('admin.auth.passwords.email');
    }
    public function emailPasswordReset(Request $request)
    {
        //verifica email
        $admin = Admin::where('email', $request->email)->first();

        // Verifica se l'amministratore esiste nel sistema
        if (!$admin) {
            return redirect()->back()->withErrors('Email non trovata nel sistema.');
        }

        //generazione token
        $token = Str::random(60);
        $admin->remember_token = $token;
        $admin->save();

        Mail::to($admin->email)->send(new AdminResetPassword($admin));

        return redirect()->back()->with('success', 'Controlla la tua posta elettronica per resettare la password');
    }

    //pag reset pass
    public function passwordReset($token)
    {

        return view('admin.auth.passwords.reset', compact('token'));
    }
    //post reset passw
    public function updatePassword(Request $request)
    {
        // cerca admin per token
        $admin = Admin::where('remember_token', $request->token)->first();
        if (!$admin) {
            return redirect('/')->with('Non è stato possibile cambiare le credenziali');
        }

        //validazione password
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|unique:admins,password',
        ], [
            'password.required' => 'Il campo password è obbligatorio!',
            'password.min' => 'La password deve avere almeno :min caratteri!',
            'password.unique' => 'La password è già utilizzata!',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //se tutto è OK, cambia password e redirect sul login per admin

        $password =   Hash::make($request->password);
        $admin->password = $password;
        $admin->remember_token = null;
        $admin->save();
        return redirect()->route('admin.login.attempt')->with('success', 'Ora puoi inserire la tua nuova password!');
    }

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
