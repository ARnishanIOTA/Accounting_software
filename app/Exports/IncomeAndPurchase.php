<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class IncomeAndPurchase implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $result;
    protected $startDate;
    protected $endDate;
    protected $type;

    function __construct($result,$startDate,$endDate,$type) {
        $this->result = $result;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->type = $type;
    }
    public function view(): View
    {
        return view('excel.incomeAndPurchase', [
            'result' =>  $this->result,
            'startDate' =>  $this->startDate,
            'endDate' =>  $this->endDate,
            'type' => $this->type
        ]);
    }
}
