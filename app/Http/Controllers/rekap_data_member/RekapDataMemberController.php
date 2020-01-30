<?php

namespace App\Http\Controllers\rekap_data_member;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class RekapDataMemberController extends Controller
{
    public function totalMbrSponsor($tahun){
        $data = DB::table('data_register_total_month_by_public_' . $tahun . ' AS A')
        ->select('A.bulan', 'A.total_member AS total_public', 'B.total_member AS total_sponsor')
        ->join('data_register_total_month_by_sponsor_' . $tahun . ' AS B', 'A.bulan', '=', 'B.bulan')
        ->get();
        
        return view('rekap_reg_member.mbr_sponsor',  compact('tahun', 'data'));
    }
}