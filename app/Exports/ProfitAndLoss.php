<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProfitAndLoss implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $result;

    function __construct($result) {
        $this->result = $result;
    }
    public function view(): View
    {
        return view('excel.profitAndLoss', [
            'result' =>  $this->result
        ]);
    }
}
