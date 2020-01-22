<?php

namespace App\Http\Controllers\data_transaksi;

use Illuminate\Http\Request;
use App\ReportTrxCountSumModel;
use DB;
use DataTables;
use Carbon\Carbon;

class DataTransaksiController extends Controller
{
    public function index($bulan, $tahun){
        $carbon = Carbon::now();
        $carbon->year($tahun)->month($bulan);
        $max_tanggal = $carbon->daysInMonth;

        $nama_bulan = strtolower($carbon->format('F'));

        $bulan_hitung = $bulan;
        if(strlen($bulan_hitung) == 1){
            $bulan_hitung = '0' . $bulan_hitung;
        }

        $select = '';
        for($i = 1; $i < 1+$max_tanggal; $i++){
            if($i == $max_tanggal){
                $select = $select . 'SUM(sum_' . $i . ') AS sum_' . $i . ', SUM(count_' . $i . ') AS count_' . $i;
            }else{
                $select = $select . 'SUM(sum_' . $i . ') AS sum_' . $i . ', SUM(count_' . $i . ') AS count_' . $i . ', ';
            }
        }
        $total = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan_hitung)->selectRaw($select)->first();

        $select_bulan = '(
            SELECT count(' . $nama_bulan . ') from super_active_member_' . $tahun . ' where ' . $nama_bulan . ' >= 15
        ) AS active_user,
        (
            SELECT count(' . $nama_bulan . ') from super_active_member_' . $tahun . ' where ' . $nama_bulan . ' < 15
        ) AS inactive_user';
        $total_super_active = DB::table('super_active_member_' . $tahun)->selectRaw($select_bulan)->first();
        
        return view('data_trx', compact('bulan', 'tahun', 'max_tanggal', 'total', 'total_super_active'));
    }

    public function json(Request $request, $bulan, $tahun){
        $carbon = Carbon::now();
        $carbon->year($tahun)->month($bulan);
        $max_tanggal = $carbon->daysInMonth;

        $nama_bulan = strtolower($carbon->format('F'));

        if(strlen($bulan) == 1){
            $bulan = '0' . $bulan;
        }

        // print_r($request->all());
        // Columns
        $columns = array(
            0 => 'mbr_code',
            1 => 'full_name',
            2 => 'phone',
            3 => 'super_active',
        );
        $index = 3;
        for($i = 1; $i < $max_tanggal+1; $i++){
            $columns = array_merge($columns, array(++$index => 'sum_' . $i, ++$index => 'count_' . $i));
        }

        // Total Data
        $totaldata = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan)->count();
        // Limit
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))){
            $posts = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan . ' AS A')
                        ->select('A.*', $nama_bulan . ' AS super_active')
                        ->join('super_active_member_' . $tahun . ' AS B', 'A.mbr_code', '=', 'B.mbr_code')
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy('A.' . $order, $dir)
                        ->get();
            $totalFiltered = $totaldata;
        } else {
            $search = $request->input('search.value');
            $posts = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan . ' AS A')
                        ->select('A.*', $nama_bulan . ' AS super_active')
                        ->join('super_active_member_' . $tahun . ' AS B', 'A.mbr_code', '=', 'B.mbr_code')
                        ->where('A.mbr_code','like', "%{$search}%")
                        ->orWhere('full_name','like',"%{$search}%")
                        ->orWhere('phone','like',"%{$search}%")
                        ->orWhere($nama_bulan,'like',"%{$search}%");
            for($i = 1; $i < $max_tanggal+1; $i++){
                $posts = $posts->orWhere('sum_' . $i,'like',"%{$search}%");
                $posts = $posts->orWhere('count_' . $i,'like',"%{$search}%");
            }
            $posts = $posts->offset($start)
                        ->limit($limit)
                        ->orderBy('A.' . $order, $dir)
                        ->get();
            $totalFiltered = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan . ' AS A')
                        ->select('A.*', $nama_bulan . ' AS super_active')
                        ->join('super_active_member_' . $tahun . ' AS B', 'A.mbr_code', '=', 'B.mbr_code')
                        ->where('A.mbr_code','like', "%{$search}%")
                        ->orWhere('full_name','like',"%{$search}%")
                        ->orWhere('phone','like',"%{$search}%")
                        ->orWhere($nama_bulan,'like',"%{$search}%");
            for($i = 1; $i < $max_tanggal+1; $i++){
                $totalFiltered = $totalFiltered->orWhere('sum_' . $i,'like',"%{$search}%");
                $totalFiltered = $totalFiltered->orWhere('count_' . $i,'like',"%{$search}%");
            }
            $totalFiltered = $totalFiltered->count();
        }

        $data = array();
        if($posts){
            foreach($posts as $r){
                $nestedData['mbr_code'] = $r->mbr_code;
                $nestedData['full_name'] = $r->full_name;
                $nestedData['phone'] = $r->phone;
                $nestedData['super_active'] = $r->super_active;
                for($i = 1; $i < $max_tanggal+1; $i++){
                    $sum = 'sum_' . $i;
                    $nestedData['sum_' . $i] = $r->$sum;
                    $count = 'count_' . $i;
                    $nestedData['count_' . $i] = $r->$count;
                }
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"          => intval($request->input('draw')),
            "recordsTotal"  => intval($totaldata),
            "recordsFiltered" => intval($totalFiltered),
            "data"          => $data
        );

        echo json_encode($json_data);
    }
}




