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

Route::get('/', function () {
    return view('dashboard');
});
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

Route::get('/datatrx/bulan/{bulan}', 'data_transaksi\DataTransaksiController@index');
Route::post('/datatrx/json/{bulan}', 'data_transaksi\DataTransaksiController@json');

Route::get('/rekapitulasi/tampildata', 'rekapitulasi\perhitunganRekapController@tampilData');
Route::get('/rekapitulasi/perhitungan/{bulan}', 'rekapitulasi\PerhitunganRekapController@index');

Route::get('/datavendor/{bulan}', 'DataTransaksiProductController@vendor');

Route::get('/dataproductvendor/{vendor}/{bulan}/{status}', 'DataTransaksiProductController@index');
Route::get('/dataproduct/{bulan}', 'DataTransaksiProductController@product');

Route::get('/dataumur/{awal}/{akhir}', 'DataUmurUserController@index');

Route::get('/typeuser/{type}', 'DataUserTypeController@index');

Route::get('/dataday', 'ReportDataDayController@countSum');

Route::get('/data_asal_user', 'data_asal_user\DataAsalUserController@index');

Route::get('/super_active_member/tampildata', 'super_active_member\SuperActiveMemberController@tampilData');
Route::get('/super_active_member/perhitungan/{bulan}', 'rekapitulasi\PerhitunganRekapController@superActiveMember');

Route::get('/register/tampildata', 'register\RegisterController@tampilData');
Route::get('/register/tampildatamember/{bulan}', 'register\RegisterController@tampilDataMember');
Route::get('/register/perhitungan/{bulan}', 'register\RegisterController@hitungMember');