


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
    margin-top: 40px;
    padding: 0px;
   
    border-radius: 10px;
    
    height: 300px;
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
  top: 2rem;

}





</style>

   @stack('head_css_end')    




@section('content')

    <div class="row3">
      <h2>  Income by Customer</h2>
     
  </div>
<div class="row1">
    <div class="container1" >
       <table>
         <tr>
           <td><label>Date Range &nbsp</label></td>
           <td><input type="date"  id="formDate"  value="{{ $startDate }}" class="form-control" id="picker" name="picker"></td>
           <td>to</td>
           <td><input type="date" id="toDate" value="{{ $endDate }}" class="form-control" id="picker" name="picker"></td>
         </tr>
       </table>  
       
      
    </div>

    <div class="container2" >
      
       <button class="button" onclick="formValidation()">Update</button>
   </div>
   
</div>

<div class="row2">

  <table>
    <tr height="50px">
      <th width="950px" style="padding-left: 15px;">CUSTOMERS </th>
      <th width="230px">ALL INCOME</th>
      <th width="200px">PAID INCOME</th>
   
    </tr>

    <tr class="tr" height="50px">
      <td style="padding-left: 15px;">INCOME</td>
      <td></td>
      <td></td>
      
    </tr>
   @foreach($result as $row)
    <tr height="50px">
      <td style="padding-left: 15px;">{{ $row['contact_name'] }}</td>
      <td>USD {{ $row['Paid'] + $row['unPaid'] + $row['partialPaid']}}</td>
      <td>USD {{ $row['Paid'] + $row['partialPaid'] }}</td>
      
    </tr>
    @endforeach
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
                window.location.href = '{{ url('report/incomeByCustomer') }}/' + formDateTime + '/' + toDateTime;
            }
        }
    </script>
@endpush       