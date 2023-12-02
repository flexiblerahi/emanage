<link rel="stylesheet" href="{{url('css/datepicker.css')}}" type="text/css" />
@include('modules.backbutton', ['previous' => route('deposit-other.index')])

<form action="{{route('deposit-other.update', $depositOther->id)}}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('put')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{$depositOther->bank_transaction->amount}}" required placeholder="Deposit Amount">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="document">Legal Document @if(!is_null($depositOther->document))<span><a target="_blank" href="{{url($depositOther->document)}}">Prof Document</a></span> @endif</label>
                <input type="file" class="form-control" name="document" id="document" placeholder="document">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="date">Deposit At</label>
                <input id="date" type="text" class="form-control date-input bg-white" name="date" value="{{ getdateformat($depositOther->bank_transaction->date) }}" @readonly(true)/>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="other_deposit">Other Information</label>
          <textarea class="form-control" name="other_deposit" id="other_deposit" rows="3" placeholder="Other Deposit information if needed can be store here.">{{$depositOther->other}}</textarea>
        </div>
      </div>
    </div>
    @include('modules.edit_bank_transaction', ['model' => $depositOther])
    @include('modules.editor')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Comment</label>
                <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Please enter comment that why need to update this section."></textarea>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block" role="button"> Update</button>
</form>
@push('script')
    <script src="{{url('js/datepicker.js')}}" type="text/javascript"></script>
    <script src="{{url('js/banktrans.js')}}"></script>
    <script>
      $(document).ready(function () {
        $('#date').datepicker({ format: "dd/mm/yyyy" });
      });
    </script>
@endpush