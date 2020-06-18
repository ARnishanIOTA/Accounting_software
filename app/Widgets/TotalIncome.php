<?php

namespace App\Widgets;

use App\Abstracts\Widget;
use App\Models\Banking\Transaction;
use App\Models\Sale\Invoice;
use Illuminate\Support\Carbon;
use DB;

class TotalIncome extends Widget
{
    public $default_name = 'widgets.total_income';

    public $views = [
        'header' => 'partials.widgets.stats_header',
    ];

    public function show()
    {

        $current = $open = $overdue = 0;

        $this->applyFilters(Transaction::income()->isNotTransfer())->each(function ($transaction) use (&$current) {
        $current += $transaction->getAmountConvertedToDefault();
        });

        $this->applyFilters(Invoice::accrued()->notPaid(), ['date_field' => 'created_at'])->each(function ($invoice) use (&$open, &$overdue) {
            list($open_tmp, $overdue_tmp) = $this->calculateDocumentTotals($invoice);

            $open += $open_tmp;
            $overdue += $overdue_tmp;
        });

        $grand = $current + $open + $overdue;

        $progress = 100;

        if (!empty($open) && !empty($overdue)) {
            $progress = (int) ($open * 100) / ($open + $overdue);
        }

        $totals = [
            'grand'         => money($grand, setting('default.currency'), true),
            'open'          => money($open, setting('default.currency'), true),
            'overdue'       => money($overdue, setting('default.currency'), true),
            'progress'      => $progress,
        ];
        /**
         *  Trending Ratio Calculation
         */
        $trending = '';
        $ratio = 0 ;

        $lastMonthFromDate = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $lastMonthTillDate = Carbon::now()->subMonth()->endOfMonth()->toDateString();
        $revenueLastMonth = Transaction::income()->isNotTransfer()->monthly($lastMonthFromDate,$lastMonthTillDate)->sum('amount');
        $revenueThisMonth = Transaction::income()->isNotTransfer()->whereMonth('created_at', Carbon::now()->month)->sum('amount');
        if($revenueThisMonth >= $revenueLastMonth){
            $trending = 'trending_up';
            $dif =  $revenueThisMonth - $revenueLastMonth;
            $ratio = ($dif/$grand) * 100;
            $ratio = number_format((float)$ratio, 2, '.', '');
        }else{
            $trending = 'trending_down';
            $dif =  $revenueLastMonth - $revenueThisMonth;
            $ratio = ($dif/$grand) * 100;
            $ratio = number_format((float)$ratio, 2, '.', '');

        }
        /**
         * End Trending Ratio Calculation
         */

        return $this->view('widgets.total_income', [
            'totals' => $totals,
            'trending' => $trending,
            'ratio' => $ratio,

        ]);
    }
}
