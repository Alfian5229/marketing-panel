<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');
Route::get('/transaksi', 'TransaksiController@index');

Route::get('/mesintrxcountperday', 'TransaksiController@mesinTrxCountPerDay');

Route::get('/reportyearlytrx', 'ReportYearlyTrxController@index');
Route::get('/testsatu', 'ReportYearlyTrxController@dailyActiveTrx_satu');
Route::get('/testdua', 'ReportYearlyTrxController@dailyActiveTrx_dua');

Route::get('/monthlyactivetrx', 'ReportYearlyTrxController@monthlyActiveTrx');
Route::get('/monthlyactivetrxfull', 'ReportYearlyTrxController@monthlyActiveTrxFull');

Route::get('/membertrxeachmonth', 'ReportYearlyTrxController@memberTrxEachMonth');
Route::get('/membertrxeachmonthfull', 'ReportYearlyTrxController@memberTrxEachMonthFull');

Route::get('/countsum', 'ReportTrxCountSumController@countSum');

Route::get('/phpinfo', 'PhpInfoController@index');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/datatrx{bulan}', 'data_transaksi\DataTransaksiController@index');