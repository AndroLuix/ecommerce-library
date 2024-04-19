<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MassiveController;
use App\Http\Controllers\OrderItemController;
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
