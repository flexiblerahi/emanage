<div class="card">
    <div class="card-header"><h5>Investor Information</h5></div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="row mb-3">
                    <div class="col">
                        <div class="row">
                            <div class="col-4 font-weight-bold">Name:</div>
                            <div class="col">{{ $investment->investor->name }}</div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="row">
                            <div class="col-4 font-weight-bold">Account Number:</div>
                            <div class="col">{{ $investment->investor->account_id }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="row">
                            <div class="col-4 font-weight-bold">Phone:</div>
                            <div class="col">{{ $investment->investor->phone }}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-4 font-weight-bold">Emergency:</div>
                            <div class="col">{{ $investment->investor->emergency_contact }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <img src="{{setImage($investment->investor->image)}}" alt="" width="100px" height="100px" srcset="">
                <p><span class="font-weight-bold">Status:</span> @if($investment->investor->status == 0) <span class="text-danger">Deactive</span> @else <span class="text-success">Active</span> @endif</p>
            </div>
        </div>
        
    </div>
</div>
<div class="card">
    <div class="card-header"><h5>Transaction Information</h5></div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Bank Name:</div>
                    <div class="col">{{ $investment->bank_transaction->bank_info->name }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Transaction Number:</div>
                    <div class="col">{{ $investment->bank_transaction->trx_no }}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Amount:</div>
                    <div class="col">{{ $investment->bank_transaction->amount }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Rate:</div>
                    <div class="col">{{ $investment->rate }} %</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Deposit By:</div>
                    <div class="col">{{ ucfirst($investment->bank_transaction->method) }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Invest At:</div>
                    <div class="col">{{ $investment->bank_transaction->invested_at }}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Duration:</div>
                    <div class="col">{{ $investment->duration }} {{ $investment->duration_in }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Mature Date:</div>
                    <div class="col">{{ matureDate($investment->bank_transaction->date, $investment->duration, $investment->duration_in) }}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Legal Document:</div>
                    <div class="col"><a target="_blank" href="{{url($investment->document)}}"><i class="fa fa-file" aria-hidden="true"></i> {{filename($investment->document)}}</a></div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Other Info:</div>
                    <div class="col">{{$investment->bank_transaction->other}}</div>
                </div>
            </div>
        </div>
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
                    <div class="col">{{ $investment->created }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Entrier Name:</div>
                    <div class="col">{{ $investment->entrier->name }}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Entrier Phone:</div>
                    <div class="col">{{ $investment->entrier->phone }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Account No:</div>
                    <div class="col">{{ $investment->entrier->account_id }}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Entrier Emergency:</div>
                    <div class="col">{{ $investment->entrier->emergency_contact }}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Investment Created:</div>
                    <div class="col">{{ $investment->created }}</div>
                </div>
            </div>
        </div>
        @if (!is_null($investment->comment))
            <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <div class="col-4 font-weight-bold">Updated At:</div>
                        <div class="col">{{ $investment->updated }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-4 font-weight-bold">Comment:</div>
                        <div class="col">{{ $investment->comment }}</div>
                    </div>
                </div>
            </div>
        @endif
        {{--  --}}
    </div>
</div>

