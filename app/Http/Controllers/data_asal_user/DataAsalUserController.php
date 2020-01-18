<?php

namespace App\Http\Controllers\data_asal_user;

use Illuminate\Http\Request;
use App\ReportTrxCountSumModel;
use App\MbrList;
use DB;
use DataTables;
use Carbon\Carbon;

class DataAsalUserController extends Controller{
    public function index(){
        // $data = MbrList::Select(DB::raw('upper(mbr_kota) AS asal_kota'), DB::raw('count(1) AS total_user'))
        // ->groupBy(DB::raw('upper(mbr_kota)'))
        // ->orderBy(DB::raw('upper(mbr_kota)'))
        // ->get();
        $data = DB::Select("
            SELECT upper(mbr_kota) AS asal_kota, count(1) AS total_user
            FROM (
                select CASE WHEN mbr_kota is null or mbr_kota = ''
                THEN 'NULL' ELSE mbr_kota END AS mbr_kota
                from mbr_list
            ) as mbr_list
            group by 1
            order by 2 DESC
        ");
        return view('data_asal_user', compact('data'));
    }
}

