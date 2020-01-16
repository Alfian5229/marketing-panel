<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class DataTransaksiProductController extends Controller
{
    function index($bulan, $vendor){
        ini_set('memory_limit', '1G');
        if(strlen($bulan) == 1){
            $bulan = '0' . $bulan;
        }

        $data = DB::connection('pgsql')
            ->select("SELECT product_kode, COUNT(product_kode) total_terjual FROM report_transaksi_2019_" . $bulan . "
                    WHERE supliyer_id = '". $vendor ."' AND transaksi_status = 'Active'
                    GROUP BY product_kode
                    ORDER BY total_terjual DESC;
            ");

        return view('data_product_vendor', compact('data', 'bulan', 'vendor'));
    }

    function vendor($bulan){
        ini_set('memory_limit', '1G');
        if(strlen($bulan) == 1){
            $bulan = '0' . $bulan;
        }

        $data = DB::connection('pgsql')
            ->select("SELECT supliyer_id, COUNT(product_kode) total_product_terjual FROM report_transaksi_2019_" . $bulan . "
                    WHERE transaksi_status = 'Active'
                    GROUP BY supliyer_id
                    ORDER BY total_product_terjual DESC;
            ");

        return view('data_vendor', compact('data', 'bulan'));
    }

    function product($bulan){
        ini_set('memory_limit', '1G');
        if(strlen($bulan) == 1){
            $bulan = '0' . $bulan;
        }

        $data = DB::connection('pgsql')
            ->select("SELECT * FROM data_product_terlaris_2019_" . $bulan . "");

        return view('data_product', compact('data', 'bulan'));
    }
}
