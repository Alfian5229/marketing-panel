<?php

namespace App\Http\Controllers\hitung_december;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class HitungDecemberController extends Controller
{
    public function perhitungan(){
        $bulan = '07';

        $A_total = 0;
        $B_total = 0;
        $C_total = 0;
        $D_total = 0;
        $A = 0;
        $B = 0;
        $C = 0;
        $D = 0;
        for($i = 1; $i < 32; $i++){

            $tanggal = $i;
            if(strlen($tanggal) == 1){
                $tanggal = '0' . $tanggal;
            }
            $now = '2019-' . $bulan . '-' . $tanggal;
            $query = DB::select("select A.mbr_code, to_char(B.mbr_date, 'YYYY-MM') AS mbr_date
            from report_transaksi_2019_" . $bulan . " AS A
            join mbr_list AS B ON A.mbr_code = B.mbr_code
            where A.transaksi_status = 'Active' AND
            to_char(tgl_sukses, 'YYYY-MM-DD') = '2019-" . $bulan . "-" . $tanggal . "'
            group by A.mbr_code, 2
            order by A.mbr_code");

            foreach($query AS $key){
                $date = Carbon::parse($key->mbr_date);
                $now = Carbon::parse($now);
                $diff = $date->diffInDays($now);

                if($diff <= 30){
                    $A++;
                    $A_total++;
                }
                else if($diff <= 90){
                    $B++;
                    $B_total++;
                }
                else if($diff <= 180){
                    $C++;
                    $C_total++;
                }
                else{
                    $D++;
                    $D_total++;
                }
            }

            echo 'A_'. $tanggal .' = ' . $A . '<br>';
            echo 'B_'. $tanggal .' = ' . $B . '<br>';
            echo 'C_'. $tanggal .' = ' . $C . '<br>';
            echo 'D_'. $tanggal .' = ' . $D . '<br>';

            $A = 0;
            $B = 0;
            $C = 0;
            $D = 0;
        }

        echo 'A_total = ' . $A_total . '<br>';
        echo 'B_total = ' . $B_total . '<br>';
        echo 'C_total = ' . $C_total . '<br>';
        echo 'D_total = ' . $D_total . '<br>';
    }
}