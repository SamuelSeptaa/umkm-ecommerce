<?php

use App\Http\Controllers\Cart;
use App\Http\Controllers\Index;
use App\Http\Controllers\Login;
use App\Http\Controllers\Profile;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Index::class, 'index'])->name('index');
Route::get('/shop', [Index::class, 'shop'])->name('shop');
Route::get('/shop/{slug}', [Index::class, 'shop_detail'])->name('shop-detail');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [Login::class, 'index'])->name('login');
    Route::post('/sign-in', [Login::class, 'sign_in'])->name('sign-in');

    Route::get('/sign-up', [Login::class, 'sign_up'])->name('sign-up');
    Route::post('/sign', [Login::class, 'sign'])->name('sign');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [Login::class, 'logout'])->name("logout");
});


Route::group(['middleware' => ['auth', 'role:member']], function () {
    Route::get('/profile', [Profile::class, 'index'])->name("profile");
    Route::post('/save_profile', [Profile::class, 'save_profile'])->name("save_profile");

    Route::post("/add_favorit", [Cart::class, "add_favorit"])->name("add-favorit");

    Route::post("/check_cart", [Cart::class, "check_cart"])->name("check-cart");
});
