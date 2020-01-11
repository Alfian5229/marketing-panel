<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportDailyTrxModel extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'dm_report_daily_active_transaction';
    public $timestamps = false;
}
