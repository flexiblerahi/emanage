
<hr>
<table class="table table-bordered" style="font-size: 15px">
    <thead>
        <tr>
            <th>Type</th>
            <th>Bank Name</th>
            <th>Bank Account No</th>
            <th>Trx No.</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach($expenses as $expense)
            @php
                $total = $total - $expense->bank_transaction->amount;
            @endphp
            <tr>
                <td>{{ $expense->type->title }}</td>
                <td>{{ $expense->bank_transaction->bank_info->bankname->name }}</td>
                <td>@if($expense->bank_transaction->bank_info->bankname->name != 'Cash') {{ $expense->bank_transaction->bank_info->account_id }} @endif</td>
                <td>@if($expense->bank_transaction->bank_info->bankname->name != 'Cash') {!! emergencyContact($expense->bank_transaction->trx_no) !!} @endif</td>
                <td>{{ tk(abs($expense->bank_transaction->amount)) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" style="text-align: end;padding-right:7%;font-weight: bold">Total :</td>
            <td>{{ abs($total) }}</td>
        </tr>
    </tbody>
</table>