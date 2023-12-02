
<!DOCTYPE html>
<html>
    <head>
        <title>{{$title}}</title>
        @include('report.css')
    </head>

    <body class="m-2 p-3">
        @include('report.heading')
        <hr>    
        <div class="card mb-3 col-7">
            <div class="card-header bg-light p-2 px-3">
                <div class="row">
                    <div class="col"><h5 class=" font-weight-bold pt-1 pl-2">Initial balance of date:</h5></div>
                </div>  
            </div>
            <div class="card-body">
                <table class="table table-bordered" style="font-size: 15px">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($initialAmounts as $item)
                            <tr>
                                @if ($item['bank_name_id'] == App\Models\BankName::CASH)
                                    <td>{{ $item['bank_name'] }}</td>
                                @else
                                    <td>{{ $item['bank_name'] . '(' . $item['account_id'] . ')' }}</td>
                                @endif
                                
                                <td class="text-right">{{ tk($item['amount']) }}</td>
                            </tr>    
                        @endforeach
                       
                        <tr>
                            <td>Total</td>
                            <td class="text-right">{{ tk($totalInitialAmounts) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header bg-light p-2 px-3">
                <div class="row">
                    <div class="col"><h5 class=" font-weight-bold pt-1 pl-2">Transactions List:</h5></div>
                </div>  
            </div>
            <div class="card-body">
                <table class="table table-bordered" style="font-size: 15px">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Date</th>
                            <th>Sector</th>
                            <th>Account</th>
                            <th>Before Balance</th>
                            <th>Amount</th>
                            <th>After Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bankTransactions as $bank_transaction)
                            @php
                                list($closingAmounts, $beforeBalance, $afterBalance, $sl, $initialAmounts) = $bank_transaction->allTransaction($bank_transaction, $closingAmounts, $initialAmounts, $sl);
                            @endphp
                            <tr>
                                <td>{{ $sl }}</td>
                                <td>{{ $bank_transaction->custom_date }}</td>
                                <td>{{ $bank_transaction->sector }}</td>
                                @if ($bank_transaction->bank_info->bank_name_id == App\Models\BankName::CASH)
                                    <td>{{ $bank_transaction->bank_info->bankname->name }}</td>
                                @else
                                    <td>{{ $bank_transaction->bank_info->account_id. ' ('.$bank_transaction->bank_info->bankname->name.')' }}</td>
                                @endif
                                
                                <td>{{ tk($beforeBalance) }}</td>
                                <td>{{ tk($bank_transaction->amount) }}</td>
                                <td>{{ tk($afterBalance) }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header bg-light p-2 px-3">
                <div class="row">
                    <div class="col"><h5 class=" font-weight-bold pt-1 pl-2">Closing balance of date:</h5></div>
                </div>  
            </div>
            <div class="card-body">
                <table class="table table-bordered" style="font-size: 15px">
                    <thead>
                        <tr>
                            <th>Account</th>
                            <th>IN</th>
                            <th>OUT</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($bankTransactions) < 1)
                            <tr>
                                <td colspan="4">Not found...</td>
                            </tr>
                        @else
                            @foreach ($closingAmounts as $closing_bank_id => $closing)
                                @php
                                    $totalClosingAmount['in'] = $totalClosingAmount['in'] + $closing['in'];
                                    $totalClosingAmount['out'] = $totalClosingAmount['out'] + $closing['out'];
                                   
                                    
                                    $balance = $closing['in'] + $closing['out'];
                                    $balance = $balance + $beginingAmounts[$closing_bank_id]['amount'];
                                    $totalClosingAmount['balance'] =  $totalClosingAmount['balance'] + $balance;
                                @endphp
                                <tr>
                                    @if ($closing['bank_name_id'] == App\Models\BankName::CASH)
                                        <td>{{ $closing['bank_name'] }}</td>
                                    @else
                                        <td>{{ $closing['bank_name']  . '(' . $closing['account_id'] . ')' }}</td>
                                    @endif
                                    
                                    <td class="text-right">@if(!empty($closing['in'])) {{ tk($closing['in']) }} @else {{ tk(0) }} @endif</td>
                                    <td class="text-right">@if(!empty($closing['out'])) {{ tk(abs($closing['out'])) }} @else {{ tk(0) }} @endif</td>
                                    <td class="text-right">@if(!empty($balance)) {{ tk($balance) }} @else {{ tk(0) }} @endif</td>
                                </tr>
                            @endforeach
                        @endif
                        
                        <tr>
                            <td>Total</td>
                            <td class="text-right">{{ tk($totalClosingAmount['in']) }}</td>
                            <td class="text-right">{{ tk(abs($totalClosingAmount['out'])) }}</td>
                            <td class="text-right">{{ tk($totalClosingAmount['balance']) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>