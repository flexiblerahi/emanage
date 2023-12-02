<link rel="stylesheet" href="{{url('css/datepicker.css')}}" type="text/css" />
<style>
  .select2-results__option:hover{
      background-color: #3875d7 !important; 
      color:white !important;
  }
</style>
@include('modules.backbutton', ['previous' => route('deposit-other.index')])
<form action="{{route('deposit-other.store')}}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" required placeholder="Deposit Amount">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="document">Legal Document</label>
                <input type="file" class="form-control" name="document" id="document" placeholder="document">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="date">Deposit At</label>
                <input id="date" type="text" class="form-control date-input bg-white" name="date" value="{{ now()->format('d/m/Y') }}" @readonly(true)/>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="other_deposit">Other Information</label>
          <textarea class="form-control" name="other_deposit" id="other_deposit" rows="3" placeholder="Other Deposit information if needed can be store here."></textarea>
        </div>
      </div>
    </div>
    @include('modules.bank_transaction')
    <button type="submit" class="btn btn-primary btn-block" role="button"> Save</button>
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