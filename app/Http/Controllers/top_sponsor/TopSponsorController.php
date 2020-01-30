<?php

namespace App\Http\Controllers\top_sponsor;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class TopSponsorController extends Controller
{
    public function perhitungan(){
        $tahun = '2018';

        for($i = 1; $i < 13; $i++){
            $bulan = $i;
            if(strlen($bulan) == 1){
                $bulan = '0' . $bulan;
            }

            $data = DB::table('mbr_list')
            ->select('mbr_sponsor AS sponsor_' . $bulan, DB::raw('count(mbr_sponsor) AS count_1'))
            ->where('mbr_sponsor', '!=', 'EKL0000000')
            ->whereRaw("to_char(mbr_date, 'YYYY-MM') = '" . $tahun . "-" . $bulan . "'")
            ->groupBy('mbr_sponsor')
            ->orderByRaw('2 DESC, 1 ASC')
            ->limit(100)
            ->get();
            dd($data);
        }

    }
}