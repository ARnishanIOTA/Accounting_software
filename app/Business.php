<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'business';
    protected $primaryKey = 'business_id';


    public function chartAccount() {
        return $this->belongsToMany('App\ChartAccount','business_account', 'business_id', 'account_id');
    }
}
