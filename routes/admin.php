<?php 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderItemController;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Route;
Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::any('/logout', [AdminController::class,'logout'])->name('admin.logout');

    //sconti 
    Route::get('/sconti',[DiscountController::class,'index'])->name('admin.discount');
    Route::post('/scointi/create',[DiscountController::class,'create'])->name('admin.discount.create');
    Route::get('/sconti/{discount}/validate',[DiscountController::class,'index'])->name('admin.discount.validate');
    Route::delete('sconti/{discount}/delete',[DiscountController::class,'destroy'])->name('admin.discount.delete');

    Route::put('/sconti/{discount}/edit',[DiscountController::class,'index'])->name('admin.discount.edit');
    //categoies 
    Route::post('/category/create',[CategoryController::class,'create'])->name('admin.cateogory.create');
    Route::put('/category/edit',[CategoryController::class,'update'])->name('admin.cateogory.update');

    // books
    Route::get('/books', [BookController::class,'index'])->name('admin.book');
    Route::get('/books/category',[BookController::class,'booksCategory'])->name('admin.book.category');
    Route::get('books/{category}',[BookController::class,'show'])->name('admin.book.show');
    Route::get('book/{book}/edit',[BookController::class,'edit'])->name('admin.book.edit');
    Route::put('book/update/{book}',[BookController::class,'update'])->name('admin.book.update');
    Route::post('/books/create', [BookController::class,'create'])->name('admin.book.create');
    Route::delete('/book/{book}/delete',[BookController::class,'destroy'])->name('admin.book.delete');