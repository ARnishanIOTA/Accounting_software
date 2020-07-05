


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
    height: 170px;
    width: 100%;
    
}
.row2 {
    
    margin: auto;

    padding: 10px 10px 10px 10px;
    width: 70%;
    border-radius: 10px;
    text-align: center;
    height: 150px;
    margin-top: 15px;
    
    
}

.row3 {
  margin: 10px;
   
    
}


.row4 {
    
    margin: auto;
    padding: 0px;
    width: 80%;
    border-radius: 10px;
    /* background-color: #f8f9f8; */
    height: 420px;
    width: 100%;
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

.tr2{
  padding-top: 10px;
  font-size: 16px;
  border-bottom: 1px solid #d1d2e3;
 

  
}

.tr3{
  
  border-top: 1px solid #d1d2e3;
 

  
}

.tr4{
  
 
  background-color: #f8f9f8;

  
}

/* td{
padding-left: 15px;
} */


.data1{
padding-left: 30px;
width: 1150px;
}


.data{
padding-left: 30px;
}

.th1{
  width: 200px;
}

.th2{
  width: 100px;
}


.th3{
  width: 400px;
}


.th4{
  width: 120px;
}

.th6{
  width: 100px;
}



@media only screen and (max-width: 768px) {
  
 
  
  .row1 {
    
    
    height: 150px;
    width: 100%;
    
}

.row2 {
    
    margin: auto;

    padding: 10px 10px 10px 10px;
    width: 90%;
    border-radius: 10px;
    text-align: center;
    height: 150px;
    margin-top: 15px;
    
    
}

.container1{
  float: left;
  width: 80%; 
  padding: 10px;
  
  text-align: center;
}


.container2{
  float: left;
  width: 20%; 
  padding: 20px;
  text-align: right;
  
}




}

@media only screen and (max-width: 1024px) {
  .th4{
  width: 180px;
}

}

      



</style>

   @stack('head_css_end')    


@section('content')
    <?php
    $form = date('Y-m-d',$result['startDate']);
    $to = date('Y-m-d',$result['endDate']);
    ?>
<div class="row3">
    <div class="row">
        <div class="col-xl-8">
            <h2>Profit & Loss</h2>
        </div>
        <div class="col-xl-4">
            <div style="float: right;" class="dropdown">
                <a href="#" class="dropdown-toggle btn btn-success m-r-10-m-l-10" data-toggle="dropdown">Export</a>
                <div class="dropdown-menu">
                    <a href="{{url('report/profitAndLossPdf/'.$form.'/'.$to.'/'.$reportType)}}" class="dropdown-item">PDF</a>
                    <a href="{{url('report/profitAndLossExcel/'.$form.'/'.$to.'/'.$reportType)}}" class="dropdown-item">EXCEL</a>
                </div>
            </div>
        </div>

    </div>
     
  </div>

<div class="row1">
    <div class="container1" >
       <table>
         <tr height="70px">
           <td><label>Date Range &nbsp</label></td>
           <td><input type="date" id="formDate" value="{{$form}}" class="form-control" id="picker" name="picker"></td>
           <td>to</td>
           <td><input type="date" id="toDate"  value="{{$to}}" class="form-control" id="picker" name="picker"></td>
           
         </tr>

         <tr>
          <td><label>Report &nbsp</label></td>
          <td>
            <select class="form-control" name="type" id="type" placeholder="Select One">
                <option  value="1" @if($reportType == 1) selected @endif>Accrual(Paid & Unpaid)</option>
                <option value="2"  @if($reportType == 2) selected @endif>Cash Basis(Paid)</option>
            
          </select></td>
        </tr>

       </table>  
       
      
    </div>

    <div class="container2" >
      
       <button class="button" onclick="formValidation()">Update</button>
   </div>
   
</div>

<div class="row2">
  
  <table>
    <tr height="50px" class="tr">
      <th class="th1"> Income </th>
      <th class="th2"></th>
      <th class="th3"> Cost of Goods Sold</th>
      <th class="th2">  </th>
      <th class="th3"> Operating Expenses</th>
      <th class="th2"> </th>
      <th class="th1"> Net Profit</th>


    </tr>


    <tr height="50px" >
      <td >${{ $result['income'] }}</td>
      <td>-</td>
      <td>${{ $result['costOfGoodsSold'] }}</td>
      <td >-</td>
      <td >${{ $result['operatingExpense'] }}</td>
      <td>=</td>
      <td>${{ $result['netProfit'] }}</td>
      
      
    </tr>

    
    
  </table>
 
 
</div>

<!-- <div style="width: 80%; height: 20px; border-bottom: 1px solid black; text-align: center">
  <span style="font-size: 40px; background-color: #F3F5F6; padding: 0 10px;">
    Section Title Padding is optional
  </span>
</div> -->


<div class="row4">
  
  <table>
    <tr height="50px" class="tr2">
      <th class="data1"> ACCOUNTS </th>
      <th class="th4">{{ date("F jS, Y",$result['startDate']) }}
        to {{ date("F jS, Y",$result['endDate']) }}</th>
      

    </tr>

    <tr height="50px" >
      <td class="data">Income</td>
      <td>USD {{ $result['income'] }}</td>
  
    </tr>

    <tr height="50px" class="tr3">
      <td class="data">Cost of Goods Sold</td>
      <td>USD {{ $result['costOfGoodsSold'] }}</td>
  
    </tr>

    <tr class="tr4" style="font-weight:bold;" height="40px">
      <td class="data">Gross Profit</td>
      <td>USD {{ $result['netProfit'] }}</td>
  
    </tr>

    <tr class="tr4" height="40px">
      <td class="data">As a percentage of Total Income</td>
      <td>100%</td>
  
    </tr>

    <tr height="50px">
      <td class="data">Operating Expenses</td>
      <td>USD {{ $result['operatingExpense'] }}</td>
  
    </tr>

    <tr class="tr4" style="font-weight:bold;" height="40px">
      <td class="data">Net Profit</td>
      <td>USD {{ $result['netProfit'] }}</td>
  
    </tr>

    <tr class="tr4" height="40px">
      <td class="data">As a percentage of Total Income</td>
      <td>100%</td>
  
    </tr>

    
    
  </table>
 
 
</div>

@endsection


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
                 window.location.href = '{{ url('report/profitAndLoss') }}/' + formDateTime + '/' + toDateTime+'/'+ role;
            }
        }
    </script>
@endpush       