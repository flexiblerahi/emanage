<hr>    
<table class="table table-bordered" style="font-size: 15px">
    <thead>
        <tr>
            <th>Date</th>
            <th>Land of Details</th>
            <th>Payment Type</th>
            <th>Amount</th>
            <th>Percentage</th>
        </tr>
    </thead>
    <tbody>
        @foreach($deposits as $deposit)
            @php
                $total = (int) $deposit->bank_transaction->amount + $total;
            @endphp
            <tr>
                
                <td>{{ $deposit->created_at->format('d-m-Y') }}</td>
                <td>
                    <p><b>sector: </b>{{$deposit->sale->sector}}
                    ,<b> block: </b>{{$deposit->sale->block}}
                    ,<b> road: </b>{{$deposit->sale->road}}
                    ,<b> price: </b>{{$deposit->sale->price}}
                    ,<b> katha: </b>{{$deposit->sale->kata}}
                    ,<b> plot: </b>{{$deposit->sale->plot}}</p>
                </td>
                <td>{{ $deposit->payment_type }}</td>
                <td>{{ tk($deposit->bank_transaction->amount) }}</td>
                <td>{{ $deposit->percentage. ' %' }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
                
            <td></td>
            <td></td>
            <td><b>Total</b></td>
            <td>{{ tk($total) }}</td>
            <td></td>
        </tr>
    </tfoot>
</table>