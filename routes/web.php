<?php


use App\Http\Controllers\User\HomeController;


use App\Http\Controllers\Admin\AdminController;


use App\Http\Controllers\User\OrderItemController;
use App\Http\Controllers\Admin\OrderPaymentController;

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
})->name('welcome');

Auth::routes();





// shopping dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');




/**
 * Router for any
 */

// rivista libri
Route::get('/home/category', [HomeController::class, 'show'])->name('any.home.category');
Route::get('/home/{categoryBook}', [HomeController::class, 'showCateogry'])->name('any.home.namecategory');



//ordini
Route::post('/add-to-card', [OrderItemController::class, 'create'])->name('book.add');
Route::delete('/orders/{orderItem}/delete', [OrderItemController::class, 'destroy'])->name('book.destroy');
// carrello
Route::get('/carrello/{user}', [OrderItemController::class, 'index'])->name('book.carrello');
Route::post('/carrello/{orderId}/plus', [OrderItemController::class, 'plus'])->name('carrello.plus');
Route::post('/carrello/{orderId}/minus', [OrderItemController::class, 'minus'])->name('carrello.minus');
Route::get('/carrello/getdata/{idOrder}', [OrderItemController::class, 'getCarrelloData'])->name('carrello.data');


Route::group(['middleware' => ['auth']], function () {
    // creazione carta di credito 
    // Route::post('nuova-carta',[])
    Route::post('pagamento', [OrderPaymentController::class, 'create'])->name('user.payment');
});



/**
 * ROUTE FOR ADMIN
 */
 /**
 * Route for guest (admin)
 */
Route::group(['middleware' => ['guest']], function () {
    Route::get('/admin-login-attempt', [AdminController::class, 'loginPage'])->name('admin.login.attempt');
    Route::post('/admin-login', [AdminController::class, 'login'])->name('admin.login');

    Route::get('/admin-sign-in-attempt', [AdminController::class, 'signin'])->name('admin.signin.attempt');
    Route::post('/admin-sign-in', [AdminController::class, 'register'])->name('admin.register');

/**
 * Route For reset password Admin
 */
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/request-password', 'forgotPassword')->name('admin.forgot.password');
    Route::post('admin/password/reset', 'emailPasswordReset')->name('admin.email.sendmail');
    Route::get('/admin/resetpassword/{remember_toekn}', 'passwordReset')->name('admin.password.reset');
Route::post('/admin/passowrd-update','updatePassword')->name('admin.password.update');
});
});


    include __DIR__ . '/admin.php';

