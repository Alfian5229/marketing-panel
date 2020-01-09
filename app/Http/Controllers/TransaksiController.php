<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ReportTransaksi;
use App\ReportTrxCountPerday;

class TransaksiController extends Controller
{
    public function index(){
        $reportTransaksi = ReportTrxCountPerday::all();
        dd($reportTransaksi);
    }

    public function mesinTrxCountPerDay(){
        $hari_lalu = '52';

        $cekData = ReportTrxCountPerday::whereRaw('EXTRACT(day FROM date) = ' . date('d', strtotime("-" . $hari_lalu . " days")) .
            'AND EXTRACT(month FROM date) = ' . date('m', strtotime("-" . $hari_lalu . " days")) .
            'AND EXTRACT(year FROM date) = ' . date('Y', strtotime("-" . $hari_lalu . " days")))
            ->first();
        if(!$cekData){
            $getData = ReportTransaksi::selectRaw('to_char(tgl_trx, \'YYYY-MM-DD\') AS date,
                    count(to_char(tgl_trx, \'YYYY-MM-DD\')) AS total_transaksi')
            ->whereRaw('tgl_trx::date = \'' . date('Y-m-d', strtotime("-" . $hari_lalu . " days")) . '\'')
            ->groupBy('date')
            ->first();
            if($getData != NULL){
                $insert = new ReportTrxCountPerday;
                $insert->date = $getData->date;
                $insert->total_transaksi = $getData->total_transaksi;
                $insert->save();
            }
            else{
                $insert = new ReportTrxCountPerday;
                $insert->date = date('Y-m-d', strtotime("-" . $hari_lalu . " days"));
                $insert->total_transaksi = 0;
                $insert->save();
            }

            print_r('OK');
        }
        else{
            print_r('SUDAH ADA!!!');
        }
    }
}
