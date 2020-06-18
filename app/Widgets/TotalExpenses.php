<?php

namespace App\Widgets;

use App\Abstracts\Widget;
use App\Models\Banking\Transaction;
use App\Models\Purchase\Bill;
use Illuminate\Support\Carbon;

class TotalExpenses extends Widget
{
    public $default_name = 'widgets.total_expenses';

    public $views = [
        'header' => 'partials.widgets.stats_header',
    ];

    public function show()
    {
        $current = $open = $overdue = 0;

        $this->applyFilters(Transaction::expense()->isNotTransfer())->each(function ($transaction) use (&$current) {
            $current += $transaction->getAmountConvertedToDefault();
        });

        $this->applyFilters(Bill::accrued()->notPaid(), ['date_field' => 'created_at'])->each(function ($bill) use (&$open, &$overdue) {
            list($open_tmp, $overdue_tmp) = $this->calculateDocumentTotals($bill);

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
        $expenseLastMonth = Transaction::expense()->isNotTransfer()->monthly($lastMonthFromDate,$lastMonthTillDate)->sum('amount');
        $expenseThisMonth = Transaction::expense()->isNotTransfer()->whereMonth('created_at', Carbon::now()->month)->sum('amount');
        if($expenseThisMonth >= $expenseLastMonth)
        {
            $trending = 'trending_up';
            $dif =  $expenseThisMonth - $expenseLastMonth;
            if($grand > 0) {
                $ratio = ($dif / $grand) * 100;
                $ratio = number_format((float)$ratio, 2, '.', '');
            }
        }else{
            $trending = 'trending_down';
            $dif =  $expenseLastMonth - $expenseThisMonth;
            if($grand > 0) {
                $ratio = ($dif / $grand) * 100;
                $ratio = number_format((float)$ratio, 2, '.', '');
            }
        }
        /**
         * End Trending Ratio Calculation
         */

        return $this->view('widgets.total_expenses', [
            'totals' => $totals,
            'trending' => $trending,
            'ratio' => $ratio,
        ]);
    }
}
