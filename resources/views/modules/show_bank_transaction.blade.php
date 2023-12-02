<div class="card mb-2">
    @include('modules.header', ['title' => 'Bank Transaction', 'type' => 'banktrx'])
    <div class="card-body show" id="banktrx">
        <div class="row mb-3">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Bank Name :
                    </div>
                    <div class="col">
                        {{ $bank_transaction->bank_info->bankname->name }}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Account Number :
                    </div>
                    <div class="col">
                        {{ $bank_transaction->bank_info->account_id }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Amount :
                    </div>
                    <div class="col">
                        {{ tk(abs($bank_transaction->amount)) }}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Transaction Date :
                    </div>
                    <div class="col">
                        {{ $bank_transaction->custom_date }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Transaction No :
                    </div>
                    <div class="col">
                        {!! emergencyContact($bank_transaction->trx_no) !!}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Transaction By :
                    </div>
                    <div class="col">
                        {{ $bank_transaction->transactionby }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Status :
                    </div>
                    <div class="col">
                        {{ $bank_transaction->custom_status }}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Other Information :
                    </div>
                    <div class="col">
                        {!! emergencyContact($bank_transaction->other) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>