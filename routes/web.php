<?php

use App\Http\Controllers\Index;
use App\Http\Controllers\Login;
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

Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/sign-in', [Login::class, 'sign_in'])->name('sign-in');


Route::get('/sign-up', [Login::class, 'sign_up'])->name('sign-up');
Route::post('/sign', [Login::class, 'sign'])->name('sign');
