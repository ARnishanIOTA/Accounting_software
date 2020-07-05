<!DOCTYPE html>
<html>
<head>
    <title> Income By Customer</title>
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


<div class="row" style="margin-top: 40px;">
    <div class="row">
        <div class="container" >
            <table>
                <tr >
                    <td width="200px" style="padding: 15px"><h4>SALES & PURCHASES</h4></td>
                    <td width="450px" style=" text-align:right;">{{date("F jS, Y", strtotime($startDate))}} to
                      {{date("F jS, Y", strtotime($endDate))}}</td>
                   
                </tr>
            </table>


        </div>

    </div>
</div>









<div class="card" style=" text-align:center; " >
    <table style="width: 100%" >
        <thead class="background">
        <tr height="100px"  style="font-size: 13px;">
            <th width="50px">Tax </th>
            <th width="120px" >Sales Subject to Tax</th>
            <th >Tax Amount on Sales</th>
            <th >Purchases Subject to Tax </th>
            <th >Tax Amount on Purchases</th>
            <th width="100px">Net Tax Owing</th>


       </tr>
        </thead>
        <tbody style="text-align: center; " >
        @foreach($report as $key => $value )
          <?php
          $Subject_to_Tax_Sale = $taxAmountSale = $Subject_to_Tax_Purchase = $taxAmountPurchase = number_format((float)0, 2, '.', '');
          if(array_key_exists('Sales', $value))
          {
              $Subject_to_Tax_Sale = $value['Sales']['Subject_to_Tax'];
              $Subject_to_Tax_Sale = number_format((float)$Subject_to_Tax_Sale, 2, '.', '');
              $taxAmountSale = $value['Sales']['taxAmount'];
              $taxAmountSale = number_format((float)$taxAmountSale, 2, '.', '');
          }
          if(array_key_exists('Bills', $value)){
              $Subject_to_Tax_Purchase = $value['Bills']['Subject_to_Tax'];
              $Subject_to_Tax_Purchase = number_format((float)$Subject_to_Tax_Purchase, 2, '.', '');
              $taxAmountPurchase = $value['Bills']['taxAmount'];
              $taxAmountPurchase = number_format((float)$taxAmountPurchase, 2, '.', '');
          }
          $netTax = $taxAmountSale + $taxAmountPurchase;
          $netTax = number_format((float)$netTax, 2, '.', '');
          ?>
          <tr height="50px" style="font-size: 13px;">
              <td style="padding-left: 15px;">{{ $key }}</td>
              <td>USD {{ $Subject_to_Tax_Sale }}</td>
              <td>USD {{ $taxAmountSale }}</td>
              <td >USD {{ $Subject_to_Tax_Purchase }}</td>
              <td >USD {{ $taxAmountPurchase }}</td>
              <td>USD {{ $netTax }}</td>


          </tr>
      @endforeach
      </tbody> 
    </table>
</div>


<div class="row" style="margin-top: 40px;">
    <div class="row">
        <div class="container" >
            <table>
                <tr >
                    <td width="200px" style="padding: 15px"><h4>PAYMENTS & BALANCES OWING</h4></td>
                    <td width="450px" style=" text-align:right;">{{date("F jS, Y", strtotime($startDate))}} to
                      {{date("F jS, Y", strtotime($endDate))}}</td>
                   
                </tr>
            </table>


        </div>

    </div>
</div>


<div class="card" style=" text-align:center;" >
    <table style="width: 100%" >
        <thead class="background">
        <tr height="100px"  style="font-size: 13px;">
            
            <th >Starting Balance </th>
            <th >Net Tax Owing</th>
            <th >Tax Amount on Sales</th>
            <th >Less Payments to Government </th>
            
            <th >Ending Balance</th>

        </tr>


        <tr height="50px" style="font-size: 13px; text-align:center">
            <td >Total</td>
            <td>USD 0.00</td>
            
            <td >USD 0.00</td>
            <td >USD 0.00</td>
            <td>USD 0.00</td>
      
      
     </tr>
      </tbody> 
    </table>
</div>






</body>
</html>