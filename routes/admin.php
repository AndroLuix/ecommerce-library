<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDetailsController;
use App\Http\Controllers\AdminMailController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MassiveController;
use App\Http\Controllers\Admin\OrderAdmin;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::any('/logout', [AdminController::class, 'logout'])->name('admin.logout');



/**
 * Sconti
 */
Route::get('/sconti', [DiscountController::class, 'index'])->name('admin.discount');
Route::post('/scointi/create', [DiscountController::class, 'create'])->name('admin.discount.create');
Route::get('/sconti/{discount}/edit', [DiscountController::class, 'edit'])->name('admin.discount.edit');
Route::put('/sconti/{discount}/update', [DiscountController::class, 'update'])->name('admin.discount.update');
Route::get('/sconti/{discount}/validate', [DiscountController::class, 'validateActivation'])->name('admin.discount.validate');
Route::delete('sconti/{discount}/delete', [DiscountController::class, 'destroy'])->name('admin.discount.delete');

/**
 * Massive 
 */

Route::get('/massive', [MassiveController::class, 'index'])->name('admin.massive');
Route::post('/massive/create', [MassiveController::class, 'create'])->name('admin.massive.create');
Route::get('/massive/{massId}/edit',[MassiveController::class,'edit'])->name('admin.massive.edit');
Route::put('/massive/update/{massive}',[MassiveController::class,'update'])->name('admin.massive.update');
Route::put('/massive/{book}/dissociate',[MassiveController::class,'dissociateBook'])->name('admin.massive.dissociate');
Route::post('/massive/addBook',[MassiveController::class,'addBook']);

Route::put('/massive/{massId}/discount/update',[MassiveController::class,'updateDiscount'])->name('admin.massive.discount.update');

/**
 * Categorie
 */

Route::post('/category/create', [CategoryController::class, 'create'])->name('admin.cateogory.create');
Route::put('/category/edit', [CategoryController::class, 'update'])->name('admin.cateogory.update');

/**
 * Books
 *  pagine e filtri per i libri
 */
Route::get('/books', [BookController::class, 'index'])->name('admin.book');
// filtri
Route::get('/books/category', [BookController::class, 'booksCategory'])->name('admin.book.category');
Route::get('books/{category}', [BookController::class, 'show'])->name('admin.book.show');
// barra di ricerca
Route::post('books/search', [BookController::class, 'search'])->name('admin.book.search');
Route::get('book/{book}/edit', [BookController::class, 'edit'])->name('admin.book.edit');
Route::put('book/update/{book}', [BookController::class, 'update'])->name('admin.book.update');
Route::post('/books/create', [BookController::class, 'create'])->name('admin.book.create');
Route::delete('/book/{book}/delete', [BookController::class, 'destroy'])->name('admin.book.delete');

/**
 * Clients
 */

Route::get('/clienti', [ClientsController::class, 'index'])->name('admin.client');

/**
 * Recensioni
 */
Route::get('/recensioni',[ReviewController::class,'AdminIndex'])->name('admin.review');
Route::delete('/recensioni/{clientID}/{bookID}',[ReviewController::class,'destroy'])
->name('admin.review.delete');
Route::post('/cerca-recensione',[ReviewController::class,'search'])->name('admin.review.search');

/**
 * Ordini
 */
Route::controller(OrderAdminController::class)->group( function(){
    Route::get('/ordini','index')->name('admin.order');
    Route::get('/order/{order}', 'send')->name('admin.order.send'); // invia ordine
    Route::get('/order/backOrder/{order}','backOrder')->name('admin.order.back'); //annulla ordine
    Route::delete('/order/{order}/delete','delete')->name('admin.order.delete'); // elimina ordine
});

/**
 * MAIL
 */
Route::get('email',[AdminMailController::class,'forOrder'])->name('admin.mail.order');

/**
 * warehouse - magazzino
 */
Route::controller(WarehouseController::class)->group( function(){
    Route::get('/warehouse','index')->name('admin.warehouse');
    Route::get('/warehouse/update-quantity','changeQuantity');
    Route::post('/warehouse/add/{book_id}','plus');
    Route::post('/warehouse/minus/{book_id}','minus');
});

/**
 * Reports
 */
Route::controller(ReportController::class)->group( function(){
    Route::get('/reports','index')->name('admin.report');
});


