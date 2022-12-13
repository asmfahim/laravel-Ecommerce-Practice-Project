<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::prefix('admin')->group(base_path('routes/admin.php'));

// index Controller
Route::get('/',[IndexController::class,'index']);
Route::middleware('auth')->group(function(){
    // profile
    Route::get('/profile', [HomeController::class,'index'])->name('profile');
    Route::get('/profile/edit', [HomeController::class,'edit'])->name('profile.edit');
    Route::put('profile/update/{id}', [HomeController::class,'update'])->name('profile.update');
    Route::put('profile/change/password/{id}', [HomeController::class,'change_password'])->name('profile.change.password');
});

// product details route
Route::get('product/details/{id}/{slug}', [IndexController::class,'productdetails']);

//Product Tags route
Route::get('product/tag/{tag}', [IndexController::class,'TagWiseProduct']);

//SubCategory Tags route
Route::get('subcategory/product/{subcat_id}/{slug}', [IndexController::class,'SubCatWiseProduct']);

//SubCategory Tags route
Route::get('subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class,'SubSubCatWiseProduct']);

// Product View Modal with Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// Add to Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get Data from mini cart
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);

// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// Add to Wishlist
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlist']);



Route::middleware('auth')->group(function(){
// Wishlist page
Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');
Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);
Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);

});

//Cart Page
Route::get('/mycart', [CartPageController::class, 'MyCart'])->name('mycart');
Route::get('/get-cart-product', [CartPageController::class, 'GetCartProduct']);

Route::get('/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);

Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);


