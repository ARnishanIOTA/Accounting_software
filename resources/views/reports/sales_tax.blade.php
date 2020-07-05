
@extends('layouts.admin')


@stack('head_css_start')
<style>
* {
  box-sizing: border-box;
}

.row1 {
    
    margin: auto;
    padding: 10px 20px 10px 20px;
   
    border-radius: 10px;
    background-color: #f8f9f8;
    height: 130px;
    width: 100%;
    
}
.row2 {
    
    margin: auto;
    padding: 0px;
    margin-top: 50px;
   
    border-radius: 10px;
    
    height: 250px;
    width: 100%;
}



.row3 {
  margin: 10px;
   
    
}

.container1{
  float: left;
  width: 60%; 
  padding: 10px;
  
  text-align: center;
}

.container2{
  float: left;
  width: 40%; 
  padding: 10px;
  text-align: right;
  
}

.button {
  background-color: #230e97; /* Green */
  border: none;
  color: white;
  padding: 10px;
  width: 100px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 12px;
}

th {
        font-size: 18px;

      }

.tr{
  font-size: 18px;
  background-color: #f8f9f8;
  position: relative;
 

}

.tr2{
  border-bottom: 2px solid #f8f9f8;

}

      



</style>

   @stack('head_css_end')    


@section('content')
    <?php
    $form = date('Y-m-d',$startDate);
    $to = date('Y-m-d',$endDate);
    ?>
<div class="row3">
    <div class="row">
        <div class="col-xl-8">
            <h2>Sales Tax Report</h2>
        </div>
        <div class="col-xl-4">
            <div style="float: right;" class="dropdown">
                <a href="#" class="dropdown-toggle btn btn-success m-r-10-m-l-10" data-toggle="dropdown">Export</a>
                <div class="dropdown-menu">
                    <a href="{{url('report/profitAndLossPdf/'.$form.'/'.$to.'/'.$reportType)}}" class="dropdown-item">PDF</a>
                    <a href="{{url('report/salesTaxReportExcel/'.$form.'/'.$to.'/'.$reportType)}}" class="dropdown-item">EXCEL</a>
                </div>
            </div>
        </div>

    </div>
     
  </div>
<div class="row1">
    <div class="container1" >
      
       <table>
           <thead>
             <tr>
                 <td class="" colspan="3"><label>Date Range &nbsp</label></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td colspan="3"><label>Report Type &nbsp</label></td>
             </tr>
           </thead>
         <tbody>
         <tr>
           <td><input type="date" id="formDate" value="{{$form}}" class="form-control" id="picker" name="picker"></td>
           <td>to</td>
           <td><input type="date" id="toDate" value="{{$to}}" class="form-control" id="picker" name="picker"></td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td colspan="3">
                 <select class="form-control" name="type" id="type" placeholder="Select One">
                     <option  value="1"@if($reportType == 1) selected @endif >Accrual(Paid & Unpaid)</option>
                     <option value="2" @if($reportType == 2) selected @endif>Cash Basis(Paid)</option>
                 </select>
             </td>
         </tr>
         </tbody>


       </table>  
       
      
    </div>

    <div class="container2" >
      
       <button class="button" onclick="formValidation()">Update</button>
   </div>
   
</div>

<div class="row2">
    <div class="row">
        <div class="col-xl-8">
            <h4>SALES & PURCHASES</h4>
        </div>
        <div class="col-xl-4">
            {{ date("F jS, Y",$startDate) }}
            to {{ date("F jS, Y",$endDate) }}
        </div>
    </div>
  
  <table>
    <tr height="100px" class="tr">
      <th width="350px" style="padding-left: 15px;">Tax </th>
      <th width="250px">Sales Subject to Tax</th>
      <th width="250px">Tax Amount on Sales</th>
      <th width="250px" >Purchases Subject to Tax </th>
      <th width="250px" >Tax Amount on Purchases</th>
      <th width="100px">Net Tax Owing</th>

    </tr>
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
          <tr height="50px" class="tr2">
              <td style="padding-left: 15px;">{{ $key }}</td>
              <td>USD {{ $Subject_to_Tax_Sale }}</td>
              <td>USD {{ $taxAmountSale }}</td>
              <td >USD {{ $Subject_to_Tax_Purchase }}</td>
              <td >USD {{ $taxAmountPurchase }}</td>
              <td>USD {{ $netTax }}</td>


          </tr>
      @endforeach


    
    
  </table>
 
 
</div>


<div class="row2">
  <h4>PAYMENTS & BALANCES OWING</h4>

  <table>
    <tr height="100px" class="tr">
      <th width="550px" style="padding-left: 15px;">Starting Balance </th>
      <th width="250px">Net Tax Owing</th>
      <th width="250px" >Tax Amount on Sales</th>
      <th width="250px" >Less Payments to Government </th>
      
      <th width="100px">Ending Balance</th>

    </tr>

    <tr height="50px" class="tr2">
      <td style="padding-left: 15px;">Total</td>
      <td>USD 0.00</td>
      
      <td >USD 0.00</td>
      <td >USD 0.00</td>
      <td>USD 0.00</td>
      
      
    </tr>

    
    
  </table>
 
 
</div>

@endsection




        
        <script>
                //  $('#picker').daterangepicker({
                //                     opens: 'left'
                //                   }, function(start, end, label) {
                //                     $('#start').text(start.format('YYYY-MM-DD'))
                //                     $('#end').text(end.format('YYYY-MM-DD'))
                                    
                //                   });


        </script>

 @push('scripts_start')
    <script src="{{ asset('public/js/common/reports.js?v=' . version('short')) }}"></script>
    <script>
        function toTimestamp(strDate){
            let datum = Date.parse(strDate);
            return datum/1000;
        }
        function formValidation(){
            let formDateTime = document.getElementById("formDate").value;
            let toDateTime = document.getElementById("toDate").value;
            let role = document.getElementById("type").value;
            let fTime = toTimestamp(formDateTime);
            let tTime = toTimestamp(toDateTime);
            if(formDateTime == '' || toDateTime == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: " You Must Insert Date! ",
                })
            }
            else if(tTime < fTime ){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: " Your Ending Date Must be Greater Than Starting Date! ",
                })
            }
            else {
                window.location.href = '{{ url('report/salesTaxReport') }}/' + formDateTime + '/' + toDateTime + '/' + role;
            }
        }
    </script>
@endpush       