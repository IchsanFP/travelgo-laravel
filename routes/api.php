<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\FlutterTransactionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('packages', TravelController::class);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/getUserById/{id}', [AuthController::class, 'getUserById']);

Route::post('/transaction/{id}', [CheckoutController::class, 'process']);

Route::post('/history', [HistoryController::class, 'show']);

Route::post('/make-transaction', [FlutterTransactionController::class, 'transaction']);

Route::post('/make-detailTransaction', [FlutterTransactionController::class, 'detailTransaction']);

Route::put('/updateStatus/{id}', [FlutterTransactionController::class, 'update']);

Route::get('/getHistory/{userId}', [FlutterTransactionController::class, 'getUserHistory']);

Route::get('/getVendorPackages/{userId}', [TravelController::class, 'getVendorPackages']);

Route::get('/getPackageTransactions/{userId}', [FlutterTransactionController::class, 'getPackageTransactions']);

Route::get('/getTransactionDetail/{userId}', [FlutterTransactionController::class, 'getDetailTransaction']);
