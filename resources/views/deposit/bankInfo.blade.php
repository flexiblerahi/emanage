<input type="hidden" name="bank_infos_id" value="{{$bank_info->id}}">
<input type="hidden" name="status" value="cashin"/>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="trx_num">Transaction Number</label>
            <input type="text" class="form-control" name="trx_num" id="trx_num" value="@isset($transaction) {{ $transaction->trx_no }} @endisset" placeholder="Transaction Serial Number">
        </div>
    </div>
    <div class="col">
        @php
            $bys = ['Cash', 'Online Transfer', 'Check'];
        @endphp
        <div class="form-group">
          <label for="trx_by">Transaction By</label>
          <select class="form-control" name="trx_by" id="trx_by">
            <option value="">Please Select</option>
            @foreach ($bys as $key => $by)
                <option value="{{$key}}" @isset($transaction) @selected($key == $transaction->trx_by) @endisset>{{$by}}</option>
            @endforeach
          </select>
        </div>
    </div>
</div>
<div class="col-12 mb-2 px-0">
    <div class="card">
        <div class="card-header p-2 m-0">
            <p class="investor_info m-0 ml-2"><span class="text-info font-weight-bold">Name: </span>{{$bank_info->bankname->name}}</p>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col border-right">
                    <div class="form-group">
                        <label class="text-info font-weight-bold" for="phone">Entry By:</label>
                        <p class="investor_info"><span class="font-weight-bold">Name : </span> {{$bank_info->entrier->name}}</p>
                        <p class="investor_info"><span class="font-weight-bold">Account Number : </span>{{$bank_info->entrier->account_id}}</p>
                        <p class="investor_info"><span class="font-weight-bold">Phone : </span>{{$bank_info->entrier->phone}}</p>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="text-info font-weight-bold" for="occupation">Bank Details:</label>
                        <p class="investor_info">{{$bank_info->address}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>