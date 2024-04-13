<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderItemController;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Route;
use PhpParser\Builder\Class_;

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

 // rivista libri
 Route::get('/home/category',[HomeController::class,'show'])->name('any.home.category');
Route::get('/home/{categoryBook}',[HomeController::class,'showCateogry'])->name('any.home.namecategory');



 //ordini
Route::post('/add-to-card',[OrderItemController::class,'create'])->name('book.add');

// carrello
Route::get('/carrello/{user}',[OrderItemController::class,'index'])->name('book.carrello');
Route::post('/carrello/{orderId}/plus',[OrderItemController::class,'plus'])->name('carrello.plus');
Route::post('/carrello/{orderId}/minus',[OrderItemController::class,'minus'])->name('carrello.minus');
Route::get('/carrello/getdata/{idOrder}',[OrderItemController::class,'getCarrelloData'])->name('carrello.data');





/**
 * Route for admin
 */
Route::group(['middleware' => ['auth:admin'], 'prefix' => '/admin'], function(){
   
    include __DIR__.'/admin.php';
});



