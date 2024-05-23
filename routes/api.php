<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Back\BlogController;
use App\Http\Controllers\Api\Back\CategoryController;
use App\Http\Controllers\Api\Back\ProductController;
use App\Http\Controllers\Api\Front\BlogController as FrontBlogController;
use App\Http\Controllers\Api\Front\CartController;
use App\Http\Controllers\Api\Front\CategoryController as FrontCategoryController;
use App\Http\Controllers\Api\Front\ContactController;
use App\Http\Controllers\Api\Front\OrderController;
use App\Http\Controllers\Api\Front\ProductController as FrontProductController;
use App\Http\Controllers\Api\Front\ProductReviewController;
use App\Http\Controllers\Api\Front\WishlistController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;






/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

########## Guest Routes #############
Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->prefix('/auth')->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::post('/register', 'register')->name('register');
    });
});

########## Auth Routes #############
Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->prefix('/auth')->group(function () {
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::controller(ProfileController::class)->prefix('/profile')->as('profile.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/update', 'update')->name('update');
        Route::put('/update_password', 'updatePassword')->name('update_password');
    });

    ########### Admin Routes ###########
    Route::middleware('is.admin')->prefix('/admin')->as('admin.')->group(function () {
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('products', ProductController::class);
        Route::apiResource('productReviews', ProductReviewController::class);
        Route::apiResource('blogs', BlogController::class);
    });

    ########### User Routes ###########
    Route::controller(WishlistController::class)->prefix('/wishlist')->as('wishlist.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store/{product_id}', 'store')->name('store');
        Route::delete('/remove/{product_id}', 'remove')->name('remove');
        Route::delete('/destroy', 'destroy')->name('destroy');
    });

    Route::controller(CartController::class)->prefix('/cart')->as('cart.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add-to-cart', 'addToCart')->name('store');
        Route::delete('/remove-item/{product_id}', 'removeItem')->name('remove');
        Route::delete('/destroy', 'destroy')->name('destroy');
    });

    Route::controller(OrderController::class)->prefix('/order')->as('order.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/save-order', 'saveOrder')->name('store');
        Route::post('/apply-coupon', 'applyCoupon')->name('applyCoupon');
        Route::put('/cancel-order/{order_id}', 'cancelOrder')->name('cancel');
    });

    Route::controller(FrontBlogController::class)->prefix('/blog')->as('blog.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{blog}', 'show')->name('show');
        Route::post('/blog-comment', 'comment')->name('comment');
    });
});

############# multiple Routes ##############
Route::get('/categories', [FrontCategoryController::class, 'index'])->name('front.categories');
Route::get('/products', [FrontProductController::class, 'index'])->name('front.products');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
