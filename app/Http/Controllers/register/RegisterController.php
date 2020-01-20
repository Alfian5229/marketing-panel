<?php

namespace App\Http\Controllers\register;

use App\Rekapitulasi;
use App\SuperActiveMember;
use App\MbrList;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function hitungMember($bulan){
        
        $carbon = Carbon::now();
        $carbon->year(2019)->month($bulan);
        $max_tanggal = $carbon->daysInMonth;

        for($i = 1; $i < 1+$max_tanggal; $i++){
            $tanggal = $i;
            if($tanggal == 1+$max_tanggal){
                $tanggal = '01';
                $bulan = $bulan+1;
                if(strlen(1+$bulan) == 1){
                    $bulan = '0' . $bulan;
                }
            }
            else{
                $tanggal_akhir = $tanggal+1;
                if(strlen($tanggal) == 1){
                    $tanggal = '0' . $tanggal;
                }
                if(strlen($bulan) == 1){
                    $bulan = '0' . $bulan;
                }
            }

            $data = MbrList::select('mbr_code', 'mbr_sponsor', DB::raw("TO_CHAR(mbr_date, 'YYYY-MM-DD') AS mbr_date"))
            ->whereRaw("'[2019-" . $bulan . "-" . $tanggal . ", 2019-" . $bulan . "-02]'::tsrange @> mbr_date")
            ->orderBy('mbr_code')
            ->get();
            dd(count($data));
        }
    }
}