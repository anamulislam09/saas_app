<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/customers', [AdminController::class, 'index']);
Route::post('/add-customer', [AdminController::class, 'store']);
Route::get('/customer/{id}', [AdminController::class, 'show']);
Route::get('/customer/edit/{id}', [AdminController::class, 'edit']);
Route::put('/customer/edit/{id}', [AdminController::class, 'update']);
