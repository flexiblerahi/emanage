<?php

use Illuminate\Support\Facades\Route;

Route::get('/register', [App\Http\Controllers\UserController::class, 'register'])->name('register');
Route::get('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::get('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'create'])->name('password.request');
Route::post('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'store'])->name('password.email');
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [App\Http\Controllers\Auth\NewPasswordController::class, 'store'])->name('password.update');
Route::post('/registration', [App\Http\Controllers\UserController::class, 'usercreate'])->name('registration');
Route::post('/login/check', [App\Http\Controllers\UserController::class, 'checkLogin'])->name('login.check');
Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'active']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home');
    Route::get('/user-profile/{account_id}', [App\Http\Controllers\ProfileController::class, 'index'])->name('user.profile.index');
    Route::post('/user-profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('user.profile.store');
    Route::resource('commission', App\Http\Controllers\CommissionController::class)->except(['create', 'store', 'destroy']);
    Route::get('setting', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.index');
    Route::put('setting/update/{id}', [App\Http\Controllers\SettingController::class, 'update'])->name('setting.update');
    Route::resource('roles',   App\Http\Controllers\RoleController::class);
    Route::resource('sale', App\Http\Controllers\SaleController::class)->except('destroy');
    Route::get('status-update', [App\Http\Controllers\UserDetailController::class, 'updatestatus'])->name('update-status');
    Route::resource('user-detail', App\Http\Controllers\UserDetailController::class);
    Route::get('search-user', [App\Http\Controllers\UserDetailController::class, 'usersearch']);
    Route::resource('deposit-payment', App\Http\Controllers\DepositPaymentController::class);
    Route::get('deposit-old-payment', [App\Http\Controllers\DepositPaymentController::class, 'oldpayment'])->name('old-payment');
    Route::resource('withdraw', App\Http\Controllers\WithdrawController::class);

    /// start 2.0 work
    Route::resource('investor', App\Http\Controllers\InvestorController::class)->except('destroy');
    Route::resource('bank-info', App\Http\Controllers\BankInfoController::class)->except('destroy');
    Route::group(['prefix' => 'pos'], function() { //investment url not working directly that's why use prefix pos
        Route::resource('investment', App\Http\Controllers\InvestmentController::class)->except('destroy'); //pending
        Route::resource('expense', App\Http\Controllers\ExpenseController::class)->except('destory');
    });
    Route::resource('land-purchase', App\Http\Controllers\LandPurchaseController::class)->except('destroy');
    Route::resource('bank-transaction', App\Http\Controllers\BankTransactionController::class)->except('destroy'); //pending
    Route::get('search-investor', [App\Http\Controllers\InvestorController::class, 'search']);
    Route::get('search_bank', [App\Http\Controllers\BankInfoController::class, 'search_bank']);
    Route::resource('expense-item', App\Http\Controllers\ExpenseItemController::class);
    Route::get('expense-item/delete-form/{expenseItem}', [App\Http\Controllers\ExpenseItemController::class, 'deleteForm'])->name('expense-item.delete-form');
    Route::get('expense-item-submenu', [App\Http\Controllers\ExpenseItemController::class, 'submenu'])->name('expense-item.submenu');
    
    // start 3.0 work
    Route::resource('bank-name', App\Http\Controllers\BankNameController::class);
    Route::resource('deposit-other', App\Http\Controllers\DepositOtherController::class);
    Route::resource('employee', App\Http\Controllers\EmployeeController::class);
    Route::get('employee-search', [App\Http\Controllers\EmployeeController::class, 'search']);
    Route::resource('salary', App\Http\Controllers\SalaryController::class);
    Route::resource('type-salary', App\Http\Controllers\TypeSalaryController::class);
    Route::get('type-salary/delete-form/{salaryType}', [App\Http\Controllers\TypeSalaryController::class, 'deleteForm'])->name('type-salary.delete-form');

    Route::get('interest', [App\Http\Controllers\InvestmentCommissionController::class, 'index']);
    Route::resource('customer', App\Http\Controllers\CustomerController::class);
    Route::get('customer-search', [ App\Http\Controllers\CustomerController::class, 'search'])->name('customer-search');
    // start 4.0 work
    Route::resource('agent', App\Http\Controllers\AgentController::class);
    Route::resource('investment-withdraw', App\Http\Controllers\InvestmentWithdrawController::class);
    Route::get('investor-base/commission/{id}', [App\Http\Controllers\InvestmentCommissionController::class, 'investorBase'])->name('investor-base.commission');
    Route::get('investment-base/commission/{id}', [App\Http\Controllers\InvestmentCommissionController::class, 'investmentBase'])->name('investment-base.commission');
});
