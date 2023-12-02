<!DOCTYPE html>
<html>
<head>
    <title>Agent List</title>
    @include('report.css')
</head>
<body class="pos">
    <div class="row">
        <div class="col-3 text-center">
            <img src="../../img/logo.jpeg" class="img-fluid" style="height: 110px;" alt="">
        </div>
        <div class="col-5 text-center pb-2" >
            <h2>REAL ESTATE</h2>
            <h5>Pushpodhara Properties LTd.</h5>
            <h6>Level 4, Hosaf Tower, Malibag, Dhaka</h6>
        </div>
        <div class="col-4 p-3 align-text-bottom pt-5">
            <h6><span class="font-weight-bold">Report Name :</span> Sale report</h6>
            <h6><span class="font-weight-bold">Date :</span> <span>04/05/2023</span> To <span>02/01/2023</span></h6>
        </div>
    </div>
    <hr>
    <h4 class="pb-2"><u>{{$title}} Information</u> :</h4>
    <p><span class="font-weight-bold pr-4">Name :</span> {{$user->name}} <span style="margin-left: 150px" class=" font-weight-bold pr-4">Phone</span> : {{$user->phone}}</p>
    <p><span class="font-weight-bold pr-4">Account Id :</span> {{$user->account_id}} <span style="margin-left: 140px" class=" font-weight-bold pr-4">Total Katha</span> : {{$sales->sum('kata')}}</p>
    <h4><u class="p-1">Sale's List</u> :</h4>
    <table class="table table-bordered" style="font-size: 15px">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Katha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->customer->name }}</td>
                    <td>{{ $sale->customer->phone }}</td>
                    <td>{{ $sale->kata }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div onclick="window.print()" class="position-absolute bottom-0 end-0 btn btn-outline-secondary">Print</div>
</body>
</html>