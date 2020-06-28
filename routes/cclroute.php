<?php

use Illuminate\Support\Facades\Route;

/**
 * 'admin' middleware applied to all routes
 *
 * @see \App\Providers\Route::CloudCoderDevRoutes
 */
Route::get('pos', 'Pos\PosController@index')->name('pos');
Route::get('report/incomeByCustomer/{startDate}/{endDate}', 'Common\Reports@incomeByCustomer')->name('report.incomeByCustomer');
Route::get('report/purchaseByVendor/{startDate}/{endDate}', 'Common\Reports@purchaseByVendor')->name('report.purchaseByVendor');
Route::get('report/profitAndLoss/{startDate}/{endDate}', 'Common\Reports@profitAndLoss')->name('report.profitAndLoss');
Route::get('report/salesTaxReport/{startDate}/{endDate}/{reportType}', 'Common\Reports@salesTaxReport')->name('report.salesTaxReport');
Route::get('reports/income_customer', 'Settings\AddCategory@incomeCustomer')->name('reports.income_customer');
Route::get('reports/purchase_vendor', 'Settings\AddCategory@purchaseVendor')->name('reports.purchase_vendor');
Route::get('reports/sales_tax', 'Settings\AddCategory@salesTax')->name('reports.sales_tax');
Route::get('reports/account_balance', 'Settings\AddCategory@accountBalance')->name('reports.account_balance');
Route::get('reports/profit_loss', 'Settings\AddCategory@profitLoss')->name('reports.profit_loss');