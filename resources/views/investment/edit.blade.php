<link rel="stylesheet" href="{{url('css/datepicker.css')}}" type="text/css" />
@include('modules.backbutton')
<form action="{{route('investment.update', $investment->id)}}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <div class=" px-0 col">
            @include('modules.header', ['title' => 'Investor Details', 'type' => 'investor'])
            <div class="collapse show border container pt-2" id="investor">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" value="{{$investment->investor->account_id}}" class="form-control" name="investor_phone" data-user="investor" id="investor_details_phone" list="investor_details_list" placeholder="Search by investor phone number or account number">
                            <datalist id="investor_details_list">
                            </datalist>
                        </div>
                    </div>    
                </div>
                <div class="card-body" id="investorInfo">
                    @include('investment.investorInfo', ['investor' => $investment->investor])
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class=" px-0 col">
            @include('modules.header', ['title' => 'Other Information', 'type' => 'otherinvestmentinfo'])
            <div class="card show p-2" id="otherinvestmentinfo">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" value="{{$investment->bank_transaction->amount}}" required placeholder="Investment Amount">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="rate">Rate(In Percentage) %</label>
                            <input type="number" class="form-control" name="rate" id="rate" placeholder="Interast Rate" value="{{$investment->rate}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="number" class="form-control" name="duration" value="1" id="duration" placeholder="Investment Duration Time" value="{{$investment->duration}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="duration_in">Duration In</label>
                            <select class="form-control" name="duration_in" id="duration_in">
                                <option value="months" @selected($investment->duration_in == "months")>Month</option>
                                <option value="years" @selected($investment->duration_in == "years")>Year</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="document">Legal Document @if (!is_null($investment->document)) (<span><a target="_blank" href="{{url($investment->document)}}"><i class="fa fa-file" aria-hidden="true"></i> Previous Document</a></span>) @endif</label>
                            <input type="file" class="form-control" name="document" id="document" placeholder="document">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="invest_at">Invest At</label>
                            <input id="invest_at" type="text" class="form-control date-input bg-white" name="date" value="{{ getdateformat($investment->invest_at) }}" @readonly(true)/>
                            <p class="my-3 d-none" id="mature_date"><span class="font-weight-bold">Mature Date : </span><span id="endDate"></span> </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @include('modules.checkbox', ['status' => $investment->status])
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>If Status is De-Active then investment commission doesn't work anymore.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class=" px-0 col">
            @include('modules.edit_bank_transaction', ['model' => $investment])
        </div>
    </div>
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
    <script src="{{url('js/investment.js')}}"></script>
    <script src="{{url('js/banktrans.js')}}"></script>
@endpush