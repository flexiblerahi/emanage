

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
                @if ($requestAll == 'Off')
                    <h6><span class="font-weight-bold"></span> (<span>{{Carbon\Carbon::parse($startDate)->format('d-m-Y')}}</span>@isset($endDate) to <span>{{Carbon\Carbon::parse($endDate)->format('d-m-Y')}}@endisset </span>)</h6>    
                @endif
                
                <p>{{ "Name: ".$referUser['name'].", Account Id: ".$referUser['account_id'].", Mobile: ".$referUser['phone'] }}</p>
                
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
        <table class="table table-bordered" style="font-size: 15px">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Land Info.</th>
                    <th>Customer Info.</th>
                    <th>Deposit Total</th>
                    <th>Commission Type</th>
                    <th>Commission Amount</th>
                    <th>total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $key => $sale)
                    @php
                        list($deposit, 
                            $commissions, 
                            $commission_total, 
                            $deposit_final_total, 
                            $commission_final_total) = $sale->commissionMultiple($sale, $deposit_final_total, $commission_final_total);

                    @endphp
                    <tr>
                        <td rowspan="3">{{ $key + 1 }}</td>
                        <td rowspan="3">
                            <ul>
                                <li><b>Sector : </b>{{ $sale->sector }}</li>
                                <li><b>Block : </b>{{ $sale->block }}</li>
                                <li><b>Road : </b>{{ $sale->road }}</li>
                                <li><b>Plot : </b>{{ $sale->plot }}</li>
                                <li><b>Kata : </b>{{ $sale->kata }}</li>
                            </ul>
                        </td>
                        <td rowspan="3">
                            <ul>
                                <li><b>Name : </b>{{ $sale->customer->name}}</li>
                                <li><b>Phone : </b>{{ $sale->customer->phone}}</li>
                                <li><b>Account Id : </b>{{ $sale->customer->account_id}}</li>
                            </ul>
                        </td>
                        <td rowspan="3">{{tk($deposit)}}</td>
                        <td>Booking Money</td>
                        <td>{{ tk($commissions['booking_money']) }}</td>
                        <td rowspan="3">{{ tk($commission_total) }}</td>
                    </tr>
                    <tr>
                        <td>Down Payment</td>
                        <td>{{ tk($commissions['down_payment']) }}</td>
                    </tr>
                    <tr>
                        <td>Installment</td>
                        <td>{{ tk($commissions['installment']) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td><b>Total Amount:</b></td>
                    <td></td>
                    <td></td>
                    <td>{{ tk($deposit_final_total) }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ tk($commission_final_total) }}</td>
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


