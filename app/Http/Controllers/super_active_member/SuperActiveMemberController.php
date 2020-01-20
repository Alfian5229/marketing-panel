<?php

namespace App\Http\Controllers\super_active_member;

use App\Rekapitulasi;
use App\SuperActiveMember;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class SuperActiveMemberController extends Controller
{
    public function tampilData(){
        $data = SuperActiveMember::
            where('january', '>=', 15)
            ->orWhere('february', '>=', 15)
            ->orWhere('march', '>=', 15)
            ->orWhere('april', '>=', 15)
            ->orWhere('may', '>=', 15)
            ->orWhere('june', '>=', 15)
            ->orWhere('july', '>=', 15)
            ->orWhere('august', '>=', 15)
            ->orWhere('september', '>=', 15)
            ->orWhere('october', '>=', 15)
            ->orWhere('november', '>=', 15)
            ->orWhere('december', '>=', 15)
            ->orderBy('mbr_code')->get();

        return view('super_active_member', compact('data'));
    }
}