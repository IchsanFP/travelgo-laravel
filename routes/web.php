<?php

use App\Http\Controllers\HomeController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home')
    ->middleware('auth');
Route::get('/travel', 'App\Http\Controllers\TravelController@index')->name('travel');
Route::get('/detail/{slug}', 'App\Http\Controllers\DetailController@index')->name('detail');
Route::resource('history', 'App\Http\Controllers\HistoryController');
Route::get('/register_vendor', function () {
    return view('auth.register_vendor');
})->name('register_vendor');

Route::post('/checkout/{id}', 'App\Http\Controllers\CheckoutController@process')
    ->name('checkout_process')
    ->middleware('auth');

Route::post('/checkout/{id}/upload', 'App\Http\Controllers\CheckoutController@upload')->name('checkout.upload');

Route::get('/checkout/{id}', 'App\Http\Controllers\CheckoutController@index')
    ->name('checkout')  
    ->middleware('auth');

Route::post('/checkout/create/{detail_id}', 'App\Http\Controllers\CheckoutController@create')
    ->name('checkout-create')
    ->middleware('auth');

Route::get('/checkout/remove/{detail_id}', 'App\Http\Controllers\CheckoutController@remove')
    ->name('checkout-remove')
    ->middleware('auth');

Route::get('/checkout/confirm/{id}', 'App\Http\Controllers\CheckoutController@success')
    ->name('checkout-success')
    ->middleware('auth'); 

Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');
        Route::resource('travel-package', 'App\Http\Controllers\Admin\TravelPackageController');
        Route::resource('gallery', 'App\Http\Controllers\Admin\GalleryController');
        Route::resource('transaction', 'App\Http\Controllers\Admin\TransactionController');
    });

Route::prefix('vendor')
    ->namespace('App\Http\Controllers\Vendor')
    ->middleware(['auth', 'vendor'])
    ->group(function() {
        Route::get('/', 'DashboardVendorController@index')
            ->name('dashboard-vendor');
        Route::resource('travel-vendor', 'App\Http\Controllers\Vendor\TravelVendorController');
        Route::resource('gallery-vendor', 'App\Http\Controllers\Vendor\GalleryVendorController');
    });

Auth::routes();