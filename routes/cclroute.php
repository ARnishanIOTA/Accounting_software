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


//Inventory route
Route::get('inventory/warehouse/index', 'Inventory\Warehouses@view')->name('inventory.warehouse.index');
Route::post('inventory/warehouse/addWarehouse', 'Inventory\Warehouses@addWarehouse')->name('inventory.warehouse.addWarehouse');
Route::post('inventory/warehouse/addFlat', 'Inventory\Warehouses@addFlat')->name('inventory.warehouse.addFlat');
Route::get('inventory/warehouse/flat/{id}', 'Inventory\Warehouses@viewFlat')->name('inventory.warehouse.flat');
Route::get('inventory/warehouse/room/{id}', 'Inventory\Warehouses@viewRoom')->name('inventory.warehouse.room');
Route::post('inventory/warehouse/addRoom', 'Inventory\Warehouses@addRoom')->name('inventory.warehouse.addRoom');
Route::post('inventory/warehouse/editWarehouse', 'Inventory\Warehouses@editWarehouse')->name('inventory.warehouse.editWarehouse');
Route::post('inventory/warehouse/editFlat', 'Inventory\Warehouses@editFlat')->name('inventory.warehouse.editFlat');
Route::post('inventory/warehouse/editRoom', 'Inventory\Warehouses@editRoom')->name('inventory.warehouse.editRoom');
