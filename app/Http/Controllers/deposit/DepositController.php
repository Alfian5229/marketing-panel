<?php

namespace App\Http\Controllers\deposit;

use App\Rekapitulasi;
use App\SuperActiveMember;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class DepositController extends Controller
{
    public function perhitungan($tahun){

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