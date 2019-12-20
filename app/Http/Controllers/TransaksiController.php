<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ReportTransaksi;

class TransaksiController extends Controller
{
    public function index(){
        $reportTransaksi = ReportTransaksi::selectRaw('to_char(tgl_trx, \'YYYY-MM-DD\') AS date, count(to_char(tgl_trx, \'YYYY-MM-DD\')) AS total_transaksi')
        ->groupBy('date')
        ->orderBy('date', 'DESC')
        ->get();

        dd($reportTransaksi);
    }
}
