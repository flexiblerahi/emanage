<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Created At:
                    </div>
                    <div class="col">
                        {{$withdraw->created}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Updated At:
                    </div>
                    <div class="col">
                        {{$withdraw->updated}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('withdraw.userInfo', ['user' => $withdraw->user])
@include('modules.show_bank_transaction', ['bank_transaction' => $withdraw->bank_transaction])
@include('modules.editor', ['entrier' => $withdraw->entrier, 'title' => 'Edited by'])