// public function json(Request $request, $bulan, $tahun){
//     $carbon = Carbon::now();
//     $carbon->year($tahun)->month($bulan);
//     $max_tanggal = $carbon->daysInMonth;

//     if(strlen($bulan) == 1){
//         $bulan = '0' . $bulan;
//     }

//     // print_r($request->all());
//     // Columns
//     $columns = array(
//         0 => 'mbr_code',
//         1 => 'full_name',
//         2 => 'phone',
//     );
//     $index = 2;
//     for($i = 1; $i < $max_tanggal+1; $i++){
//         $columns = array_merge($columns, array(++$index => 'sum_' . $i, ++$index => 'count_' . $i));
//     }

//     // Total Data
//     $totaldata = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan)->count();
//     // Limit
//     $limit = $request->input('length');
//     $start = $request->input('start');
//     $order = $columns[$request->input('order.0.column')];
//     $dir   = $request->input('order.0.dir');

//     if (empty($request->input('search.value'))){
//         $posts = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan)->offset($start)
//                     ->limit($limit)
//                     ->orderBy($order, $dir)
//                     ->get();
//         $totalFiltered = $totaldata;
//     } else {
//         $search = $request->input('search.value');
//         $posts = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan)->where('mbr_code','like', "%{$search}%")
//                     ->orWhere('full_name','like',"%{$search}%")
//                     ->orWhere('phone','like',"%{$search}%");
//         for($i = 1; $i < $max_tanggal+1; $i++){
//             $posts = $posts->orWhere('sum_' . $i,'like',"%{$search}%");
//             $posts = $posts->orWhere('count_' . $i,'like',"%{$search}%");
//         }
//         $posts = $posts->offset($start)
//                     ->limit($limit)
//                     ->orderBy($order, $dir)
//                     ->get();
//         $totalFiltered = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan)->where('mbr_code','like', "%{$search}%")
//                     ->orWhere('full_name','like',"%{$search}%")
//                     ->orWhere('phone','like',"%{$search}%");
//         for($i = 1; $i < $max_tanggal+1; $i++){
//             $totalFiltered = $totalFiltered->orWhere('sum_' . $i,'like',"%{$search}%");
//             $totalFiltered = $totalFiltered->orWhere('count_' . $i,'like',"%{$search}%");
//         }
//         $totalFiltered = $totalFiltered->count();
//     }

//     $data = array();
//     if($posts){
//         foreach($posts as $r){
//             $nestedData['mbr_code'] = $r->mbr_code;
//             $nestedData['full_name'] = $r->full_name;
//             $nestedData['phone'] = $r->phone;
//             for($i = 1; $i < $max_tanggal+1; $i++){
//                 $sum = 'sum_' . $i;
//                 $nestedData['sum_' . $i] = $r->$sum;
//                 $count = 'count_' . $i;
//                 $nestedData['count_' . $i] = $r->$count;
//             }
//             $data[] = $nestedData;
//         }
//     }

