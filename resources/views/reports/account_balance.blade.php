


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
    height: 80px;
    width: 100%;
    
}
.row2 {
    
    margin: auto;
   
    margin-top: 50px;
    padding: 0px;
   
    border-radius: 10px;
    
    height: 370px;
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

.tr2{
  font-size: 18px;
  background-color: #f8f9f8;
  position: relative;
  border-top: 2px solid #d1d2e3;
  border-bottom: 1px solid #d1d2e3;

}

.tr3{
  
  border-bottom: 1px solid #d1d2e3;

}

.tr4{
  font-size: 18px;
  background-color: #f8f9f8;

}


      



</style>

@stack('head_css_end')    


@section('content')

<div class="row3">
      <h2>  Account Balances</h2>
     
  </div>
<div class="row1">
    <div class="container1" >
       <table>
         <tr>
           <td><label>Date Range &nbsp</label></td>
           <td><input type="date" class="form-control" id="picker" name="picker"></td>
           <td>to</td>
           <td><input type="date" class="form-control" id="picker" name="picker"></td>
         </tr>
       </table>  
       
      
    </div>

    <div class="container2" >
      
       <button class="button">Update</button>
   </div>
   
</div>

<div class="row2">
  
  
  <table>
    <tr  class="tr">
      <th width="350px" style="padding-left: 15px;">ACCOUNT </th>
      <th width="250px">STARTING BALANCE</th>
      <th width="250px">DEBIT</th>
      <th width="250px" >CREDIT </th>
      <th width="250px" >NET MOVEMENT</th>
      <th width="100px">ENDING BALANCE</th>

    </tr>
     
    <tr height="50px" class="tr2">
      <td style="padding-left: 15px;">Assets</td>
      <td></td>
      <td></td>
      <td ></td>
      <td ></td>
      <td></td>
      
      
    </tr>

    

    <tr height="50px" class="tr3">
      <td style="padding-left: 15px;">Total Assets</td>
      <td>BDT 0.00</td>
      <td>BDT 0.00</td>
      <td >BDT 0.00</td>
      <td >BDT 0.00</td>
      <td>BDT 0.00</td>
      
      
    </tr>


    <tr height="50px" class="tr4">
      <td style="padding-left: 15px;">Liabilities</td>
      <td></td>
      <td></td>
      <td ></td>
      <td ></td>
      <td></td>
      
      
    </tr>

    

    <tr height="50px" class="tr3">
      <td style="padding-left: 15px;">Total Liabilities</td>
      <td>BDT 0.00</td>
      <td>BDT 0.00</td>
      <td >BDT 0.00</td>
      <td >BDT 0.00</td>
      <td>BDT 0.00</td>
      
      
    </tr>

    
   
    

    <tr height="100px" >
      <td style="padding-left: 15px;">Total For All Account</td>
      <td></td>
      <td>BDT 0.00</td>
      <td >BDT 0.00</td>
      <td ></td>
      <td></td>
      
      
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