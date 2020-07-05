<table>
    <thead>
    <tr>
        <th colspan="4">Profit And Loss</th>
    </tr>
    <tr>
        <th colspan="4">Date Range {{date("F jS, Y", $result['startDate'])}} to {{date("F jS, Y", $result['endDate'])}}</th>
    </tr>
    <tr>
        <th colspan="2"> ACCOUNTS </th>
        <th colspan="2">{{ date("F jS, Y",$result['startDate']) }}
            to {{ date("F jS, Y",$result['endDate']) }}</th>


    </tr>

    <tr>
        <td colspan="2">Income</td>
        <td colspan="2">USD {{ $result['income'] }}</td>

    </tr >

    <tr>
        <td colspan="2">Cost of Goods Sold</td>
        <td colspan="2">USD {{ $result['costOfGoodsSold'] }}</td>

    </tr>

    <tr>
        <td colspan="2">Gross Profit</td>
        <td colspan="2">USD {{ $result['netProfit'] }}</td>

    </tr>

    <tr>
        <td colspan="2">As a percentage of Total Income</td>
        <td colspan="2">100%</td>

    </tr>

    <tr>
        <td colspan="2">Operating Expenses</td>
        <td colspan="2">USD {{ $result['operatingExpense'] }}</td>

    </tr>

    <tr>
        <td colspan="2">Net Profit</td>
        <td colspan="2">USD {{ $result['netProfit'] }}</td>

    </tr>

    <tr>
        <td colspan="2">As a percentage of Total Income</td>
        <td colspan="2">100%</td>

    </tr>

    </thead>
    <tbody>
    </tbody>
</table>
