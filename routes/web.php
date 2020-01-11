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
Route::get('/test', 'ReportYearlyTrxController@dailyActiveTrxJanuary');
