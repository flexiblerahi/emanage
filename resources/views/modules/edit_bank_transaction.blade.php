<style>
    .select2-results__option:hover{
          background-color: #3875d7 !important; 
          color:white !important;
      }
</style>

<div class="my-2">
    <div class="payment">
        @include('modules.header', ['title' => 'Bank Transaction Details', 'type' => 'bank_trasaction'])
        <div class="p-2 border show collapse" id="bank_trasaction">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="bank_type">Bank Name</label>
                        <select class="form-control select2" name="bank_type" id="bank_type">
                            <option value="" selected>Select Bank Please</option>
                            @foreach ($bankNames as $bankName)
                                <option value="{{ $bankName->id }}" @selected($bankName->id == $model->bank_transaction->bank_info->bankname->id)>{{ $bankName->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="account_number">Bank Account</label>
                        <select class="form-control select2" @if($model->bank_transaction->bank_info->bankname->id == 1) disabled @endif name="account_number" id="account_number">
                            <option value="" selected>Select Account Number</option>
                            @foreach ($bankInfos as $info)
                                <option value="{{$info->id}}" @selected($info->id == $model->bank_transaction->bank_info_id)>{{ $info->account_id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12" id="bankInfo">
                    @include('investment.bankInfo', [ 'bank_info' => $model->bank_transaction->bank_info, 'transaction' => $model->bank_transaction ])
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="other">Month of payment/ Other</label>
                        <textarea class="form-control" name="other" id="other" rows="2" placeholder="Bank any-other information if needed can be store here.">{{ $model->bank_transaction->other }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>