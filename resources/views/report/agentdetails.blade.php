<hr>
<p><span class="font-weight-bold ">{{ucfirst($shareholder->role_name)}} Name :</span> {{$shareholder->name}}</p>
<p><span class=" font-weight-bold">Phone</span> : {{$shareholder->phone}}</p>
<p><span class="font-weight-bold">Account Id :</span> {{$shareholder->account_id}}</p>
<table class="table table-bordered" style="font-size: 15px">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Permanent Address</th>
            <th>Present Address</th>
            <th>Phone</th>
            <th>Total Earning</th>
            <th>Balance</th>
            <th>Total Withdraw Amount</th>
            <th>Rank</th>
            <th>Katha</th>
            <th>Reference Account Id</th>
            <th>Total Agents</th>
        </tr>
    </thead>
    <tbody>
        @foreach($agents as $agent)
            
            <tr>
                <td><img src="{{$agent->profile_image}}" alt="profile image" height="50px" width="50px"></td>
                <td>{{ $agent->name }}</td>
                <td>{{$agent->permanent_address}}</td>
                <td>{{ $agent->present_address }}</td>
                <td>{{ $agent->phone }}</td>
                <td>{{ tk($agent->transactions->where('type', 1)->sum('amount')) }}</td>
                <td>{{ $agent->income }}</td>
                <td>{{ tk($agent->transactions->where('type', 0)->sum('amount')) }}</td>
                <td>{{ countRank($agent->total_kata) }}</td>
                <td>{{ $agent->sales->sum('kata') }}</td>
                <td>{{ $agent->refer_account->account_id }}</td>
                <td>{{ $agent->total_agents($agent->id, $refer_users) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>