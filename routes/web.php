<?php

use App\Http\Controllers\Admin\AdminController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'middleware' => 'auth',

], function () {

    Route::post('/addImage/{id}', [ProductController::class,'addProductImage'])->name('product.addProductImage');
    Route::put('/mainImage/', [ProductController::class,'mainImage'])->name('product.mainImage');
    Route::delete('/removeImage/{id}', [ProductController::class,'removeImage'])->name('product.removeImage');
    Route::get('/allProducts/{id}', [ProductController::class,'myProducts'])->name('product.myProducts');

Route::group([
    'middleware' => 'isAdmin',
],function(){
        Route::get('/adminColor/back/', function () {
            return redirect()->route('adminColor.index');
        });
        Route::get('/adminSize/back/', function () {
            return redirect()->route('adminSize.index');
        });
        Route::get('/admin/back/', function () {
            return redirect()->route('admin.index');
        });

        Route::resource('admin', AdminController::class);
        Route::resource('adminSize', ProductSizeController::class);
        Route::resource('adminColor', ProductColorController::class);
});

});

Route::resource('product', ProductController::class);


