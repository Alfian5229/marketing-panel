<?php

namespace App\Http\Controllers\bonus;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class BonusController extends Controller
{
    public function perhitungan($bulan, $tahun){
        $carbon = Carbon::now();
        $carbon->year($tahun)->month($bulan);
        $max_tanggal = $carbon->daysInMonth;

        if(strlen($bulan) == 1){
            $bulan = '0' . $bulan;
        }

        for($i = 1; $i < 1+$max_tanggal; $i++){
            $tanggal = $i;
            if(strlen($i) == 1){
                $tanggal = '0' . $i;
            }

            $data = DB::table('report_bonus_' . $tahun . '_' . $bulan)
                ->select('bonus_type', DB::raw('count(bunus_id)'))
                ->whereRaw("TO_CHAR(bonus_date, 'YYYY-MM-DD') = '" . $tahun . "-" . $bulan . "-" . $tanggal . "'")
                ->groupBy('bonus_type')
                ->get();
            foreach ($data as $key) {
                $bonus_type = strtoupper($key->bonus_type);
                DB::table('report_bonus_perday_' . $tahun . '_' . $bulan)
                ->where('bonus_type', '=', $bonus_type)
                ->update([
                    'day_' . $i => $key->count,
                ]);
            }
        }
    }
}