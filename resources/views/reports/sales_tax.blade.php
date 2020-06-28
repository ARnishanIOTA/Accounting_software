
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

<div class="row3">
      <h2>Sales Tax Report</h2>
     
  </div>
<div class="row1">
    <div class="container1" >
      
       <table>
         <tr >
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
  <h4>SALES & PURCHASES</h4>
  
  <table>
    <tr height="100px" class="tr">
      <th width="350px" style="padding-left: 15px;">Tax </th>
      <th width="250px">Sales Subject to Tax</th>
      <th width="250px">Tax Amount on Sales</th>
      <th width="250px" >Purchases Subject to Tax </th>
      <th width="250px" >Tax Amount on Purchases</th>
      <th width="100px">Net Tax Owing</th>

    </tr>

    <tr height="50px" class="tr2">
      <td style="padding-left: 15px;">Total</td>
      <td></td>
      <td>BDT 0.00</td>
      <td >BDT 0.00</td>
      <td >BDT 0.00</td>
      <td>BDT 0.00</td>
      
      
    </tr>

    
    
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
      <td>BDT 0.00</td>
      
      <td >BDT 0.00</td>
      <td >BDT 0.00</td>
      <td>BDT 0.00</td>
      
      
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