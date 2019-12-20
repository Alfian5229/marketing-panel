<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MbrList;

class HomeController extends Controller
{
    public function index(){
        $member = MbrList::where('mbr_code', 'EKL0098653')->get();
        dd($member);
    }
}
