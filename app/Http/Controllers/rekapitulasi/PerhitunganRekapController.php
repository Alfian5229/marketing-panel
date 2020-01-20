<?php

namespace App\Http\Controllers\rekapitulasi;

use App\Rekapitulasi;
use App\SuperActiveMember;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class PerhitunganRekapController extends Controller
{
    public function index($bulan){
        $carbon = Carbon::now();
        $carbon->year(2019)->month($bulan);
        $max_tanggal = $carbon->daysInMonth;

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

        //sum gagal
        $sum = array();
        for($i = 1; $i < 1+$max_tanggal; $i++){
            $tanggal = $i;
            $data = DB::table('report_trx_count_sum_gagal_2019_' . $bulan)
                ->selectRaw('sum(sum_' . $tanggal . ')')
                ->first();
            $sum[$i-1] = $data->sum;
        }
        $total_sum_gagal = 0;
        foreach ($sum as $key) {
            $total_sum_gagal = $total_sum_gagal + $key;
        }
        
        //count gagal
        $count = array();
        for($i = 1; $i < 1+$max_tanggal; $i++){
            $tanggal = $i;
            $data = DB::table('report_trx_count_sum_gagal_2019_' . $bulan)
                ->selectRaw('sum(count_' . $tanggal . ')')
                ->first();
            $count[$i-1] = $data->sum;
        }
        $total_count_gagal = 0;
        foreach ($count as $key) {
            $total_count_gagal = $total_count_gagal + $key;
        }

        //unique sukses
        $data = DB::table('report_trx_count_sum_2019_' . $bulan)
            ->selectRaw('count(distinct mbr_code)')
            ->first();
        $unique_user = $data->count;

        //unique gagal
        $data = DB::table('report_trx_count_sum_gagal_2019_' . $bulan)
            ->selectRaw('count(distinct mbr_code)')
            ->first();
        $unique_user_gagal = $data->count;

        DB::table('rekapitulasi_2019')
            ->where('id', $bulan)
            ->update([
                'sum_sukses'        => $total_sum,
                'count_sukses'      => $total_count,
                'sum_gagal'         => $total_sum_gagal,
                'count_gagal'       => $total_count_gagal,
                'unique_user_sukses'=> $unique_user,
                'unique_user_gagal' => $unique_user_gagal,
            ]);

        echo 'total_sum_sukses:' . $total_sum . ' total_count_sukses:' . $total_count . ' total_sum_gagal:' . $total_sum_gagal . ' total_count_gagal:' . $total_count_gagal . ' unique user sukses:' . $unique_user . ' unique user gagal:' . $unique_user_gagal;
    }

    public function superActiveMember($bulan){
        ini_set('memory_limit', '1G');
        //month loop
        for($bulan = 1; $bulan < 13; $bulan++){
            $carbon = Carbon::now();
            $carbon->year(2019)->month($bulan);
            $max_tanggal = $carbon->daysInMonth;
            $nama_bulan = strtolower($carbon->format('F'));

            if(strlen($bulan) == 1){
                $bulan = '0' . $bulan;
            }

            $super_active = 0;
            $data = DB::table('report_trx_count_sum_2019_' . $bulan)->get();

            //row loop
            foreach($data as $key){
                $temp = 0;
                //column loop
                for($i = 1; $i < 1+$max_tanggal; $i++){
                    $count = 'count_' . $i;
                    if($key->$count != 0){
                        $temp = $temp+1;
                    }
                }
                if($temp >= 15){
                    $super_active = $super_active+1;

                    DB::table('super_active_member_2019')
                    ->where('mbr_code', $key->mbr_code)
                    ->update([
                        $nama_bulan => $temp
                    ]);
                }
            }

            DB::table('rekapitulasi_2019')
            ->where('id', $bulan)
            ->update([
                'trx_two_days_each' => $super_active
            ]);
        }

    }

    public function tampilData(){
        $data = Rekapitulasi::orderBy('id')->get();

        return view('rekapitulasi', compact('data'));
    }
}