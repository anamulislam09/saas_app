<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlanceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpDetailController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpProcessController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\OthersIncomeController;
use App\Http\Controllers\PdfGeneratorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Models\Category;
use App\Models\OthersIncome;
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

// Customer Forgate password route start here 
Route::get('/admin/forgot-password', [AdminController::class, 'Forgot'])->name('admin.forgot-password');
Route::post('/admin/forgot-password/create', [AdminController::class, 'ForgotPassword'])->name('admin.forgot-password.create');
Route::get('/admin/reset/{token}', [AdminController::class, 'reset']);
Route::post('/admin/reset/{token}', [AdminController::class, 'PostReset']);
// Customer Forgate password route ends here 

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');

    // Customer show 
    Route::get('/customers', [AdminController::class, 'Customer'])->name('customers.all');
    Route::get('/customers/edit/{id}', [AdminController::class, 'CustomerEdit'])->name('customer.edit');
    Route::post('/customers/update', [AdminController::class, 'CustomerUpdate'])->name('customers.update');

    // admin login route start here 
    Route::post('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    //    Permission route 
    // Route::get('/all-permission', [RoleController::class, 'AllPermission'])->name('all.permission');
    // Route::get('/permission/create', [RoleController::class, 'Create'])->name('permission.create');
    //   Route::post('/user/update', [UserController::class, 'Update'])->name('user.update');
    //   Route::post('/user/delete', [UserController::class, 'Destroy'])->name('user.delete');

    //    Category route 
    Route::get('/category', [CategoryController::class, 'Index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'Create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'Store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'Edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'Update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'Destroy'])->name('category.delete');
});

/*---------------- Admin route ends here ------------------*/
// , 'middleware' => ['admin']
/*---------------- Customer route start here ------------------*/
Route::group(['prefix' => 'admin'], function () {
    //    Flat setup route 
    Route::get('/manage-flat', [FlatController::class, 'Index'])->name('flat.index');
    Route::get('/manage-flat/create', [FlatController::class, 'Create'])->name('flat.create');
    Route::post('/manage-flat/store', [FlatController::class, 'Store'])->name('flat.store');
    Route::get('/manage-flat/single-create', [FlatController::class, 'SingleCreate'])->name('flat.singlecreate');
    Route::post('/manage-flat/single-store', [FlatController::class, 'SingleStore'])->name('flat.singlestore');

    //    users route 
    Route::get('/users', [UserController::class, 'Index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'Create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'Store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'Edit']);
    Route::post('/users/update', [UserController::class, 'Update'])->name('users.update');
    Route::post('/users/delete', [UserController::class, 'Destroy'])->name('users.delete');

    // single users route
    Route::get('/user/create', [UserController::class, 'SingleCreate'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'SingleStore'])->name('user.store');

    //    Expense-details route 
    Route::get('/expense/create', [ExpDetailController::class, 'Create'])->name('expense.create');
    Route::post('/expense/store', [ExpDetailController::class, 'Store'])->name('expense.store');
    Route::get('/expense-details/edit/{id}', [ExpDetailController::class, 'Edit']);
    Route::post('/expense-details/update', [ExpDetailController::class, 'Update'])->name('expense-details.update');
    Route::get('/expense-details/delate/{id}', [ExpDetailController::class, 'Delate'])->name('expense-details.delate');

    Route::get('/expense-summary', [ExpDetailController::class, 'Index'])->name('expense-summary.index');

    //    Expense route 
    // Route::get('/expenses', [ExpenseController::class, 'Index'])->name('expenses.index');
    // Route::get('/expense-summary/store', [ExpenseController::class, 'Store'])->name('expense-summary.store');

    //     report route start here 
    // Route::get('/expenses/all', [ExpProcessController::class, 'Index'])->name('expenses.process');
    Route::get('/expenses/month', [ExpDetailController::class, 'MonthlyExpense'])->name('expenses.month');

    // account route start here 
    Route::get('/ledger-posting', [ExpenseController::class, 'Index'])->name('ledgerPosting.index');
    Route::get('/ledger-posting/store', [ExpProcessController::class, 'Store'])->name('ledger-posting.store');
    // Route::get('/expense-process/store', [ExpProcessController::class, 'Store'])->name('expense_process.store');
    Route::get('/opening-balance/create', [BlanceController::class, 'OpeningBalance'])->name('opening.balance.create');
    Route::post('/opening-balance/store', [BlanceController::class, 'OpeningBalanceStore'])->name('opening.balance.store');
    // account route ends here 

    //    Expense process route 
    // Route::get('/expense.process', [ExpProcessController::class, 'Index'])->name('expenses.index');
    // // Route::get('/expense-process/store', [ExpProcessController::class, 'Store'])->name('expense_process.store');

    //    income route  
    Route::get('/income', [IncomeController::class, 'Create'])->name('income.create');
    Route::post('/income/store', [IncomeController::class, 'Store'])->name('income.store');
    Route::get('/income/collection', [IncomeController::class, 'Collection'])->name('income.collection');
    Route::post('/income/collection/store/', [IncomeController::class, 'StoreCollection'])->name('income.collection.store');


    /*------------------------- Expense voucher route srtart here-------------------------*/
    // Expense Management 
    Route::get('/expense/create-voucher/{id}', [PdfGeneratorController::class, 'CreateVoucher'])->name('expense.voucher.create');
    Route::post('/expense/generate-voucher', [PdfGeneratorController::class, 'GenerateVoucher'])->name('expense.voucher.generate');
    Route::get('/expense/generate-voucher-all', [PdfGeneratorController::class, 'GenerateVoucherAll'])->name('expense.voucher.generateall');
    // Expense Accounts 
    Route::post('/account/expense-voucher-all', [PdfGeneratorController::class, 'GenerateExpenseVoucherAll'])->name('account.expense.voucher.generateall');
    /*------------------------- expense voucher route srtart here-------------------------*/

    /*------------------------- income voucher route start here-------------------------*/
    Route::get('/income/generate-voucher/{id}', [PdfGeneratorController::class, 'GenerateIncomeVoucher'])->name('income.voucher.generate');
    Route::post('/income/generate-voucher-all', [PdfGeneratorController::class, 'GenerateIncomeVoucherAll'])->name('income.voucher.generateall');
    /*------------------------- income voucher route ends here-------------------------*/

    /*--------------- Accounts voucher route start here ------------------*/
    // collection
    Route::get('/income/collection-voucher', [VoucherController::class, 'Index'])->name('income.collection.index');
    Route::post('/income/collection-all', [VoucherController::class, 'CollectionAll'])->name('income.collection.all');
    //expense
    Route::get('/account/expense-voucher', [VoucherController::class, 'ExpenseIndex'])->name('account.expense.index');
    Route::post('/account/expense-all', [VoucherController::class, 'ExpenseAll'])->name('account.expense.all');
    //Balance sheet
    Route::get('/account/balance', [VoucherController::class, 'BalanceSheet'])->name('account.balancesheet');
    Route::post('/account/balance-all', [VoucherController::class, 'AllBalanceSheet'])->name('account.allbalancesheet');
    Route::get('/income-statement', [VoucherController::class, 'Incomes'])->name('income.statement');
    /*--------------- Accounts voucher route ends here ------------------*/

    /*--------------- Report route start here ------------------*/
    Route::get('/expenses/month', [ReportController::class, 'MonthlyExpense'])->name('expenses.month');
    Route::post('/expenses-all/month', [ReportController::class, 'MonthlyAllExpense'])->name('expensesall.month');
    Route::get('/expenses/yearly', [ReportController::class, 'YearlyExpense'])->name('expenses.year');
    Route::post('/expenses-all/year', [ReportController::class, 'YearlyAllExpense'])->name('expensesall.year');

    Route::get('/incomes/month', [ReportController::class, 'MonthlyIncome'])->name('incomes.month');
    Route::post('/incomes-all/month', [ReportController::class, 'MonthlyAllIncome'])->name('incomesall.month');
    Route::get('/incomes/yearly', [ReportController::class, 'YearlyIncome'])->name('incomes.year');
    Route::post('/incomes-all/yearly', [ReportController::class, 'YearlyAllIncome'])->name('incomesall.year');

    /*--------------- Report route ends here ------------------*/

    /*--------------- Others Income route start here ------------------*/
    Route::get('/others-income/create', [OthersIncomeController::class, 'OthersIncomeCreate'])->name('others.income.create');
    Route::post('/others-income/store', [OthersIncomeController::class, 'OthersIncomeStore'])->name('others.income.store');
    /*--------------- Others Income route ends here ------------------*/

    //    Balance route 
    // Route::get('/balance/month', [BlanceController::class, 'Monthly'])->name('monthly.blance.index');
    // Route::get('/balance/year', [BlanceController::class, 'Yearly'])->name('yearly.blance.index');


    //    Report route 
    Route::get('/balance-sheet', [BlanceController::class, 'BalanceSheet'])->name('blance.index');
    // Route::get('/all-expenses', [BlanceController::class, 'Expenses'])->name('expense-all.index');
});

/*---------------- Customer route ends here ------------------*/

/*---------------- User route start here ------------------*/
Route::get('/user-login', [UserController::class, 'LoginForm'])->name('user.login_form');
Route::post('/user-login/owner', [UserController::class, 'Login'])->name('user.login');
Route::get('/user/profile', [UserController::class, 'Profile'])->name('user.Profile');



/*---------------- User route ends here ------------------*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
