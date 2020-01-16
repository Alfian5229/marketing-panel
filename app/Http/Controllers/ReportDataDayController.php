<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportDataDayController extends Controller
{
    //
    public function countSum(){
        set_time_limit(500);
        $bulan = '01';
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
                    ->select("SELECT product_kode, COUNT(product_kode)
                        FROM report_transaksi_2019_" . $bulan . "
                        WHERE to_char(tgl_trx, 'YYYY-MM-dd') = '2019-" . $bulan . "-" . $tanggal . "'
                        AND transaksi_status = 'Active'
                        GROUP BY product_kode
                        ORDER BY product_kode;
                    ");

                $index = 0;
                foreach($trx as $key){
                    echo($key->count . " ");
                    DB::connection('pgsql')
                        ->table('data_product_terlaris_2019_' . $bulan)
                        ->where('product_kode', '=', $key->product_kode)
                        ->update([
                            'day_' . $tanggal_report => $key->count
                        ]);
                }
            }
            DB::commit();
            echo "Alhamdulillah, semoga barokah";
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
    }
}
