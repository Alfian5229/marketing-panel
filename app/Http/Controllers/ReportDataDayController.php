<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportDataDayController extends Controller
{
    //
    public function countSum(){
        set_time_limit(500);
        $bulan = '11';
        $min_tanggal = 1;
        $max_tanggal = 30;

        DB::beginTransaction();
        try {
            $max_tanggal = $max_tanggal+1;
            for($i = $min_tanggal; $i < $max_tanggal; $i++){
                $tanggal = $i;
                $tanggal_report = $i;
                if(strlen($tanggal) == 1){
                    $tanggal = '0' . $tanggal;
                }
                $trx = DB::connection('pgsql')
                    ->select("SELECT mbr_sponsor, COUNT(mbr_sponsor)
                        FROM mbr_list
                        WHERE to_char(mbr_date, 'YYYY-MM-dd') = '2019-" . $bulan . "-" . $tanggal . "'
                        GROUP BY mbr_sponsor
                        ORDER BY mbr_sponsor;
                    ");

                $index = 0;
                foreach($trx as $key){
                    DB::connection('pgsql')
                        ->table('data_register_2019_' . $bulan)
                        ->where('mbr_sponsor', '=', $key->mbr_sponsor)
                        ->update([
                            'day_' . $tanggal_report => $key->count
                        ]);
                }
            }
            DB::commit();
            echo "Alhamdulillah, semoga barokah. Bulan : ". $bulan;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
    }
}
