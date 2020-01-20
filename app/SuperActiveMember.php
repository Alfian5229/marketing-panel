<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperActiveMember extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'super_active_member_2019';
    public $timestamps = false;
}
