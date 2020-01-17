<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DataUserTypeController extends Controller
{
    //
    public function index($type)
    {
        $data = "";
        // dd($type);
        if ($type === 'active') {
            $data = DB::connection('pgsql')
                ->select("SELECT * FROM data_user_type_" . $type . ";
            ");
        }elseif($type === 'block'){
            $data = DB::connection('pgsql')
                ->select("SELECT * FROM data_user_type_" . $type . ";
            ");
        }elseif($type === 'inactive'){
            $data = DB::connection('pgsql')
                ->select("SELECT * FROM data_user_type_" . $type . ";
            ");
        }else{
            dd("Error");
        }

        return view('data_user_type', compact('data', 'type'));
    }
}
