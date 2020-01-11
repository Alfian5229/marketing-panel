<?php

namespace App\Http\Controllers;

use App\ReportDailyTrxModel;

use Illuminate\Http\Request;
use DB;

class ReportYearlyTrxController extends Controller
{
    public function index(){
        // $trx = DB::connection('pgsql')
        //     ->table('report_transaksi_2019_01')
        //     ->select('transaksi_id', 'tgl_trx')
        //     ->where(DB::raw("to_char(tgl_trx, 'YYYY-MM-dd')"), '=', '2019-01-01')
        //     ->orderBy('tgl_trx', 'ASC')
        //     ->limit(5)
        //     ->get();
        // dd($trx);

        $trx = DB::connection('pgsql_live')
        ->select("SELECT * FROM report_transaksi_2019_01 where tgl_sukses is not null
        ORDER BY tgl_sukses ASC LIMIT 10");
        dd($trx);
    }

    public function dailyActiveTrxJanuary(){
        $mbr_code = ReportDailyTrxModel::select('mbr_code')
            ->orderBy('mbr_code')
            ->offset(3)
            ->limit(1)
            ->get();
        foreach($mbr_code as $key){
            for($i = 1; $i < 5; $i++){
                $tanggal = $i;
                if(strlen($tanggal) == 1){
                    $tanggal = '0' . $tanggal;
                }
                $trx = DB::connection('pgsql_live')
                ->select("SELECT tgl_trx
                    FROM report_transaksi_2019_01
                    WHERE mbr_code = '" . $key->mbr_code . "' AND to_char(tgl_trx, 'YYYY-MM-dd') = '2019-01-" . $tanggal . "'
                    LIMIT 1
                ");
                if($trx){
                    $insert = ReportDailyTrxModel::where('mbr_code', '=', $key->mbr_code)
                        ->update(['january' => DB::raw('january+1')]);
                }
            }
        }
    }
}
