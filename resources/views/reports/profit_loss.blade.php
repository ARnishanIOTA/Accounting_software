


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
    width: 50%;
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

td{
padding-left: 15px;
}


th{
padding-left: 15px;
}

      



</style>

   @stack('head_css_end')    


@section('content')

<div class="row3">
      <h2> Profit & Loss</h2>
     
  </div>
<div class="row1">
    <div class="container1" >
       <table>
         <tr height="70px">
           <td><label>Date Range &nbsp</label></td>
           <td><input type="date" class="form-control" id="picker" name="picker"></td>
           <td>to</td>
           <td><input type="date" class="form-control" id="picker" name="picker"></td>
           
         </tr>

         <tr>
          <td><label>Report &nbsp</label></td>
          <td>
            <select class="form-control" name="type" id="type" placeholder="Select One">
            <option value="" selected disabled>-Select-</option>
            <option value="asset">Accrual(Paid & Unpaid)</option>
            <option value="income">Cash Basis(Paid)</option>
            
          </select></td>
        </tr>

       </table>  
       
      
    </div>

    <div class="container2" >
      
       <button class="button">Update</button>
   </div>
   
</div>

<div class="row2">
  
  <table>
    <tr height="50px" class="tr">
      <th> Income </th>
      <th width="100px"></th>
      <th> Cost of Goods Sold</th>
      <th width="100px">  </th>
      <th> Operating Expenses</th>
      <th width="100px"> </th>
      <th> Net Profit</th>


    </tr>

    <tr height="50px" >
      <td >৳0.00</td>
      <td>-</td>
      <td>৳0.00</td>
      <td >-</td>
      <td >৳0.00</td>
      <td>=</td>
      <td>৳0.00</td>
      
      
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
      <th width="1200px"> ACCOUNTS </th>
      <th width="120px">Jan 01, 2020
        to Jun 18, 2020</th>
      

    </tr>

    <tr height="50px" >
      <td >Income</td>
      <td>BDT 0.00</td>
  
    </tr>

    <tr height="50px" class="tr3">
      <td >Cost of Goods Sold</td>
      <td>BDT 0.00</td>
  
    </tr>

    <tr class="tr4" style="font-weight:bold;" height="40px">
      <td >Gross Profit</td>
      <td>BDT 0.00</td>
  
    </tr>

    <tr class="tr4" height="40px">
      <td >As a percentage of Total Incomet</td>
      <td>0.00%</td>
  
    </tr>

    <tr height="50px">
      <td >Operating Expenses</td>
      <td>BDT 0.00</td>
  
    </tr>

    <tr class="tr4" style="font-weight:bold;" height="40px">
      <td >Net Profit</td>
      <td>BDT 0.00</td>
  
    </tr>

    <tr class="tr4" height="40px">
      <td >As a percentage of Total Incomet</td>
      <td>0.00%</td>
  
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
@endpush       