<hr>
<h4 class="pb-2"><span class="font-weight-bold">Total Company Sale</span> : {{$shareholders->sum('total_amount')}}</h4>
<table class="table table-bordered" style="font-size: 15px">
    <thead>
        <tr>
            <th>Master Agent's Name</th>
            <th>Phone</th>
            <th>Katha</th>
            <th>Present Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach($shareholders as $shareholder)
            <tr>
                <td>{{ $shareholder->shareholder->name }}</td>
                <td>{{ $shareholder->shareholder->phone }}</td>
                <td>{{ $shareholder->total_amount }}</td>
                <td>{{ $shareholder->shareholder->present_address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>