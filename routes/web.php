<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController; 
use App\Http\Controllers\SignupController; 
use App\Http\Controllers\ProductsController; 
use App\Http\Controllers\CartController; 
use App\Http\Controllers\AccountController; 
use App\Http\Controllers\MailController; 
use App\Http\Controllers\CouponController; 
use App\Http\Controllers\ProductReviewController; 

/*s
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', [WelcomeController::class, 'homepageDisplay'])->name('homepage');

Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/recoveryLogin', [LoginController::class, 'recoveryLogin'])->name('recoveryLogin')->middleware('guest');
Route::get('/forgotPassword', [LoginController::class, 'forgotPassword'])->name('forgotPassword')->middleware('guest');

Route::resource('/products', ProductsController::class);

Route::middleware([auth::class])->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'addProductToCart'])->name('addProductToCart');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/success', [CartController::class, 'successOrder'])->name('checkout.success');
    Route::get('/cancel', [CartController::class, 'cancelOrder'])->name('checkout.cancel');
    Route::resource('/cart', CartController::class); 

    Route::get('/account', [AccountController::class, 'displayAccountSettings']);
    Route::get('/account/security', [AccountController::class, 'displayAccountSecurity'])->middleware('password.confirm');
    Route::get('/account/orders', [AccountController::class, 'displayAccountOrders'])->name('orders');
    Route::get('/account/orders/{order}', [AccountController::class, 'displayOrderDetails'])->name('orderDetails');

    Route::get('/product/review/{product}', [ProductReviewController::class, 'displayProductReview'])->name('productReview');
    Route::post('/addReview', [ProductReviewController::class, 'addReview']);

    Route::post('/coupon', [CouponController::class, 'store'])->name('coupon.store');
    Route::delete('/coupon', [CouponController::class, 'destroy'])->name('coupon.destroy');
});




