<!DOCTYPE html>
<html>
<head>
    <title>Income By Customer</title>
    <style>
        .add-background{
            background-color: #f8f9f8;
            padding: 15px;
            border-radius: 5px;
        }

        .background{
            background-color: #f8f9f8;
        }

    </style>
</head>
<body>
<div class="row3">
      <h2> Profit & Loss</h2>
     
</div>
  <div class="row add-background">
    <div class="row">
        <div class="container" >
            <table>
                <tr>
                    <td><label>Date Range &nbsp</label></td>
                    <td>{{date("F jS, Y", strtotime($startDate))}}</td>
                    <td>to</td>
                    <td>{{date("F jS, Y", strtotime($endDate))}}</td>
                </tr>
            </table>


        </div>

    </div>
</div>

<div class="card" style="margin-top: 40px; text-align:center" >
    <table style="width: 80%">
        <thead style="padding: 10px">
        <tr height="50px" class="tr">
            <th width="100px"> Income </th>
            <th ></th>
            <th width="200px"> Cost of Goods Sold</th>
            <th >  </th>
            <th width="200px"> Operating Expenses</th>
            <th > </th>
            <th width="100px"> Net Profit</th>


    </tr>
        </thead>
        <tbody style="text-align: center">
        
        <tr height="50px" >
            <td >${{ $result['income'] }}</td>
            <td>-</td>
            <td>${{ $result['costOfGoodsSold'] }}</td>
            <td >-</td>
            <td >${{ $result['operatingExpense'] }}</td>
            <td>=</td>
            <td>${{ $result['netProfit'] }}</td>
      
      
    </tr>
       

        </tbody>
    </table>
</div>


<div class="card" style="margin-top: 40px" >
    <table style="width: 100%">
        <thead >
        <tr height="100px" class="background">
        <th width="100px"  style="text-align:left;padding-left: 15px;padding-top: 15px"> ACCOUNTS </th>
        <th  width="50px" >{{ date("F jS, Y",$result['startDate']) }}
        to {{ date("F jS, Y",$result['endDate']) }}</th>


       </tr>
        </thead>
        <tbody style="text-align: center">
        
        <tr height="50px" >
            <td  width="100px"  style="text-align:left;padding-left: 15px;padding-top: 15px">Income</td>
            <td width="50px"> USD {{ $result['income'] }}</td>
  
       </tr>

       <tr height="50px" class="tr3">
      <td width="100px"  style="text-align:left;padding-left: 15px;padding-top: 15px">Cost of Goods Sold</td>
      <td width="50px">USD {{ $result['costOfGoodsSold'] }}</td>
  
    </tr>

    <tr class="background" style="font-weight:bold;" height="40px">
      <td width="100px"  style="text-align:left;padding-left: 15px;padding-top: 15px">Gross Profit</td>
      <td width="50px">USD {{ $result['netProfit'] }}</td>
  
    </tr>

    <tr class="background" height="40px">
      <td width="100px"  style="text-align:left;padding-left: 15px;padding-top: 15px">As a percentage of Total Income</td>
      <td width="50px">100%</td>
  
    </tr>

    <tr height="50px">
      <td width="100px"  style="text-align:left;padding-left: 15px;padding-top: 15px">Operating Expenses</td>
      <td width="50px">USD {{ $result['operatingExpense'] }}</td>
  
    </tr>

    <tr class="background" style="font-weight:bold;" height="40px">
      <td width="100px"  style="text-align:left;padding-left: 15px;padding-top: 15px">Net Profit</td>
      <td width="50px">USD {{ $result['netProfit'] }}</td>
  
    </tr>

    <tr class="background" height="40px">
      <td width="100px"  style="text-align:left;padding-left: 15px;padding-top: 15px">As a percentage of Total Income</td>
      <td width="50px">100%</td>
  
    </tr>

        </tbody>
    </table>
</div>


</body>
</html>