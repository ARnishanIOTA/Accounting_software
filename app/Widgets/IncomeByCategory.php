<?php

namespace App\Widgets;

use App\Abstracts\Widget;
use App\Models\Setting\Category;

class IncomeByCategory extends Widget
{
    public $IncomeAllData = array();
    public $default_name = 'widgets.income_by_category';

    public $default_settings = [
        'width' => 'col-md-6',
    ];

    public function show()
    {

        Category::with('income_transactions')->income()->each(function ($category) {
            $amount = 0;
            $temp = array();

            $this->applyFilters($category->income_transactions())->each(function ($transaction) use (&$amount) {
                $amount += $transaction->getAmountConvertedToDefault();
            });

            $this->addMoneyToDonut($category->color, $amount, $category->name);
            $temp['Ammount'] = $amount;
            $temp['CategoryName'] = $category->name;
            array_push($this->IncomeAllData, $temp );
        });

        $chart = $this->getDonutChart(trans_choice('general.incomes', 1), 0, 160, 6);
        $income = 'income';
        /**
         * Custom code for Any Chart Data
         **/
        $title = trans_choice('general.incomes', 1);
        $value = '';
        foreach ($this->IncomeAllData as $key => $data){
            $value = $value . " [ '".$data['CategoryName']."' , ".$data['Ammount']." ], ";
        }
        /**
         * End Custom code for Any Chart Data
         **/

        return $this->view('widgets.donut_chart', [
            'chart' => $chart,
            'idName' => $income,
            'Data' => $value,
            'title' => $title,
        ]);
    }
}
