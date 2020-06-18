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