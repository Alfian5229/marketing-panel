<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DataUmurUserController extends Controller
{
    //
    function index($awal, $akhir){
        $data = DB::connection('pgsql')->select("SELECT * FROM umur_user_" . $awal . "_sampai_" . $akhir . ";");
        // $data = DB::connection('pgsql')->select("SELECT * FROM umur_user_18_sampai_24;");

        // dd($data);
        return view('data_umur_user', compact('data', 'awal', 'akhir'));
    }
}
