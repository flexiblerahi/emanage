<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'active']], function () {
    Route::get('/search-tag', [App\Http\Controllers\ReportController::class, 'search'])->name('search');
    Route::get('/', [App\Http\Controllers\ReportController::class, 'index'])->name('index');
    Route::get('/customer-list', [App\Http\Controllers\ReportController::class, 'customersReport'])->name('customer');

    Route::get('/agent-list', [App\Http\Controllers\ReportController::class, 'agentsReport'])->name('agent');
    Route::get('/agent-details-list', [App\Http\Controllers\ReportController::class, 'agentsDetailsReport'])->name('agent.details');

    Route::get('/shareholder-list', [App\Http\Controllers\ReportController::class, 'shareholdersReport'])->name('shareholder');
    
    Route::get('/deposit-list', [App\Http\Controllers\Report\TransactionReportController::class, 'depositReport'])->name('deposit');
    Route::get('/withdraw-list', [App\Http\Controllers\Report\TransactionReportController::class, 'withdrawReport'])->name('withdraw');
    Route::get('/transaction-list', [App\Http\Controllers\Report\TransactionReportController::class, 'transactionReport'])->name('transaction');

    Route::get('/sale-list', [App\Http\Controllers\Report\SaleReportController::class, 'saleReport'])->name('sale');

    Route::match(['get', 'post'], '/all', [App\Http\Controllers\ReportController::class, 'all'])->name('all');
    Route::get('/user-info', [App\Http\Controllers\Report\UserReportController::class, 'userInfo'])->name('user.info');

    Route::get('/sale-payment-list-report', [App\Http\Controllers\Report\SaleReportController::class, 'salePaymentList'])->name('sale-payment.report-list');

    Route::get('/sale-payment/{id}', [App\Http\Controllers\Report\SaleReportController::class, 'salePaymentReport'])->name('sale-payment.report');
    
    Route::get('user-detail-list', [App\Http\Controllers\CommissionReportController::class, 'list'])->name('user-detail.list');
    Route::get('commission-sale-list', [App\Http\Controllers\Report\SaleReportController::class, 'list'])->name('commission-sale-list');
    
});
