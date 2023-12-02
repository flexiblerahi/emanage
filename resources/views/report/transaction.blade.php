<hr>
@isset($user)
    
    <p><span class="font-weight-bold ">{{ucfirst($user->role_name)}} Name :</span> {{$user->name}}</p>
    <p><span class=" font-weight-bold">Phone</span> : {{$user->phone}}</p>
    <p><span class="font-weight-bold">Account Id :</span> {{$user->account_id}}</p>
    <p><span class=" font-weight-bold">Current Balance</span> : {{tk($user->income)}}</p>
@endisset
<table class="table table-bordered" style="font-size: 15px">
    <thead>
        <tr>
            <th>Date</th>
            <th>Land Details</th>
            <th>Reference</th>
            <th>Payment Type</th>
            <th>Transaction</th>
            <th>Deposit Amount</th>
            <th>Commission Amount</th>
            <th>Withdraw Amount</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
            @php
                if($transaction->status == 0) $total_withdraw = $total_withdraw + $transaction->amount; 
                $balance = $balance + $transaction->amount;
            @endphp
            <tr>
                <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                <td>
                    @if (!is_null($transaction->payment))
                        <p><b>sector: </b>{{$transaction->payment->sale->sector}}
                        ,<b> block: </b>{{$transaction->payment->sale->block}}
                        ,<b> road: </b>{{$transaction->payment->sale->road}}
                        ,<b> price: </b>{{tk($transaction->payment->sale->price)}}
                        ,<b> katha: </b>{{$transaction->payment->sale->kata}}
                        ,<b> plot: </b>{{$transaction->payment->sale->plot}}</p>
                    @else
                            -
                    @endif
                </td>
                <td>
                    @if (!is_null($transaction->payment))
                        @if (is_null($transaction->payment->sale->shareholder))
                            <p><b>Name: </b>{{$transaction->payment->sale->agent->name}}
                                <br><b> Id: </b>{{$transaction->payment->sale->agent->account_id}}</p>
                        @else
                            <p><b>Name: </b>{{$transaction->payment->sale->shareholder->name}} 
                                <br><b> Id: </b>{{$transaction->payment->sale->shareholder->account_id}}</p>
                        @endif
                    @else
                        -
                    @endif
                </td>
                <td>{{ (is_null($transaction->payment)) ? '-' : $transaction->payment->payment_type }}</td>
                <td>{{$transaction->transaction_type}}</td>
                <td>{{(is_null($transaction->payment)) ? '-' : tk($transaction->payment->amount)}}</td>
                <td>{{ ($transaction->status == 1) ? tk($transaction->amount) : '-' }}</td>
                <td>{{ ($transaction->status == 0) ? tk(abs($transaction->amount)) : '-' }}</td>
                <td>{{ tk($balance) }}</td>
            </tr>
        @endforeach
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $total_commission }}</td>
            <td>{{ tk(abs($total_withdraw)) }}</td>
            <td></td>
        </tr>
    </tbody>
</table>