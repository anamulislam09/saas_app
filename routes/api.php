<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
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

/*----------------customers api route start here-------------------*/
Route::get('/customers', [AdminController::class, 'index']);
Route::post('/admin-register', [AdminController::class, 'AdminRegister']);
Route::get('/customer/{id}', [AdminController::class, 'show']);
Route::get('/customer/edit/{id}', [AdminController::class, 'edit']);
Route::put('/customer/edit/{id}', [AdminController::class, 'update']);
// Route::delete('/customer/delete/{id}', [AdminController::class, 'delete']);

// customer login 
Route::post('/admin-login', [AdminController::class, 'AdminLogin']);

/*----------------customers api route ends here-------------------*/

/*----------------users api route start here-------------------*/
Route::get('/users', [UserController::class, 'index']);
Route::post('/user-register', [UserController::class, 'UserRegister']);
Route::get('/user/{id}', [UserController::class, 'show']);

// customer login 
Route::post('/user-login', [UserController::class, 'UserLogin']);
/*----------------users api route ends here-------------------*/

/*----------------roles api route start here-------------------*/
Route::get('/roles', [RoleController::class, 'index']);
Route::post('/add-role', [RoleController::class, 'store']);
Route::delete('/role/delete/{id}', [RoleController::class, 'destroy']);
/*----------------roles api route ends here-------------------*/