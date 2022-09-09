<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscriptionController;

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

Route::get('/', array('as' => '/', function () {return redirect('/products');}));
Route::get('/home',[HomeController::class, "index"])->name('home');
Route::get('/products',[ProductController::class, "index"])->name('products.index');
Route::get('/products/{product}',[ProductController::class, "show"])->name('products.show');
Route::post('/subscription',[SubscriptionController::class, "create"])->name('subscription.create');

Route::get('create/product',[SubscriptionController::class, "createProduct"])->name('create.product');
Route::post('store/product',[SubscriptionController::class, "storeProduct"])->name('store.product');

