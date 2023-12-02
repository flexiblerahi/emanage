    
<div class="card">
    <div class="card-header"><h5>Transaction Information</h5></div>
    <div class="card-body">
        {{--  --}}
        @php
            $bank_name = $depositother->bank_transaction->bank_info->bankname->name;
        @endphp
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Bank Name:</div>
                    <div class="col">{{ $bank_name }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Amount:</div>
                    <div class="col">{{ $depositother->bank_transaction->amount }}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Account Id:</div>
                    <div class="col">{{ $depositother->bank_transaction->bank_info->account_id }}</div>
                </div>
            </div>
            @if ($bank_name == 'Cash')
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Deposit At:</div>
                    <div class="col">{{ $depositother->bank_transaction->date }}</div>
                </div>
            </div>
                
            @else
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Transaction Number:</div>
                    <div class="col">{{ $depositother->bank_transaction->trx_no }}</div>
                </div>
            </div>
            @endif
            
        </div>
        @if ($bank_name != 'Cash')
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Deposit By:</div>
                    <div class="col">{{ ucfirst($depositother->bank_transaction->transactionby) }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Deposit At:</div>
                    <div class="col">{{ $depositother->bank_transaction->date }}</div>
                </div>
            </div>
        </div>
        @endif
        @if (!is_null($depositother->comment))
            <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <div class="col-4 font-weight-bold">Updated At:</div>
                        <div class="col">{{ $depositother->updated }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-4 font-weight-bold">Comment:</div>
                        <div class="col">{{ $depositother->comment }}</div>
                    </div>
                </div>
            </div>
        @endif
        {{--  --}}
    </div>
</div>
<div class="card">
    <div class="card-header"><h5>Other Information</h5></div>
    <div class="card-body">
        {{--  --}}
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Created At:</div>
                    <div class="col">{{ $depositother->created }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Entrier Name:</div>
                    <div class="col">{{ $depositother->entrier->name }}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Entrier Phone:</div>
                    <div class="col">{{ $depositother->entrier->phone }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Account No:</div>
                    <div class="col">{{ $depositother->entrier->account_id }}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Entrier Emergency:</div>
                    <div class="col">{!! emergencyContact($depositother->entrier->emergency_contact) !!}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Investment Created:</div>
                    <div class="col">{{ $depositother->created }}</div>
                </div>
            </div>
        </div>
        @if (!is_null($depositother->comment))
            <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <div class="col-4 font-weight-bold">Updated At:</div>
                        <div class="col">{{ $depositother->updated }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-4 font-weight-bold">Comment:</div>
                        <div class="col">{{ $depositother->comment }}</div>
                    </div>
                </div>
            </div>
        @endif
        {{--  --}}
    </div>
</div>