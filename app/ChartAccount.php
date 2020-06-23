<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChartAccount extends Model
{
    protected $table = 'chart_of_accounts';
    protected $primaryKey = 'account_id';
}
