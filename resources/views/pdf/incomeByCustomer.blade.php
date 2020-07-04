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

    </style>
</head>
<body>
<div class="row3">
    <div class="row">
        <div class="col-xl-8">
            <h2>Income by Customer</h2>
        </div>
    </div>



</div>
<div class="row add-background">
    <div class="row1">
        <div class="container1" >
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


<div class="card" style="margin-top: 20px">
    <table style="width: 100%">
        <thead style="background:#f8f9f8; border-radius: 5px;padding: 10px">
        <tr >
            <th width="50%">CUSTOMERS</th>
            <th  width="25%">ALL INCOME</th>
            <th  width="25%">PAID INCOME</th>
        </tr>
        </thead>
        <tbody style="text-align: center">
        @foreach($result as $row)
        <tr>
            <td  width="50%">{{ $row['contact_name'] }}</td>
            <td  width="25%">USD {{ $row['Paid'] + $row['unPaid'] + $row['partialPaid']}}</td>
            <td  width="25%">USD {{ $row['Paid'] + $row['partialPaid'] }}</td>
        </tr>
        @endforeach

        </tbody>
    </table>
</div>

</body>
</html>