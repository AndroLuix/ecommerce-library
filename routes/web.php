<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['guest']], function () {
Route::get('/admin-login-attempt',[AdminController::class,'loginPage'])->name('admin.login.attempt');
Route::post('/admin-login',[AdminController::class,'login'])->name('admin.login');

Route::get('/admin-sign-in-attempt',[AdminController::class,'signin'])->name('admin.signin.attempt');
Route::post('/admin-sign-in',[AdminController::class,'register'])->name('admin.register');
});

Route::group(['middleware' => ['auth:admin'], 'prefix' => '/admin'], function(){
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::any('/logout', [AdminController::class,'logout'])->name('admin.logout');

    //categoies 

    Route::post('/category/create',[CategoryController::class,'create'])->name('admin.cateogory.create');

    // books
    Route::get('/books', [BookController::class,'index'])->name('admin.book');
    Route::post('/books/create', [BookController::class,'index'])->name('admin.book.create');
    
});



