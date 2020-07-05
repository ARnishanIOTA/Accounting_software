<table>
    <thead>
        <tr>
            <th colspan="12">Sales Tax Report</th>
        </tr>
        <tr>
            <th colspan="12">Date Range {{date("F jS, Y", strtotime($startDate))}} to {{date("F jS, Y", strtotime($endDate))}}</th>
        </tr>
        <tr>
            <th colspan="6"> SALES AND PURCHASES </th>
            <th colspan="6">{{ date("F jS, Y",strtotime($startDate)) }}
                to {{ date("F jS, Y",strtotime($endDate)) }}</th>
        </tr>

        <tr>
            <th colspan="2">Tax </th>
            <th colspan="2">Sales Subject to Tax</th>
            <th colspan="2">Tax Amount on Sales</th>
            <th colspan="2" >Purchases Subject to Tax </th>
            <th colspan="2" >Tax Amount on Purchases</th>
            <th colspan="2">Net Tax Owing</th>

        </tr>

    </thead>
    <tbody>
    @foreach($result as $key => $value )
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
        <tr>
            <td colspan="2">{{ $key }}</td>
            <td colspan="2">USD {{ $Subject_to_Tax_Sale }}</td>
            <td colspan="2">USD {{ $taxAmountSale }}</td>
            <td colspan="2">USD {{ $Subject_to_Tax_Purchase }}</td>
            <td colspan="2">USD {{ $taxAmountPurchase }}</td>
            <td colspan="2">USD {{ $netTax }}</td>


        </tr>
    @endforeach

    </tbody>
</table>
