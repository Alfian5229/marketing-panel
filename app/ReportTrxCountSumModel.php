<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportTrxCountSumModel extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'report_trx_count_sum_2019_01';
    public $timestamps = false;
}
