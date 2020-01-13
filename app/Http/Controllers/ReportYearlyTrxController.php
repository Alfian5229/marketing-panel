<?php

namespace App\Http\Controllers;

use App\ReportDailyTrxModel;
use App\ReportMonthlyTrxModel;
use App\ReportMonthlyTrxFullModel;

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

    public function dailyActiveTrx_satu(){
        $bulan = 'january';
        $bulan_angka = '01';
        $min_count = 15;

        $mbr_code = ReportDailyTrxModel::select('mbr_code')
            ->orderBy('mbr_code')
            ->offset(0)
            ->limit(10)
            ->get();
        foreach($mbr_code as $key){
            $trx = DB::connection('pgsql_live')
            ->select("SELECT count(tgl_trx)
                FROM report_transaksi_2019_" . $bulan_angka . "
                WHERE mbr_code = '" . $key->mbr_code . "' AND
                transaksi_status = 'Active'
                LIMIT 1
            ");
            if($trx){
                $insert = ReportDailyTrxModel::where('mbr_code', '=', $key->mbr_code)
                    ->update([$bulan => $trx[0]->count]);
            }
            if($trx){
                if($trx[0]->count >= $min_count){
                    $insert = ReportDailyTrxModel::where('mbr_code', '=', $key->mbr_code)
                    ->update([$bulan . '_active' => 1]);
                }
            }
        }
    }

    public function dailyActiveTrx_dua(){
        $bulan = 'january';
        $bulan_angka = '01';
        $min_count = 15;

        $limit_query = '1000';
        $trx = DB::connection('pgsql_live')
        ->select("SELECT mbr_code
            FROM report_transaksi_2019_" . $bulan_angka . "
            transaksi_status = 'Active'
            LIMIT " . $limit_query
        );

        foreach($trx as $key){
            echo $trx->mbr_code;
        }
    }

    public function monthlyActiveTrx(){

        $bulan = array(
            'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'
        );

        for($i = 0; $i < 12; $i++){
            $tanggal = $i;
            if(strlen($tanggal) == 1){
                $tanggal = $tanggal+1;
                $tanggal = '0' . $tanggal;
            }
            if(strlen($tanggal) == 3){
                $tanggal = ltrim($tanggal, '0');
            }
            $offset = '0';
            $limit_query = '100';
            $trx = DB::connection('pgsql_live')
            ->select("SELECT distinct mbr_code
                FROM report_transaksi_2019_" . $tanggal . "
                where transaksi_status = 'Active'
                order by mbr_code
                OFFSET " . $offset
                // . " LIMIT " . $limit_query
            );
            // foreach($trx as $key){
            //     $insert = ReportMonthlyTrxModel::where('mbr_code', '=', $key->mbr_code)
            //         ->update([$bulan => '1']);
            // }
            $mbr_code_collection = array();
            $index = 0;
            foreach($trx as $key){
                $mbr_code_collection[$index] = $key->mbr_code;
                $index++;
            }
            $insert = ReportMonthlyTrxModel::whereIn('mbr_code', $mbr_code_collection)
                ->update([$bulan[$i] => '1']);
        }
    }

    public function monthlyActiveTrxFull(){

        $bulan = array(
            'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'
        );

        for($i = 0; $i < 12; $i++){
            $tanggal = $i;
            if(strlen($tanggal) == 1){
                $tanggal = $tanggal+1;
                $tanggal = '0' . $tanggal;
            }
            if(strlen($tanggal) == 3){
                $tanggal = ltrim($tanggal, '0');
            }
            $offset = '0';
            $limit_query = '100';
            $trx = DB::connection('pgsql_live')
            ->select("SELECT distinct mbr_code
                FROM report_transaksi_2019_" . $tanggal . "

                order by mbr_code
                OFFSET " . $offset
                // . " LIMIT " . $limit_query
            );
            // foreach($trx as $key){
            //     $insert = ReportMonthlyTrxModel::where('mbr_code', '=', $key->mbr_code)
            //         ->update([$bulan => '1']);
            // }
            $mbr_code_collection = array();
            $index = 0;
            foreach($trx as $key){
                $mbr_code_collection[$index] = $key->mbr_code;
                $index++;
            }
            $insert = ReportMonthlyTrxFullModel::whereIn('mbr_code', $mbr_code_collection)
                ->update([$bulan[$i] => '1']);
        }
    }

    public function memberTrxEachMonth(){
        $insert = ReportMonthlyTrxModel::select('mbr_code')
        ->where([
            ['january', '=', '1'],
            ['february', '=', '1'],
            ['march', '=', '1'],
            ['april', '=', '1'],
            ['may', '=', '1'],
            ['june', '=', '1'],
            ['july', '=', '1'],
            ['august', '=', '1'],
            ['september', '=', '1'],
            ['october', '=', '1'],
            ['november', '=', '1'],
            ['december', '=', '1'],
        ])->get();
        dd(count($insert));
    }

    public function memberTrxEachMonthFull(){
        $insert = ReportMonthlyTrxFullModel::select('mbr_code')
        ->where([
            ['january', '=', '1'],
            ['february', '=', '1'],
            ['march', '=', '1'],
            ['april', '=', '1'],
            ['may', '=', '1'],
            ['june', '=', '1'],
            ['july', '=', '1'],
            ['august', '=', '1'],
            ['september', '=', '1'],
            ['october', '=', '1'],
            ['november', '=', '1'],
            ['december', '=', '1'],
        ])->get();
        dd(count($insert));
    }
}

// update dm_report_monthly_active_transaction
// set 
// january = 0,
// february = 0,
// march = 0,
// april = 0,
// may = 0,
// june = 0,
// july = 0,
// august = 0,
// september = 0,
// october = 0,
// november = 0,
// december = 0
