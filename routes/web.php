<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resource('products', ProductController::class)->except('show');
    Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
    Route::get('products/fetch_data', [ProductController::class, 'fetch_data']);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
