<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportMonthlyTrxFullModel extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'dm_report_monthly_active_transaction_full';
    public $timestamps = false;
}
