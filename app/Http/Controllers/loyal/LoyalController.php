<?php

namespace App\Http\Controllers\loyal;

use App\Rekapitulasi;
use App\SuperActiveMember;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class LoyalController extends Controller
{
    public function perhitungan($tahun){
        $tanggal_reg = '01';
        
        $mbr_code = DB::select('
        select distinct mbr_code from report_transaksi_2018_01
        UNION DISTINCT
        select distinct mbr_code from report_transaksi_2018_02
        UNION DISTINCT
        select distinct mbr_code from report_transaksi_2018_03
        UNION DISTINCT
        select distinct mbr_code from report_transaksi_2018_04
        UNION DISTINCT
        select distinct mbr_code from report_transaksi_2018_05
        UNION DISTINCT
        select distinct mbr_code from report_transaksi_2018_06
        UNION DISTINCT
        select distinct mbr_code from report_transaksi_2018_07
        UNION DISTINCT
        select distinct mbr_code from report_transaksi_2018_08
        UNION DISTINCT
        select distinct mbr_code from report_transaksi_2018_09
        UNION DISTINCT
        select distinct mbr_code from report_transaksi_2018_10
        UNION DISTINCT
        select distinct mbr_code from report_transaksi_2018_11
        UNION DISTINCT
        select distinct mbr_code from report_transaksi_2018_12
        ');
        dd($mbr_code);

        for($i = 1; $i < 13; $i++){

            if(strlen($i) == 1){
                $i = '0' . $i;
            }

            $data = DB::table('deposit_' . $tahun . '_' . '01')
                ->select('deposit_bank', DB::raw('sum(deposit_amount)'))
                ->whereRaw("deposit_status = 'Active' AND deposit_code ilike 'DEP%'")
                ->groupBy('deposit_bank')
                ->get();
            dd($data);
            $carbon = Carbon::now();
            $carbon->year($tahun)->month($bulan);
            $nama_bulan = strtolower($carbon->format('F'));
        }

    }
}