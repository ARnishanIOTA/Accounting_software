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
Route::get('report/profitAndLoss/{startDate}/{endDate}/{reportType}', 'Common\Reports@profitAndLoss')->name('report.profitAndLoss');
Route::get('report/salesTaxReport/{startDate}/{endDate}/{reportType}', 'Common\Reports@salesTaxReport')->name('report.salesTaxReport');
Route::get('reports/income_customer', 'Settings\AddCategory@incomeCustomer')->name('reports.income_customer');
Route::get('reports/purchase_vendor', 'Settings\AddCategory@purchaseVendor')->name('reports.purchase_vendor');
Route::get('reports/sales_tax', 'Settings\AddCategory@salesTax')->name('reports.sales_tax');
Route::get('reports/account_balance', 'Settings\AddCategory@accountBalance')->name('reports.account_balance');
Route::get('reports/profit_loss', 'Settings\AddCategory@profitLoss')->name('reports.profit_loss');

// pdf route are here
Route::get('report/incomeByCustomerPdf/{startDate}/{endDate}', 'Common\Reports@incomeByCustomerPdf')->name('report.incomeByCustomerPdf');
Route::get('report/purchaseByVendorPdf/{startDate}/{endDate}', 'Common\Reports@purchaseByVendorPdf')->name('report.purchaseByVendorPdf');
Route::get('report/profitAndLossPdf/{startDate}/{endDate}/{reportType}', 'Common\Reports@profitAndLossPdf')->name('report.profitAndLossPdf');
Route::get('report/salesTaxReportPdf/{startDate}/{endDate}/{reportType}', 'Common\Reports@salesTaxReportPdf')->name('report.salesTaxReportPdf');

//Excel Route are here
Route::get('report/incomeByCustomerExcel/{startDate}/{endDate}', 'Common\Reports@incomeByCustomerExcel')->name('report.incomeByCustomerExcel');
Route::get('report/purchaseByVendorExcel/{startDate}/{endDate}', 'Common\Reports@purchaseByVendorExcel')->name('report.purchaseByVendorExcel');
Route::get('report/profitAndLossExcel/{startDate}/{endDate}/{reportType}', 'Common\Reports@profitAndLossExcel')->name('report.profitAndLossExcel');
Route::get('report/salesTaxReportExcel/{startDate}/{endDate}/{reportType}', 'Common\Reports@salesTaxReportExcel')->name('report.salesTaxReportExcel');