<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\OfficeSupplyController;

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

//Route::middleware(['auth:sanctum','cors'])->group( function () {
Route::middleware(['auth:sanctum'])->group( function () {
    Route::apiResource('user', UserController::class);
    Route::apiResource('food', FoodController::class);
    Route::apiResource('office-supply', OfficeSupplyController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('storage', StorageController::class);
    Route::apiResource('unit', UnitController::class);

    // Get Authenticated User Details
    Route::get('/user', [UserController::class, 'show']);

    // QR Endpoints for Food Model
    Route::get('/food/generateQRCode/{id}', [FoodController::class, 'qrCodePicture']);
    Route::get('/food/getByQRcode/{barcode}', [FoodController::class, 'getItemByQR']);

    // QR Endpoints for Office Supply Model
    Route::get('/office-supply/generateQRCode/{id}', [OfficeSupplyController::class, 'qrCodePicture']);
    Route::get('/office-supply/getByQRcode/{barcode}', [OfficeSupplyController::class, 'getItemByQR']);

    // PHP INFO
    Route::get('/phpinfo', function() {
        phpinfo();
    });
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
