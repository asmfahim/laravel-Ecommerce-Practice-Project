<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\IndexController;

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
