<hr>
<p><span class="font-weight-bold ">{{ucfirst($shareholder->role_name)}} Name :</span> {{$shareholder->name}}</p>
<p><span class=" font-weight-bold">Phone</span> : {{$shareholder->phone}}</p>
<p><span class="font-weight-bold">Account Id :</span> {{$shareholder->account_id}}</p>
<p><span class="font-weight-bold">Total</span> : {{ucfirst($customers->sum('total_amount'))}}</p>

<hr>
<table class="table table-bordered" style="font-size: 15px">
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Phone</th>
            <th>Katha</th>
            <th>Present Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->customer->name }}</td>
                <td>{{ $customer->customer->phone }}</td>
                <td>{{ $customer->total_amount }}</td>
                <td>{{ $customer->customer->present_address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>