<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use  App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {return view('welcome');});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::group(['prefix' => 'admin'], function () {
        Route::resource('/category', CategoryController::class,['names' => 'admin.category']);

//        Route::resource('/sub-category', SubCategoryController::class,['names' => 'admin.sub-category']);
//
//        Route::resource('/brand', BrandController::class,['names' => 'admin.brand']);
//
//        Route::resource('/color', ColorController::class,['names' => 'admin.color']);
//
//        Route::resource('/size', SizeController::class,['names' => 'admin.size']);
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('/sub-category', SubCategoryController::class,['names' => 'admin.sub-category']);
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('/brand', BrandController::class,['names' => 'admin.brand']);
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('/color', ColorController::class,['names' => 'admin.color']);
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('/size', SizeController::class,['names' => 'admin.size']);
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('/supplier', SupplierController::class,['names' => 'admin.supplier']);
    });
    Route::group(['prefix' => 'admin' ], function (){
       Route::resource('/product',ProductController::class,['names' => 'admin.product']);
    });

});
