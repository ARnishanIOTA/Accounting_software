<?php


namespace App\KoolReports;
require_once dirname(__FILE__)."/../../vendor/koolreport/autoload.php";

class MyReport extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;
    // By adding above statement, you have claim the friendship between two frameworks
    // As a result, this report will be able to accessed all databases of Laravel
    // There are no need to define the settings() function anymore
    // while you can do so if you have other datasources rather than those
    // defined in Laravel.


    function setup()
    {
        // Let say, you have "sale_database" is defined in Laravel's database settings.
        // Now you can use that database without any futher setitngs.
        $this->src("Akaunting")
            ->query("
                    SELECT 
                    SUM(iqj_transactions.amount), iqj_contacts.name
                    FROM iqj_transactions
                    INNER JOIN iqj_contacts ON iqj_transactions.contact_id=iqj_contacts.id
                    WHERE iqj_transactions.type = 'income'
                    GROUP BY iqj_contacts.name
                    
                    ")
            ->pipe(new Limit(array(10)))
            ->pipe($this->dataStore('sales_by_customer'));
    }

}