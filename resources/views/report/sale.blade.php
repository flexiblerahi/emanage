<hr>
@isset($user)
    <p><span class="font-weight-bold ">{{ucfirst($user->role_name)}} Name :</span> {{$user->name}}</p>
    <p><span class=" font-weight-bold">Phone</span> : {{$user->phone}}</p>
    <p><span class="font-weight-bold">Account Id :</span> {{$user->account_id}}</p>
    <p><span class=" font-weight-bold">Total Katha</span> : {{$sales->sum('kata')}}</p>
@endisset

<table class="table table-bordered" style="font-size: 15px">
    <thead>
        <tr>
            <th>Created At</th>
            <th>Customer Name</th>
            <th>Phone</th>
            <th>Katha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
            <tr>
                <td>{{$sale->created_at->format('d-m-Y')}}</td>
                <td>{{ $sale->customer->name }}</td>
                <td>{{ $sale->customer->phone }}</td>
                <td>{{ $sale->kata }}</td>
            </tr>
        @endforeach
        
    </tbody>
</table>