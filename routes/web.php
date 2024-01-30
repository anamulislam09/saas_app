<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpDetailController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

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


    /*---------------- Admin route start here ------------------*/
    // admin login route start here 
    Route::get('/admin/login', [AdminController::class, 'Index'])->name('login_form');
    Route::post('/admin/login/owner', [AdminController::class, 'Login'])->name('admin.login');

    // admin register route start here 
    Route::get('/admin/register', [AdminController::class, 'AdminRegister'])->name('register_form');
    Route::post('/admin/register/store', [AdminController::class, 'Store'])->name('admin.store');
    // admin register route ends here 

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');

    // Customer show 
    Route::get('/customers', [AdminController::class, 'Customer'])->name('customers.all');
    Route::get('/customers/edit/{id}', [AdminController::class, 'CustomerEdit'])->name('customer.edit');
    Route::post('/customers/update', [AdminController::class, 'CustomerUpdate'])->name('customers.update');

    // admin login route start here 
    Route::post('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    //    Permission route 
    Route::get('/all-permission', [RoleController::class, 'AllPermission'])->name('all.permission');
    Route::get('/permission/create', [UserController::class, 'Create'])->name('permission.create');
    //   Route::post('/user/update', [UserController::class, 'Update'])->name('user.update');
    //   Route::post('/user/delete', [UserController::class, 'Destroy'])->name('user.delete');

    //    Category route 
    Route::get('/category', [CategoryController::class, 'Index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'Create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'Store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'Edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'Update'])->name('category.update');
    Route::post('/category/delete', [CategoryController::class, 'Destroy'])->name('category.delete');
});

/*---------------- Admin route ends here ------------------*/

/*---------------- Customer route start here ------------------*/
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
 //    Flat setup route 
 Route::get('/flat', [FlatController::class, 'Index'])->name('flat.index');
 Route::get('/flat/create', [FlatController::class, 'Create'])->name('flat.create');
 Route::post('/flat/store', [FlatController::class, 'Store'])->name('flat.store');
 Route::get('/flat/single-create', [FlatController::class, 'SingleCreate'])->name('flat.singlecreate');
 Route::post('/flat/single-store', [FlatController::class, 'SingleStore'])->name('flat.singlestore');

 //    users route 
 Route::get('/users', [UserController::class, 'Index'])->name('user.index');
 Route::get('/users/create', [UserController::class, 'Create'])->name('user.create');
 Route::post('/users/store', [UserController::class, 'Store'])->name('user.store');
 Route::get('/user/edit/{id}', [UserController::class, 'Edit'])->name('user.edit');
 Route::post('/user/update', [UserController::class, 'Update'])->name('user.update');
 Route::post('/user/delete', [UserController::class, 'Destroy'])->name('user.delete');

 //    Expense-details route 
 Route::get('/expense-details', [ExpDetailController::class, 'Index'])->name('expense-details.index');
 Route::get('/expense-details/create', [ExpDetailController::class, 'Create'])->name('expense-details.create');
 Route::post('/expense-details/store', [ExpDetailController::class, 'Store'])->name('expense-details.store');
 
 //    Expense route 
 Route::get('/expenses', [ExpenseController::class, 'Index'])->name('expenses.index');
 Route::get('/expense/store', [ExpenseController::class, 'Store'])->name('expense.store');

  //    income route 
  Route::get('/income-category', [IncomeController::class, 'IncomeCategory'])->name('income.category');
  Route::post('/income-category/store', [IncomeController::class, 'StoreIncomeCategory'])->name('IncomeCategory.store');
  Route::get('/generate-bill', [IncomeController::class, 'billGenerate'])->name('generate.bill');
  Route::get('/expense-details/create', [ExpDetailController::class, 'Create'])->name('expense-details.create');
  Route::post('/expense-details/store', [ExpDetailController::class, 'Store'])->name('expense-details.store');

});

/*---------------- Customer route ends here ------------------*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
