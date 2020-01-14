<?php

namespace App\Http\Controllers\data_transaksi;

use Illuminate\Http\Request;
use App\ReportTrxCountSumModel;

class DataTransaksiController extends Controller
{
    public function index(){
        $data = ReportTrxCountSumModel::orderBy('mbr_code')->limit(10)->get();
        return view('data_trx', compact('data'));
    }
}
