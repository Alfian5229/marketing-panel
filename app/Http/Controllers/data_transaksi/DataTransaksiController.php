<?php

namespace App\Http\Controllers\data_transaksi;

use Illuminate\Http\Request;
use App\ReportTrxCountSumModel;
use DB;

class DataTransaksiController extends Controller
{
    public function index(){
        ini_set('memory_limit', '1G');

        $data = ReportTrxCountSumModel::select('full_name')
            ->orderBy('mbr_code')
            ->get()->toJson(JSON_PRETTY_PRINT);
        return $data;
        return view('data_trx', compact('data'));
    }
}

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "3_sum" TO sum_3;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_3 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "3_count" TO count_3;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "4_sum" TO sum_4;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_4 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "4_count" TO count_4;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "5_sum" TO sum_5;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_5 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "5_count" TO count_5;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "6_sum" TO sum_6;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_6 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "6_count" TO count_6;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "7_sum" TO sum_7;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_7 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "7_count" TO count_7;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "8_sum" TO sum_8;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_8 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "8_count" TO count_8;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "9_sum" TO sum_9;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_9 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "9_count" TO count_9;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "10_sum" TO sum_10;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_10 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "10_count" TO count_10;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "11_sum" TO sum_11;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_11 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "11_count" TO count_11;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "12_sum" TO sum_12;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_12 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "12_count" TO count_12;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "13_sum" TO sum_13;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_13 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "13_count" TO count_13;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "14_count" TO count_14;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "15_count" TO count_15;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "16_count" TO count_16;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "17_count" TO count_17;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "18_count" TO count_18;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "19_count" TO count_19;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "20_count" TO count_20;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "21_count" TO count_21;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "22_count" TO count_22;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "23_count" TO count_23;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "24_count" TO count_24;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "25_count" TO count_25;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "26_count" TO count_26;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "27_count" TO count_27;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "28_count" TO count_28;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "29_count" TO count_29;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "30_count" TO count_30;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "31_count" TO count_31;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "14_sum" TO sum_14;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_14 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "15_sum" TO sum_15;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_15 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "16_sum" TO sum_16;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_16 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "17_sum" TO sum_17;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_17 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "18_sum" TO sum_18;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_18 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "19_sum" TO sum_19;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_19 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "20_sum" TO sum_20;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_20 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "21_sum" TO sum_21;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_21 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "22_sum" TO sum_22;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_22 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "23_sum" TO sum_23;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_23 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "24_sum" TO sum_24;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_24 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "25_sum" TO sum_25;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_25 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "26_sum" TO sum_26;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_26 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "27_sum" TO sum_27;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_27 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "28_sum" TO sum_28;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_28 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "29_sum" TO sum_29;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_29 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "30_sum" TO sum_30;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_30 TYPE numeric (20, 2);

// ALTER TABLE public.report_trx_count_sum_2019_01
//     RENAME "31_sum" TO sum_31;

// ALTER TABLE public.report_trx_count_sum_2019_01
//     ALTER COLUMN sum_31 TYPE numeric (20, 2);
