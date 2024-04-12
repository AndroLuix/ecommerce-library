<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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


/**
 * Route for guest
 */
Route::group(['middleware' => ['guest']], function () {
Route::get('/admin-login-attempt',[AdminController::class,'loginPage'])->name('admin.login.attempt');
Route::post('/admin-login',[AdminController::class,'login'])->name('admin.login');

Route::get('/admin-sign-in-attempt',[AdminController::class,'signin'])->name('admin.signin.attempt');
Route::post('/admin-sign-in',[AdminController::class,'register'])->name('admin.register');
});

/**
 * Router for any
 */

 Route::get('/home/category',[HomeController::class,'show'])->name('any.home.category');


/**
 * Route for admin
 */
Route::group(['middleware' => ['auth:admin'], 'prefix' => '/admin'], function(){
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::any('/logout', [AdminController::class,'logout'])->name('admin.logout');

    //categoies 

    Route::post('/category/create',[CategoryController::class,'create'])->name('admin.cateogory.create');

    // books
    Route::get('/books', [BookController::class,'index'])->name('admin.book');
    Route::get('/books/category',[BookController::class,'booksCategory'])->name('admin.book.category');
    Route::get('books/{category}',[BookController::class,'show'])->name('admin.book.show');
    Route::get('book/{book}/edit',[BookController::class,'edit'])->name('admin.book.edit');
    Route::put('book/update/{book}',[BookController::class,'update'])->name('admin.book.update');
    Route::post('/books/create', [BookController::class,'create'])->name('admin.book.create');
    Route::delete('/book/{book}/delete',[BookController::class,'destroy'])->name('admin.book.delete');
    
});