//     $json_data = array(
//         "draw"          => intval($request->input('draw')),
//         "recordsTotal"  => intval($totaldata),
//         "recordsFiltered" => intval($totalFiltered),
//         "data"          => $data
//     );

//     echo json_encode($json_data);
// }




// public function json(Request $request, $bulan, $tahun){
//     $carbon = Carbon::now();
//     $carbon->year($tahun)->month($bulan);
//     $max_tanggal = $carbon->daysInMonth;

//     $nama_bulan = strtolower($carbon->format('F'));

//     if(strlen($bulan) == 1){
//         $bulan = '0' . $bulan;
//     }

//     // print_r($request->all());
//     // Columns
//     $columns = array(
//         0 => 'mbr_code',
//         1 => 'full_name',
//         2 => 'phone',
//         3 => 'active_user',
//     );
//     $index = 3;
//     for($i = 1; $i < $max_tanggal+1; $i++){
//         $columns = array_merge($columns, array(++$index => 'sum_' . $i, ++$index => 'count_' . $i));
//     }

//     // Total Data
//     $totaldata = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan)->count();
//     // Limit
//     $limit = $request->input('length');
//     $start = $request->input('start');
//     $order = $columns[$request->input('order.0.column')];
//     $dir   = $request->input('order.0.dir');

//     if (empty($request->input('search.value'))){
//         $posts = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan . ' AS A')->offset($start)
//                     ->join('super_active_member_' . $tahun . ' AS B', 'A.mbr_code', '=', 'B.mbr_code')
//                     ->limit($limit)
//                     ->orderBy('A.' . $order, $dir)
//                     ->get();
//                     dd($posts);
//         $totalFiltered = $totaldata;
//     } else {
//         $search = $request->input('search.value');
//         $posts = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan)->where('mbr_code','like', "%{$search}%")
//                     ->orWhere('full_name','like',"%{$search}%")
//                     ->orWhere('phone','like',"%{$search}%");
//         for($i = 1; $i < $max_tanggal+1; $i++){
//             $posts = $posts->orWhere('sum_' . $i,'like',"%{$search}%");
//             $posts = $posts->orWhere('count_' . $i,'like',"%{$search}%");
//         }
//         $posts = $posts->offset($start)
//                     ->limit($limit)
//                     ->orderBy($order, $dir)
//                     ->get();
//         $totalFiltered = DB::table('report_trx_count_sum_' . $tahun . '_' . $bulan)->where('mbr_code','like', "%{$search}%")
//                     ->orWhere('full_name','like',"%{$search}%")
//                     ->orWhere('phone','like',"%{$search}%");
//         for($i = 1; $i < $max_tanggal+1; $i++){
//             $totalFiltered = $totalFiltered->orWhere('sum_' . $i,'like',"%{$search}%");
//             $totalFiltered = $totalFiltered->orWhere('count_' . $i,'like',"%{$search}%");
//         }
//         $totalFiltered = $totalFiltered->count();
//     }

//     $data = array();
//     if($posts){
//         foreach($posts as $r){
//             $nestedData['mbr_code'] = $r->mbr_code;
//             $nestedData['full_name'] = $r->full_name;
//             $nestedData['phone'] = $r->phone;
//             for($i = 1; $i < $max_tanggal+1; $i++){
//                 $sum = 'sum_' . $i;
//                 $nestedData['sum_' . $i] = $r->$sum;
//                 $count = 'count_' . $i;
//                 $nestedData['count_' . $i] = $r->$count;
//             }
//             $data[] = $nestedData;
//         }
//     }

//     $json_data = array(
//         "draw"          => intval($request->input('draw')),
//         "recordsTotal"  => intval($totaldata),
//         "recordsFiltered" => intval($totalFiltered),
//         "data"          => $data
//     );

//     echo json_encode($json_data);
// }