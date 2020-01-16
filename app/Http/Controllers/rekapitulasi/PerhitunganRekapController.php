<?php

namespace App\Http\Controllers\rekapitulasi;

use Illuminate\Http\Request;
use DB;

class PerhitunganRekapController extends Controller
{
    public function index($bulan, $max_tanggal){
        if(strlen($bulan) == 1){
            $bulan = '0' . $bulan;
        }

        //sum sukses
        $sum = array();
        for($i = 1; $i < 1+$max_tanggal; $i++){
            $tanggal = $i;
            $data = DB::table('report_trx_count_sum_2019_' . $bulan)
                ->selectRaw('sum(sum_' . $tanggal . ')')
                ->first();
            $sum[$i-1] = $data->sum;
        }
        $total_sum = 0;
        foreach ($sum as $key) {
            $total_sum = $total_sum + $key;
        }
        
        //count sukses
        $count = array();
        for($i = 1; $i < 1+$max_tanggal; $i++){
            $tanggal = $i;
            $data = DB::table('report_trx_count_sum_2019_' . $bulan)
                ->selectRaw('sum(count_' . $tanggal . ')')
                ->first();
            $count[$i-1] = $data->sum;
        }
        $total_count = 0;
        foreach ($count as $key) {
            $total_count = $total_count + $key;
        }

        $data = DB::table('report_trx_count_sum_2019_' . $bulan)
            ->selectRaw('count(distinct mbr_code)')
            ->first();
        $unique_user = $data->count;

        DB::table('rekapitulasi_2019')
            ->where('id', $bulan)
            ->update([
                'sum_sukses' => $total_sum,
                'count_sukses' => $total_count
            ]);

        echo 'total_sum_sukses:' . $total_sum . ' total_count_sukses:' . $total_count . 'unique user:' . $unique_user;
    }
}