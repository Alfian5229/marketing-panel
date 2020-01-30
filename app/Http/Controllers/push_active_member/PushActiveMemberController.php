<?php

namespace App\Http\Controllers\push_active_member;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class PushActiveMemberController extends Controller
{
    public function perhitungan($tahun){
        set_time_limit(500);
        $data = DB::table('super_active_member_' . $tahun)
            ->orderBy('mbr_code')
            // ->offset(40000)
            // ->limit(60000)
            ->get();

        for($i = 1; $i < 13; $i++){
            if($tahun == 2018){
                if($i >= 3){
                    
                    foreach ($data as $key) {
                        $carbon = Carbon::now();
                        $carbon->year($tahun)->month($i-2);
                        $nama_bulan = strtolower($carbon->format('F'));
                        $data_bulan_1 = $key->$nama_bulan;

                        $carbon = Carbon::now();
                        $carbon->year($tahun)->month($i-1);
                        $nama_bulan = strtolower($carbon->format('F'));
                        $data_bulan_2 = $key->$nama_bulan;

                        $carbon = Carbon::now();
                        $carbon->year($tahun)->month($i);
                        $nama_bulan = strtolower($carbon->format('F'));

                        if($data_bulan_1 != 0 AND $data_bulan_2 == 0){
                            DB::table('push_active_member_' . $tahun)
                            ->where('mbr_code', $key->mbr_code)
                            ->update([
                                $nama_bulan => 1,
                            ]);
                        }
                    }

                }
            }
            if($tahun == 2019){
                if($i == 1){
                    foreach ($data as $key) {
                        $tahun_1 = 2018;
                        $nama_bulan = 'november';
                        $data_bulan = DB::table('push_active_member_' . $tahun_1)->where('mbr_code', '=', $key->mbr_code)->first();
                        if($data_bulan == null){
                            $data_bulan_1 = 0;
                        } else{
                            $data_bulan_1 = $data_bulan->$nama_bulan;
                        }

                        $nama_bulan = 'december';
                        if($data_bulan == null){
                            $data_bulan_2 = 0;
                        } else{
                            $data_bulan_2 = $data_bulan->$nama_bulan;
                        }

                        $carbon = Carbon::now();
                        $carbon->year($tahun)->month($i);
                        $nama_bulan = strtolower($carbon->format('F'));

                        if($data_bulan_1 != 0 AND $data_bulan_2 == 0){
                            DB::table('push_active_member_' . $tahun)
                            ->where('mbr_code', $key->mbr_code)
                            ->update([
                                $nama_bulan => 1,
                            ]);
                        }
                    }
                }
                else if($i == 2){
                    foreach ($data as $key) {
                        $tahun_1 = 2018;
                        $nama_bulan = 'december';
                        $data_bulan_1 = DB::table('push_active_member_' . $tahun_1)->where('mbr_code', '=', $key->mbr_code)->first();
                        if($data_bulan_1 == null){
                            $data_bulan_1 = 0;
                        } else{
                            $data_bulan_1 = $data_bulan_1->$nama_bulan;
                        }

                        $nama_bulan = 'january';
                        $data_bulan_2 = $key->$nama_bulan;

                        $carbon = Carbon::now();
                        $carbon->year($tahun)->month($i);
                        $nama_bulan = strtolower($carbon->format('F'));

                        if($data_bulan_1 != 0 AND $data_bulan_2 == 0){
                            DB::table('push_active_member_' . $tahun)
                            ->where('mbr_code', $key->mbr_code)
                            ->update([
                                $nama_bulan => 1,
                            ]);
                        }
                    }
                }
                else{
                    foreach ($data as $key) {
                        $carbon = Carbon::now();
                        $carbon->year($tahun)->month($i-2);
                        $nama_bulan = strtolower($carbon->format('F'));
                        $data_bulan_1 = $key->$nama_bulan;

                        $carbon = Carbon::now();
                        $carbon->year($tahun)->month($i-1);
                        $nama_bulan = strtolower($carbon->format('F'));
                        $data_bulan_2 = $key->$nama_bulan;

                        $carbon = Carbon::now();
                        $carbon->year($tahun)->month($i);
                        $nama_bulan = strtolower($carbon->format('F'));

                        if($data_bulan_1 != 0 AND $data_bulan_2 == 0){
                            DB::table('push_active_member_' . $tahun)
                            ->where('mbr_code', $key->mbr_code)
                            ->update([
                                $nama_bulan => 1,
                            ]);
                        }
                    }
                }
            }
        }
    }
}