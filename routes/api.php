<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\StorageController;

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

Route::middleware(['auth:sanctum','cors'])->group( function () {
    Route::resource('food', FoodController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('storage', StorageController::class);
    Route::resource('user', UserController::class);

    // Get Authenticated User Details
    Route::get('/user', [UserController::class, 'show']);

    // Return QR Code pictrue for food item by ID
    Route::get('/qr-code/{id}', [FoodController::class, 'qrCodePicture']);
    Route::get('/test', function() {
        phpinfo();
    });
});

Route::post('/login', [UserController::class, 'login']);
