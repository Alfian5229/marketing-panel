<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportMonthlyTrxModel extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'dm_report_monthly_active_transaction';
    public $timestamps = false;
}
