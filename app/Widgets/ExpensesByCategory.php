<?php

namespace App\Widgets;

use App\Abstracts\Widget;
use App\Models\Setting\Category;

class ExpensesByCategory extends Widget
{
    public $ExpenseAllData = array();
    public $default_name = 'widgets.expenses_by_category';

    public $default_settings = [
        'width' => 'col-md-6',
    ];

    public function show()
    {
        Category::with('expense_transactions')->expense()->each(function ($category) {
            $amount = 0;
            $temp = array();

            $this->applyFilters($category->expense_transactions())->each(function ($transaction) use (&$amount) {
                $amount += $transaction->getAmountConvertedToDefault();
            });

            $this->addMoneyToDonut($category->color, $amount, $category->name);
            $temp['Ammount'] = $amount;
            $temp['CategoryName'] = $category->name;
            array_push($this->ExpenseAllData, $temp );
        });

        $chart = $this->getDonutChart(trans_choice('general.expenses', 2), 0, 160, 6);
        $expense = 'expense';
        /**
         * Custom code for Any Chart Data
         **/
        $title = trans_choice('general.expenses', 2);
        $value = '';
        foreach ($this->ExpenseAllData as $key => $data){
            $value = $value . " [ '".$data['CategoryName']."' , ".$data['Ammount']." ], ";
        }
        /**
         * End Custom code for Any Chart Data
         **/
        return $this->view('widgets.donut_chart', [
            'chart' => $chart,
            'idName' => $expense,
            'Data' => $value,
            'title' => $title,
        ]);
    }
}
