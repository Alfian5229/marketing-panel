<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DataTransaksiProductController extends Controller
{
    function index($bulan, $vendor, $status){
        ini_set('memory_limit', '1G');
        if(strlen($bulan) == 1){
            $bulan = '0' . $bulan;
        }

        $data = DB::connection('pgsql')
            ->select("SELECT A.product_kode, COUNT(A.product_kode) total_terjual, transaksi_status, product.product_name FROM report_transaksi_2019_" . $bulan . " AS A
                    JOIN product ON product.product_kode = A.product_kode
                    WHERE supliyer_id = '". $vendor ."' AND transaksi_status = '" . $status . "'
                    GROUP BY A.product_kode, transaksi_status, product.product_name
                    ORDER BY total_terjual DESC;
            ");
        return view('data_product_vendor', compact('data', 'bulan', 'vendor'));
    }

    function vendor($bulan){
        ini_set('memory_limit', '1G');
        if(strlen($bulan) == 1){
            $bulan = '0' . $bulan;
        }

        // $data = DB::connection('pgsql')
        //     ->select("SELECT supliyer_id, COUNT(product_kode) total_product_terjual FROM report_transaksi_2019_" . $bulan . "
        //             WHERE transaksi_status = 'Active'
        //             GROUP BY supliyer_id
        //             ORDER BY total_product_terjual DESC;
        //     ");

        $data = DB::connection('pgsql')
            ->select("SELECT * FROM data_product_vendor_2019_" . $bulan . " AS A JOIN supliyer ON supliyer.supliyer_id = A.supliyer_id;
            ");
        
        return view('data_vendor', compact('data', 'bulan'));
    }

    function product($bulan, $tahun){
        ini_set('memory_limit', '1G');
        // Menentukan jumlah hari dalam 1 bulan
        $carbon = Carbon::now();
        $carbon->year($tahun)->month($bulan);
        // dd($carbon->daysInMonth);

        if(strlen($bulan) == 1){
            $bulan = '0' . $bulan;
        }

        $max_tanggal = $carbon->daysInMonth;

        $data = DB::connection('pgsql')
            ->select("SELECT * FROM data_product_terlaris_" . $tahun . "_" . $bulan . 
            " AS bulan JOIN product ON product.product_kode = bulan.product_kode
            ORDER BY bulan.product_kode");
        return view('data_product', compact('data', 'bulan', 'max_tanggal'));
    }
}
