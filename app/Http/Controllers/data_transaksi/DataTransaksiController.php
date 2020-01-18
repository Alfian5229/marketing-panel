<?php

namespace App\Http\Controllers\data_transaksi;

use Illuminate\Http\Request;
use App\ReportTrxCountSumModel;
use DB;
use DataTables;
use Carbon\Carbon;

class DataTransaksiController extends Controller
{
    public function index($bulan){
        $carbon = Carbon::now();
        $carbon->year(2019)->month($bulan);
        $max_tanggal = $carbon->daysInMonth;
        return view('data_trx', compact('bulan', 'max_tanggal'));
    }

    public function json(Request $request, $bulan){
        $carbon = Carbon::now();
        $carbon->year(2019)->month($bulan);
        $max_tanggal = $carbon->daysInMonth;

        // print_r($request->all());
        // Columns
        $columns = array(
            0 => 'mbr_code'
        );
        // Total Data
        $totaldata = ReportTrxCountSumModel::count();
        // Limit
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))){
            $posts = ReportTrxCountSumModel::offset($start)
                        ->limit($limit)
                        ->orderBy($order)
                        ->get();
            $totalFiltered = $totaldata;
        } else {
            $search = $request->input('search.value');
            $posts = ReportTrxCountSumModel::where('mbr_code','like', "%{$search}%")
                        ->orWhere('full_name','like',"%{$search}%")
                        ->orWhere('phone','like',"%{$search}%");
            for($i = 1; $i < $max_tanggal+1; $i++){
                $posts = $posts->orWhere('sum_' . $i,'like',"%{$search}%");
                $posts = $posts->orWhere('count_' . $i,'like',"%{$search}%");
            }
            $posts = $posts->offset($start)
                        ->limit($limit)
                        ->orderBy($order)
                        ->get();
            $totalFiltered = ReportTrxCountSumModel::where('mbr_code','like', "%{$search}%")
                        ->orWhere('full_name','like',"%{$search}%")
                        ->orWhere('phone','like',"%{$search}%");
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

