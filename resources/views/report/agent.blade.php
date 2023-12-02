<hr>
<p><span class="font-weight-bold ">{{ucfirst($shareholder->role_name)}} Name :</span> {{$shareholder->name}}</p>
<p><span class=" font-weight-bold">Phone</span> : {{$shareholder->phone}}</p>
<p><span class="font-weight-bold">Account Id :</span> {{$shareholder->account_id}}</p>
<table class="table table-bordered" style="font-size: 15px">
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Katha</th>
            <th>Present Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach($agents as $agent)
            <tr>
                <td>{{ $agent->name }}</td>
                <td>{{ $agent->phone }}</td>
                <td>{{ $agent->sales->sum('kata') }}</td>
                <td>{{ $agent->present_address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>