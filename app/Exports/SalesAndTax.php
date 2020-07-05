<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesAndTax implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $result;
    protected $startDate;
    protected $endDate;

    function __construct($result,$startDate,$endDate) {
        $this->result = $result;
         $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function view(): View
    {
        return view('excel.salesTax', [
            'result' =>  $this->result,
            'startDate' =>  $this->startDate,
            'endDate' =>  $this->endDate,
        ]);
    }

}

