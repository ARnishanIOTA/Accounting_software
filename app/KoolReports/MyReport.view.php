<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\BarChart;
?>
<html>
<head>
    <title>My Report</title>
</head>
<body>
<h1>It works</h1>
<div class="text-center">
    <h1>Sales Report</h1>
    <h4>This report shows top 10 sales by customer</h4>
</div>
<hr/>

<?php
BarChart::create(array(
    "dataStore"=>$this->dataStore('sales_by_customer'),
    "width"=>"100%",
    "height"=>"500px",
    "columns"=>array(
        "customerName"=>array(
            "label"=>"name"
        ),
        "dollar_sales"=>array(
            "type"=>"number",
            "label"=>"amount",
            "prefix"=>"$",
        )
    ),
    "options"=>array(
        "title"=>"Sales By Customer"
    )
));
?>
<?php
Table::create(array(
    "dataStore"=>$this->dataStore('sales_by_customer'),
    "columns"=>array(
        "customerName"=>array(
            "label"=>"name"
        ),
        "dollar_sales"=>array(
            "type"=>"number",
            "label"=>"amount",
            "prefix"=>"$",
        )
    ),
    "cssClass"=>array(
        "table"=>"table table-hover table-bordered"
    )
));
?>
</body>
</html>
