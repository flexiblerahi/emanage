<link rel="stylesheet" href="{{url('css/datepicker.css')}}" type="text/css" />

<style>
    .select2-results__option:hover{
        background-color: #3875d7 !important; 
        color:white !important;
    }
</style>
@include('modules.backbutton')
<form action="{{route('investment.store')}}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row mb-3">
      <div class=" px-0 col">
        @include('modules.header', ['title' => 'Investor Details', 'type' => 'investor'])
        <div class="collapse show border container pt-2" id="investor">
          <div class="row">
            <div class="col">
                <div class="form-group">
                    <input type="text" class="form-control" name="investor_phone" data-user="investor" id="investor_details_phone" list="investor_details_list" placeholder="Search by investor phone number or account number">
                    <datalist id="investor_details_list">
                    </datalist>
                </div>
            </div>    
          </div>
          <div class="card-body" id="investorInfo">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" required placeholder="Investment Amount">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="rate">Rate(In Percentage) %</label>
                <input type="number" class="form-control" name="rate" id="rate" placeholder="Interast Rate">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="duration">Duration</label>
                <input type="number" class="form-control" name="duration" value="1" id="duration" placeholder="Investment Duration Time">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="duration_in">Duration In</label>
                <select class="form-control" name="duration_in" id="duration_in">
                    <option value="months">Month</option>
                    <option value="years">Year</option>
                </select>
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
                <label for="invest_at">Invest At</label>
                <input id="invest_at" type="text" class="form-control date-input bg-white" name="date" value="{{ now()->format('d/m/Y') }}" @readonly(true)/>
                <p class="my-3 d-none" id="mature_date"><span class="font-weight-bold">Mature Date : </span><span id="endDate"></span> </p>
            </div>
        </div>
    </div>
    @include('modules.bank_transaction')
    <button type="submit" class="btn btn-primary btn-block" role="button"> Save</button>
</form>
@push('script')
    <script src="{{url('js/datepicker.js')}}" type="text/javascript"></script>
    <script src="{{url('js/investment.js')}}"></script>
    <script src="{{url('js/banktrans.js')}}"></script>
@endpush