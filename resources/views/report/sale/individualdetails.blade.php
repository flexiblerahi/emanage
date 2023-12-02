<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
    @include('report.css')
</head>
<body class="m-2 p-3">
    @include('report.heading')
    
<div class="card">
    <div class="card-header bg-light p-2 px-3">
        <div class="row">
            <div class="col"><h5 class=" font-weight-bold pt-1 pl-2">DESCRIPTION OF LAND</h5></div>
        </div>  
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Price:</div>
                    <div class="col">{{$sale->price}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Sector:</div>
                    <div class="col">{{$sale->sector}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Block:</div>
                    <div class="col">{{$sale->block}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Road:</div>
                    <div class="col">{{$sale->road}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Plot:</div>
                    <div class="col">{{$sale->plot}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Katha:</div>
                    <div class="col">{{$sale->kata}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Sale date:</div>
                    <div class="col">{{$sale->date}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Sale Type:</div>
                    <div class="col">{{$sale->type}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-light p-2 px-3">
        <div class="row">
            <div class="col"><h5 class=" font-weight-bold pt-1 pl-2">CUSTOMER INFORMATION</h5></div>
        </div>  
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Name:</div>
                    <div class="col">{{$sale->customer->name}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Phone:</div>
                    <div class="col">{{$sale->customer->phone}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Occupation:</div>
                    <div class="col">{{$sale->customer->occupation}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Status:</div>
                    <div class="col">{!! setStatus($user->status) !!}</div>                   
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Emergency Contact:</div>
                    <div class="col">{{$sale->customer->emergency_contact}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Account Id:</div>
                    <div class="col">{{$sale->customer->account_id}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Present Address:</div>
                    <div class="col">{{$sale->customer->present_address}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Permanent Address:</div>
                    <div class="col">{{$sale->customer->permanent_address}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-light p-2 px-3">
        <div class="row">
            <div class="col"><h5 class=" font-weight-bold pt-1 pl-2">COMMISION</h5></div>
        </div>  
    </div>
    <div class="mt-3">
        @include('sale.commission')
    </div>
</div>
<div style="page-break-after: always;">
    <!-- Content that should start on a new page -->
</div>
<table class="table table-bordered" style="font-size: 15px">
    <thead>
        <tr>
            <th>Sl.</th>
            <th>Date</th>
            <th>Payment Type</th>
            <th>Amount</th>
            <th>Hand 1</th>
            <th>Hand 3</th>
            <th>Hand 2</th>
            <th>Master Agent</th>
            <th>Company</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            @php
                $users[$payment->commission_type.'_amount'] = (int) $users[$payment->commission_type.'_amount'] + (int) $payment->bank_transaction->amount;
                $sl = $sl + 1;
                $commission = $payment->commission_col;
                $transactions = $payment->transactions;

                $shareholderExists = $commission->where('hand', 'shareholder')->first();
                $shareholderAmount = $transactions->where('user_details_id', $shareholderExists->account_id)->first();
                $users[$payment->commission_type.'_shareholder'] = (int) $users[$payment->commission_type.'_shareholder'] + (int) $shareholderAmount->amount;

                $managerExists = $commission->where('hand', 'general_manager')->first();
                $managerAmount = $transactions->where('user_details_id', $managerExists->account_id)->first();
                $users[$payment->commission_type.'_company'] = (int) $users[$payment->commission_type.'_company'] + (int) $managerAmount->amount;
            @endphp
            <tr>
                <td>{{ $sl }}</td>
                <td>{{ $payment->created }}</td>
                <td>{{ $payment->payment_type }}</td>
                <td class="text-right">{{ tk($payment->bank_transaction->amount) }}</td>
                @foreach (range(1,3) as $item)
                    @php
                        $handexists = $commission->where('hand', 'hand_'.$item)->first();
                    @endphp
                    @if (empty($handexists))
                        <td>-</td>
                    @else
                        @php
                            $transactionAmount = $transactions->where('user_details_id', $handexists->account_id)->first();
                            $users[$payment->commission_type.'_hand_'.$item] = $users[$payment->commission_type.'_hand_'.$item] + (int) $transactionAmount->amount;
                        @endphp
                        <td class="text-right">{{ tk($transactionAmount->amount) }}</td>
                    @endif
                @endforeach
                <td class="text-right">
                    @if (!empty($shareholderAmount))
                        {{ tk($shareholderAmount->amount) }}
                    @endif
                </td>
                <td class="text-right">
                    @if (!empty($managerAmount))
                        {{ tk($managerAmount->amount) }}
                    @endif
                </td>
            </tr>
        @endforeach
        <tr>
            <td>Total</td>
            <td>-</td>
            <td class="text-right">
                @foreach ($commission_names as $item)
                    {{ $item }}<br>    
                @endforeach
            </td>
            
            <td class="text-right">
                @foreach ($commission_names as $key => $name)
                    @php
                        $users['amount_total'] = $users['amount_total'] + (int) $users[$key.'_amount'];
                    @endphp
                    {{ tk($users[$key.'_amount']) }}<br>    
                @endforeach
            </td>
            <td class="text-right">
                @foreach ($commission_names as $key => $name)
                    @php
                        $users['hand_1_total'] = $users['hand_1_total'] + (int) $users[$key.'_hand_1'];
                    @endphp
                    {{ tk($users[$key.'_hand_1']) }}<br>    
                @endforeach
            </td>
            <td class="text-right">
                @foreach ($commission_names as $key => $name)
                    @php
                        $users['hand_2_total'] = $users['hand_2_total'] + (int) $users[$key.'_hand_2'];
                    @endphp
                    {{ tk($users[$key.'_hand_2']) }}<br>    
                @endforeach
            </td>
            <td class="text-right">
                @foreach ($commission_names as $key => $name)
                    @php
                        $users['hand_3_total'] = $users['hand_3_total'] + (int) $users[$key.'_hand_3'];
                    @endphp
                    {{ tk($users[$key.'_hand_3']) }}<br>    
                @endforeach
            </td>
            <td class="text-right">
                @foreach ($commission_names as $key => $name)
                    @php
                        $users['shareholder_total'] = $users['shareholder_total'] + (int) $users[$key.'_shareholder'];
                    @endphp
                    {{ tk($users[$key.'_shareholder']) }}<br>    
                @endforeach
            </td>
            <td class="text-right">
                @foreach ($commission_names as $key => $name)
                    @php
                        $users['company_total'] = $users['company_total'] + (int) $users[$key.'_company'];
                    @endphp
                    {{ tk($users[$key.'_company']) }}<br>    
                @endforeach
            </td>
        </tr>

        <tr>
            <td></td>
            <td>-</td>
            <td>
                Total
            </td>
            <td class="text-right">{{ tk($users['amount_total']) }}</td>
            <td class="text-right">{{ tk($users['hand_1_total']) }}</td>
            <td class="text-right">{{ tk($users['hand_2_total']) }}</td>
            <td class="text-right">{{ tk($users['hand_3_total']) }}</td>
            <td class="text-right">{{ tk($users['shareholder_total']) }}</td>
            <td class="text-right">{{ tk($users['company_total']) }}</td>
        </tr>
    </tbody>
</table>
</body>
</html>
