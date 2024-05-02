<?php

namespace App\Http\Controllers;

use App\Mail\sendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminMailController extends Controller
{
    public function forOrder(){
        Mail::to('esempio@mail.com')->send(new sendMail());
    }
}
