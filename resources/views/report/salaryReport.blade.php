
<hr>
<table class="table table-bordered" style="font-size: 15px">
    <thead>
        <tr>
            <th>Month Name</th>
            <th>Transaction Date</th>
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
        @foreach($periods as $date)
            @php
                $month = $date->format('m');
                $results = $salaries->filter(function ($item) use ($month) {
                    $monthly = explode('-',$item->monthly);
                    return $monthly[1] == $month;
                });
            @endphp
            @forelse ($results as $salary)
                @php
                    $total = $total - $salary->bank_transaction->amount;
                @endphp
                <tr>
                    <td>{{$date->format('F Y')}}</td>
                    <td>{{ $salary->bank_transaction->date }}</td>
                    <td>{{ $salary->bank_transaction->bank_info->bankname->name }}</td>
                    <td>@if($salary->bank_transaction->bank_info->bankname->name != 'Cash') {{ $salary->bank_transaction->bank_info->account_id }} @endif</td>
                    <td>@if($salary->bank_transaction->bank_info->bankname->name != 'Cash') {!! emergencyContact($salary->bank_transaction->trx_no) !!} @endif</td>
                    <td>{{ tk(abs($salary->bank_transaction->amount)) }}</td>
                </tr>
            @empty
                <tr>
                    <td>{{$date->format('F Y')}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
            
        @endforeach
        <tr>
            <td colspan="5" style="text-align: end;padding-right:5%;font-weight: bold">Total :</td>
            <td>{{ tk(abs($total)) }}</td>
        </tr>
    </tbody>
</table>