<?php

namespace App\Http\Controllers\data_transaksi;

use Illuminate\Http\Request;
use App\ReportTrxCountSumModel;

class DataTransaksiController extends Controller
{
    public function index(){
        $data = ReportTrxCountSumModel::limit(100)->get();
        dd($data);

        return view('data_trx');
    }
}
