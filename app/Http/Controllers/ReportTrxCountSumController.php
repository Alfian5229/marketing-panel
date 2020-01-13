<?php

namespace App\Http\Controllers;

use App\ReportDailyTrxModel;
use App\ReportMonthlyTrxModel;
use App\ReportMonthlyTrxFullModel;

use Illuminate\Http\Request;
use DB;

class ReportTrxCountSumController extends Controller
{
    public function index(){

    }

    public function countSum(){
        $bulan = '12';
        $min_tanggal = 15;
        $max_tanggal = 31;

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
                    ->select("SELECT mbr_code, COUNT(mbr_code), SUM(harga_jual)
                        FROM report_transaksi_2019_" . $bulan . "
                        WHERE to_char(tgl_trx, 'YYYY-MM-dd') = '2019-" . $bulan . "-" . $tanggal . "' 
                        AND transaksi_status = 'Active'
                        GROUP BY mbr_code
                        ORDER BY mbr_code;
                    ");

                $index = 0;
                foreach($trx as $key){
                    DB::connection('pgsql')
                        ->table('report_trx_count_sum_2019_' . $bulan)
                        ->where('mbr_code', '=', $key->mbr_code)
                        ->update([
                            $tanggal_report . '_sum' => $key->sum,
                            $tanggal_report . '_count' => $key->count
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

// SELECT mbr_code, COUNT(mbr_code), SUM(harga_beli)
// FROM report_transaksi_2019_01
// WHERE to_char(tgl_trx, 'YYYY-MM-dd') = '2019-01-01'
// AND transaksi_status = 'Active'
// GROUP BY mbr_code
// ORDER BY mbr_code

