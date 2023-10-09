<?php

use App\Http\Controllers\AdminList;
use App\Http\Controllers\AdminProfile;
use App\Http\Controllers\Blog;
use App\Http\Controllers\Cart;
use App\Http\Controllers\Category;
use App\Http\Controllers\Checkout;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Favorite;
use App\Http\Controllers\FeaturedProduct;
use App\Http\Controllers\Index;
use App\Http\Controllers\Login;
use App\Http\Controllers\Member;
use App\Http\Controllers\MerchantProfile;
use App\Http\Controllers\Pajak;
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
Route::get('/shop/{shop_id}/{slug}', [Index::class, 'shop_detail'])->name('shop-detail');
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

    Route::get("/favorite", [Favorite::class, "index"])->name("favorite");


    Route::get("/checkout", [Checkout::class, "index"])->name("checkout");
    Route::post("/rates", [Checkout::class, "rates"])->name("rates");
    Route::post("/address", [Checkout::class, "address"])->name("address");
    Route::post("/apply-coupon", [Checkout::class, "apply_coupon"])->name("apply-coupon");
    Route::post("/make-transaction", [Checkout::class, "make_transaction"])->name("make-transaction");
});

Route::group(['middleware' => ['auth', 'role:merchant']], function () {

    Route::prefix('product')->group(function () {
        Route::get('/', [Product::class, 'index'])->name("product");
        Route::post('/show', [Product::class, 'show'])->name("show-product");
        Route::post('/toggle-status-product', [Product::class, 'toggle_status'])->name("toggle-status-product");
        Route::get('/add', [Product::class, 'add'])->name("add-product");
        Route::post('/store', [Product::class, 'store'])->name("store-product");
        Route::get('/detail/{product_id}', [Product::class, 'detail'])->name("detail-product");
        Route::post('/update-product', [Product::class, 'update'])->name("update-product");
    });

    Route::post('/request-pickup', [Pickup::class, 'pickup'])->name("request-pickup");


    Route::get('/voucher-log', [Voucher::class, 'voucher_log'])->name("voucher-log");
    Route::post('/show-voucher-log', [Voucher::class, 'show_log'])->name("show-voucher-log");

    Route::get('laporan-penjualan/export', [ReportSales::class, 'export'])->name("export-laporan-penjualan");

    Route::get('/detail-merchant', [MerchantProfile::class, 'detail_merchant'])->name("detail-merchant");
    Route::post('/update-merchant', [MerchantProfile::class, 'update'])->name("update-merchant");

    Route::prefix('voucher')->group(function () {
        Route::get('/', [Voucher::class, 'index'])->name("voucher");
        Route::get('/add', [Voucher::class, 'add'])->name("add-voucher");
        Route::post('/store', [Voucher::class, 'store'])->name("store-voucher");
        Route::get('/detail/{id}', [Voucher::class, 'detail'])->name("voucher-detail");
    });

    Route::prefix('laporan-penjualan-product')->group(function () {
        Route::get('/', [ReportSales::class, 'laporan_penjualan_product'])->name("laporan-penjualan-product");
        Route::post('/show', [ReportSales::class, 'show_laporan_penjualan_product'])->name("show-laporan-penjualan-product");
        Route::get('/export', [ReportSales::class, 'export_laporan_penjualan_product'])->name("export-laporan-penjualan-product");
    });
});

Route::post('/callback-payment', [Payment::class, 'index']);
Route::post('/callback-shipping-webhook', [Pickup::class, 'callback_shipping_webhook']);

Route::group(['middleware' => ['auth', 'role:admin|merchant']], function () {
    Route::prefix('featured-product')->group(function () {
        Route::get('/', [FeaturedProduct::class, 'index'])->name("featured-product");
        Route::post('/update', [FeaturedProduct::class, 'update'])->name("update-featured-product");
    });

    Route::get('/dashboard', [Dashboard::class, 'index'])->name("dashboard");

    Route::get('/voucher', [Voucher::class, 'index'])->name("voucher");
    Route::post('/show-voucher', [Voucher::class, 'show'])->name("show-voucher");

    Route::prefix('transaction')->group(function () {
        Route::get('/', [Transaction::class, 'index'])->name("transaction");
        Route::post('/show', [Transaction::class, 'show'])->name("show-transaction");
        Route::get('/detail/{id}', [Transaction::class, 'detail'])->name("transaction-detail");
    });

    Route::get('laporan-penjualan', [ReportSales::class, 'index'])->name("laporan-penjualan");
    Route::post('laporan-penjualan/show', [ReportSales::class, 'show'])->name("show-laporan-penjualan");
    Route::get('laporan-penjualan/admin/export', [ReportSales::class, 'export_excell'])->name("export-laporan");
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::prefix('shop-list')->group(function () {
        Route::get('/', [Shop::class, 'index'])->name("shop-list");
        Route::post('/show', [Shop::class, 'show'])->name("show-shop-list");
        Route::get('/detail/{id}', [Shop::class, 'detail'])->name("detail-shop");
        Route::post('/update', [Shop::class, 'update'])->name("update-shop");
        Route::get('/add', [Shop::class, 'add'])->name("add-shop");
        Route::post('/store', [Shop::class, 'store'])->name("store-shop");
    });

    Route::prefix('member-list')->group(function () {
        Route::get('/', [Member::class, 'index'])->name("member-list");
        Route::post('/show', [Member::class, 'show'])->name("show-member-list");
    });


    Route::prefix('category-list')->group(function () {
        Route::get('/', [Category::class, 'index'])->name("category-list");
        Route::post('/show', [Category::class, 'show'])->name("show-category-list");
        Route::get('/add', [Category::class, 'add'])->name("add-category");
        Route::post('/store', [Category::class, 'store'])->name("store-category");
        Route::get('/detail/{id}', [Category::class, 'detail'])->name("detail-category");
        Route::post('/update', [Category::class, 'update'])->name("update-category");
    });

    Route::prefix('blog-list')->group(function () {
        Route::get('/', [Blog::class, 'index'])->name("blogs");
        Route::post('/show', [Blog::class, 'show'])->name("show-blogs");
        Route::get('/add', [Blog::class, 'add'])->name("add-blog");
        Route::post('/store', [Blog::class, 'store'])->name("store-blog");
        Route::get('/detail/{id}', [Blog::class, 'detail'])->name("detail-blog");
        Route::post('/update', [Blog::class, 'update'])->name("update-blog");
        Route::post('/delete', [Blog::class, 'destroy'])->name("delete-blog");
    });




    Route::get('/admin/profile', [AdminProfile::class, 'index'])->name("admin-profil");
    Route::post('/admin/profile/update', [AdminProfile::class, 'update'])->name("update-admin-profil");

    Route::prefix('admin-list')->group(function () {
        Route::get('/', [AdminList::class, 'index'])->name("admin-list");
        Route::post('/show', [AdminList::class, 'show'])->name("show-admin-list");
        Route::get('/add', [AdminList::class, 'add'])->name("add-admin-list");
        Route::post('/store', [AdminList::class, 'store'])->name("store-admin-list");
        Route::post('/reset-password', [AdminList::class, 'reset_password'])->name("reset-password-admin");
    });
});

Route::group(['middleware' => ['auth', 'role:tax']], function () {
    Route::prefix('laporan-perpajakan')->group(function () {
        Route::get('/', [Pajak::class, 'index'])->name("laporan-perpajakan");
        Route::post('/download', [Pajak::class, 'download'])->name("download-pajak-tahunan");
    });
});
