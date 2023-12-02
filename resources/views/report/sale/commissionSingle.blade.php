

<!DOCTYPE html>
<html>
    <head>
        <title>{{$title}}</title>
        @include('report.css')
    </head>
    <body class="m-2 border p-3">
        <div class="row">
            <div class="col-3 text-center">
                <img src="{{url('img/logo.jpeg')}}" class="img-fluid" style="height: 110px;" alt="">
            </div>
            <div class="col-6 text-center pb-2" >
                <h2>Pushpodhara Properties Ltd.</h2>
                <h6>Level 4, Hosaf Tower, Malibag, Dhaka</h6>
                {!! html_entity_decode($heading) !!}
                    <h6><span class="font-weight-bold"></span> (<span>{{Carbon\Carbon::parse($startDate)->format('d-m-Y')}}</span>@isset($endDate) to <span>{{Carbon\Carbon::parse($endDate)->format('d-m-Y')}}@endisset </span>)</h6>    
                
                
                @if ($requestRole != 'customer')
                    <p>{{ "Name: ".$referUser['name'].", Account Id: ".$referUser['account_id'].", Mobile: ".$referUser['phone'] }}</p>
                @endif
            </div>
            <div class="col-3 p-3 align-text-bottom text-center">
                <h6><span class="font-weight-bold">Report Generation Time </span></h6>
                <h6>{{now()->format('d-m-Y h:i a')}}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <a class="btn btn-primary" href="{{url()->previous()}}">Back</a>
                <div id="print" class="btn btn-primary">Print</div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <h4>Customer Information</h4>
                <ul>
                    <li><b>Name: </b>{{ $sale['customer']['name'] }}</li>
                    <li><b>Account Id:</b> {{ $sale['customer']['account_id'] }}</li>
                    <li><b>Mobile No:</b>{{ $sale['customer']['phone'] }}</li>
                </ul>
            </div>
            <div class="col">
                <h4>Land Information</h4>
                <ul>
                    <li><b>Price:</b> {{$sale['price']}}</li>
                    <li><b>Sector:</b> {{$sale['sector']}}</li>
                    <li><b>Block:</b> {{$sale['block']}}</li>
                    <li><b>Road:</b> {{$sale['road']}}</li>
                    <li><b>Plot:</b> {{$sale['plot']}}</li>
                    <li><b>Katha:</b> {{$sale['kata']}}</li>
                </ul>
            </div>
        </div>
        <table class="table table-bordered" style="font-size: 15px">
            <thead>
                <tr>
                    <th>Transaction Date</th>
                    <th>Pay of month</th>
                    <th>Deposit Amount</th>
                    <th>Deposit Type</th>
                    <th>h1</th>
                    <th>h2</th>
                    <th>h3</th>
                    <th>Master Agent</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    @php
                        list($commission, $total, $total_col) = $payment->commissionDistribution($payment, $total_col);
                    @endphp
                    <tr>
                        <td>{{ Carbon\Carbon::parse($payment->bank_transaction->date)->format('d-m-Y') }}</td>
                        <td>{{ $payment->bank_transaction->other }}</td>
                        <td>{{ tk($payment->bank_transaction->amount) }}</td>
                        <td>{{ $payment->payment_type }}</td>
                        <td>{{ tk($commission['hand_1']) }}</td>
                        <td>{{ tk($commission['hand_2']) }}</td>
                        <td>{{ tk($commission['hand_3']) }}</td>
                        <td>{{ tk($commission['shareholder']) }}</td>
                        <td>{{ tk($total) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>{{ tk($total_col['total_deposit_amount']) }}</td>
                    <td>-</td>
                    <td>{{ tk($total_col['total_hand_1']) }}</td>
                    <td>{{ tk($total_col['total_hand_2']) }}</td>
                    <td>{{ tk($total_col['total_hand_3']) }}</td>
                    <td>{{ tk($total_col['total_shareholder']) }}</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
        
        <script src="{{url('js/jquery.min.js')}}"></script>
        <script>
            $('#print').on('click', function () {
                $('.btn').addClass('d-none');
                window.print();
                $('.btn').removeClass('d-none');
            });
        </script>
    </body>
</html>


