<hr>
@if (!empty($user))
    <p><span class="font-weight-bold ">{{ucfirst($user->role_name)}} Name :</span> {{$user->name}}</p>
    <p><span class=" font-weight-bold">Phone</span> : {{$user->phone}}</p>
    <p><span class="font-weight-bold">Account Id :</span> {{$user->account_id}}</p>
    <p><span class=" font-weight-bold">Current Balance</span> : {{tk($user->income)}}</p>
@endif

<table class="table table-bordered" style="font-size: 15px">
    <thead>
        <tr>
            <th>Date</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($withdraws as $withdraw)
            <tr>
                <td>{{ $withdraw->created_at->format('d-m-Y') }}</td>
                <td class="text-right">{{ tk(abs($withdraw->amount)) }}</td>
            </tr>
        @endforeach
        <tr>
            <td>Total</td>
            <td class="text-right">{{tk(abs($total))}}</td>
        </tr>
    </tbody>
</table>