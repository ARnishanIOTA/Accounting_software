<table>
    <thead>
    <tr>
        <th colspan="3">Income By Customer</th>
    </tr>
    <tr>
        <th colspan="3">Date Range {{date("F jS, Y", strtotime($startDate))}} to {{date("F jS, Y", strtotime($endDate))}}</th>
    </tr>
    <tr >
        <th> @if($type == 'income') CUSTOMERS @else VENDORS @endif </th>
        <th> @if($type == 'income') ALL INCOME @else ALL PURCHASES @endif </th>
        <th> @if($type == 'income') PAID INCOME @else PAID PURCHASES @endif </th>
    </tr>
    </thead>
    <tbody>
    @foreach($result as $row)
        <?php

        $allPaid = $row['Paid'] + $row['unPaid'] + $row['partialPaid'];
        $paid = $row['Paid'] + $row['partialPaid'];

        ?>
        <tr>
            <td>{{ $row['contact_name'] }}</td>
            <td>USD {{ $allPaid }}</td>
            <td>USD {{ $paid }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
