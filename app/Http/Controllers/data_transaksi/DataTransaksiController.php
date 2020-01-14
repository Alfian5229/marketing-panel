<?php

namespace App\Http\Controllers\data_transaksi;

use Illuminate\Http\Request;
use App\ReportTrxCountSumModel;
use DB;

class DataTransaksiController extends Controller
{
    // public function index(){
    //     return view('data_trx');
    // }

    public function index(){
        ini_set('memory_limit', '1G');
        $max_tanggal = 31;

        $data = ReportTrxCountSumModel:://select('mbr_code', 'full_name', 'phone', 'sum_1', 'count_1', 'sum_2', 'count_2')
        orderBy('mbr_code')
        ->get();
        return view('data_trx', compact('data', 'max_tanggal'));
    }

    public function json(){
        ini_set('memory_limit', '1G');

        $data = ReportTrxCountSumModel::select('mbr_code', 'full_name', 'phone')
            ->orderBy('mbr_code')
            ->limit(10)
            ->get()->toJson(JSON_PRETTY_PRINT);
        return $data;
    }
}

