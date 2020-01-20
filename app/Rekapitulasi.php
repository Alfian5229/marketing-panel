<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekapitulasi extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'rekapitulasi_2019';
    public $timestamps = false;
}
