<?php

namespace App\Http\Controllers\data_transaksi;

use Illuminate\Http\Request;
use App\ReportTrxCountSumModel;
use DB;
use DataTables;
use Carbon\Carbon;

class DataTransaksiController extends Controller
{
    // public function index(){
    //     return view('data_trx');
    // }

    public function index($bulan){
        ini_set('memory_limit', '1G');
        // Menentukan jumlah hari dalam 1 bulan
        $carbon = Carbon::now();
        $carbon->year(2019)->month($bulan);
        // dd($carbon->daysInMonth);

        if(strlen($bulan) == 1){
            $bulan = '0' . $bulan;
        }

        $max_tanggal = $carbon->daysInMonth;
        
        // $data = ReportTrxCountSumModel:://select('mbr_code', 'full_name', 'phone', 'sum_1', 'count_1', 'sum_2', 'count_2')
        // orderBy('mbr_code')
        // ->get();
        $data = DB::table('report_trx_count_sum_2019_' . $bulan)
        ->orderBy('mbr_code')
        ->get();

        return view('data_trx', compact('data', 'max_tanggal', 'bulan'));
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

