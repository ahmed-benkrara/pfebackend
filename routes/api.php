<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\ModuleimagesController;
use App\Http\Controllers\ClientDetailsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\VerificationController;

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

//Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::group(['middleware' => ['auth:sanctum']], function(){
    //logout
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('/packages', PackageController::class);
    Route::resource('/modules', ModeleController::class);

    //module images
    Route::post('/moduleimage', [ModuleimagesController::class, 'store']);
    Route::delete('/moduleimage/{id}', [ModuleimagesController::class, 'destroy']);

    //Client details
    Route::post('/clientdetails', [ClientDetailsController::class, 'store']);
    Route::patch('/clientdetails/{id}', [ClientDetailsController::class, 'update']);

    //Cart
    Route::prefix('cart')->group(function(){
        Route::get('/', [CartController::class, 'index']);
        Route::get('/{id}', [CartController::class, 'show']);
        Route::post('/', [CartController::class, 'store']);
        Route::delete('/{id}', [CartController::class, 'destroy']);
    });

    Route::apiResource('/cartitems', CartItemController::class);
    // Route::prefix('cartitems')->group(function(){
    //     Route::get('/', [CartItemController::class, 'index']);
    //     Route::get('/{id}', [CartItemController::class, 'show']);
    //     Route::post('/', [CartItemController::class, 'store']);
    //     Route::delete('/{id}', [CartItemController::class, 'destroy']);
    // });
    Route::apiResource('/orders', OrderController::class);
    Route::apiResource('/orderitems', OrderItemController::class);

});