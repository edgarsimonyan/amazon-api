<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[WelcomeController::class, 'index'])->name('welcome.index');
Route::get('/categories',[WelcomeController::class, 'categories'])->name('welcome.categories');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'middleware' => 'auth',

], function () {

    Route::post('/add-image/{id}', [ProductController::class, 'addProductImage'])->name('product.addProductImage');
    Route::post('/main-image/', [ProductController::class, 'mainImage'])->name('product.mainImage');
    Route::delete('/remove-image/{id}', [ProductController::class, 'removeImage'])->name('product.removeImage');
    Route::get('/all-products/{id}', [ProductController::class, 'myProducts'])->name('product.myProducts');

Route::group([
    'middleware' => 'isAdmin',
], function() {

    Route::resource('admin', CategoryController::class, [
        'except' => [ 'show' ]
    ]);
    Route::resource('adminSize', ProductSizeController::class, [
        'except' => [ 'show' ]
    ]);
    Route::resource('adminColor', ProductColorController::class, [
        'except' => [ 'show' ]
    ]);
});

});

Route::resource('product', ProductController::class);
