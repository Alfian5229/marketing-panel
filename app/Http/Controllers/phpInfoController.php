<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class phpInfoController extends Controller
{
    public function index(){
        phpinfo();
    }
}
