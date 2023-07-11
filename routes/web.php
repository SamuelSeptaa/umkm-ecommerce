<?php

use App\Http\Controllers\Cart;
use App\Http\Controllers\Checkout;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Index;
use App\Http\Controllers\Login;
use App\Http\Controllers\MerchantProfile;
use App\Http\Controllers\Payment;
use App\Http\Controllers\Pickup;
use App\Http\Controllers\Product;
use App\Http\Controllers\Profile;
use App\Http\Controllers\ReportSales;
use App\Http\Controllers\Shop;
use App\Http\Controllers\Transaction;
use App\Http\Controllers\Voucher;
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
Route::get('/blog', [Index::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [Index::class, 'blog_detail'])->name('blog-detail');


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

    Route::get('/transaction-history', [Profile::class, 'transaction_history'])->name("transaction-history");
    Route::get('/transaction-history/{receipt_number}', [Profile::class, 'transaction_history_detail'])->name("transaction-history-detail");


    Route::post("/add_favorit", [Cart::class, "add_favorit"])->name("add-favorit");

    Route::post("/check_cart", [Cart::class, "check_cart"])->name("check-cart");
    Route::post("/add_to_cart", [Cart::class, "add_to_cart"])->name("add-to-cart");


    Route::get("/cart", [Cart::class, "cart"])->name("cart");
    Route::post("/update_cart", [Cart::class, "update_cart"])->name("update-cart");

    Route::get("/checkout", [Checkout::class, "index"])->name("checkout");
    Route::post("/rates", [Checkout::class, "rates"])->name("rates");
    Route::post("/apply-coupon", [Checkout::class, "apply_coupon"])->name("apply-coupon");
    Route::post("/make-transaction", [Checkout::class, "make_transaction"])->name("make-transaction");
});

Route::group(['middleware' => ['auth', 'role:merchant']], function () {
    Route::get('/product', [Product::class, 'index'])->name("product");
    Route::post('/show-product', [Product::class, 'show'])->name("show-product");
    Route::post('/toggle-status-product', [Product::class, 'toggle_status'])->name("toggle-status-product");
    Route::get('/product/add', [Product::class, 'add'])->name("add-product");
    Route::post('/product/store', [Product::class, 'store'])->name("store-product");
    Route::get('/product/detail/{product_id}', [Product::class, 'detail'])->name("detail-product");
    Route::post('/update-product', [Product::class, 'update'])->name("update-product");

    Route::get('/transaction', [Transaction::class, 'index'])->name("transaction");
    Route::post('/show-transaction', [Transaction::class, 'show'])->name("show-transaction");
    Route::get('/transaction/detail/{id}', [Transaction::class, 'detail'])->name("transaction-detail");
    Route::post('/request-pickup', [Pickup::class, 'pickup'])->name("request-pickup");


    Route::get('/voucher-log', [Voucher::class, 'voucher_log'])->name("voucher-log");
    Route::post('/show-voucher-log', [Voucher::class, 'show_log'])->name("show-voucher-log");


    Route::get('/detail-merchant', [MerchantProfile::class, 'detail_merchant'])->name("detail-merchant");
    Route::post('/update-merchant', [MerchantProfile::class, 'update'])->name("update-merchant");

    Route::get('/voucher', [Voucher::class, 'index'])->name("voucher");
    Route::post('/show-voucher', [Voucher::class, 'show'])->name("show-voucher");
    Route::get('/voucher/add', [Voucher::class, 'add'])->name("add-voucher");
    Route::post('/voucher/store', [Voucher::class, 'store'])->name("store-voucher");
    Route::get('/voucher/detail/{id}', [Voucher::class, 'detail'])->name("voucher-detail");

    Route::get('laporan-penjualan', [ReportSales::class, 'index'])->name("laporan-penjualan");
    Route::post('laporan-penjualan/show', [ReportSales::class, 'show'])->name("show-laporan-penjualan");
    Route::get('laporan-penjualan/export', [ReportSales::class, 'export'])->name("export-laporan-penjualan");
});

Route::post('/callback-payment', [Payment::class, 'index']);

Route::group(['middleware' => ['auth', 'role:admin|merchant']], function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name("dashboard");
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/shop-list', [Shop::class, 'index'])->name("shop-list");
    Route::post('/show-shop-list', [Shop::class, 'show'])->name("show-shop-list");
    Route::get('/shop-list/detail/{id}', [Shop::class, 'detail'])->name("detail-shop");
    Route::post('/shop-list/update', [Shop::class, 'update'])->name("update-shop");
    Route::get('/shop-list/add', [Shop::class, 'add'])->name("add-shop");
    Route::post('/shop-list/store', [Shop::class, 'store'])->name("store-shop");
});
