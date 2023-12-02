
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
                                <option value="{{$bankName->id}}">{{$bankName->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="account_number">Bank Account</label>
                        <select class="form-control select2" name="account_number" id="account_number">
                            <option value="" selected>Select Account Number</option>
                        </select>
                    </div>
                </div>
                <div class="col-12" id="bankInfo">
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="other">Other</label>
                        <textarea class="form-control" name="other" id="other" rows="2" placeholder="Bank any-other information if needed can be store here."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>