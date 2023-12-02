@php
    $button = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBankId"><i class="fa fa-plus" aria-hidden="true"></i> New Bank</button>';
@endphp

<style>
    .select2-results__option:hover{
          background-color: #3875d7 !important; 
          color:white !important;
      }
</style>
@include('modules.backbutton', ['button' => $button])
@include('bankName.modalForm')
<form action="{{route('bank-info.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="bank_name_id">Bank Name</label>
                <select class="form-control select2" name="bank_name_id" id="bank_name_id">
                    <option>Selection Bank Please</option>
                    @foreach ($names as $name)                    
                        <option value="{{$name->id}}">{{$name->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="account_id">Account Id (For Mobile bank: Please provide mobile number)</label>
                <input type="text" class="form-control" name="account_id" id="account_id" placeholder="Account Number" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="address">Bank Details</label>
                <textarea name="address" id="address" cols="5" rows="5" class="form-control"></textarea>
            </div>
        </div>
    </div>
    @include('modules.checkbox', ['status' => 1])
    <button type="submit" class="btn btn-primary btn-block" role="button"> Save</button>
</form>