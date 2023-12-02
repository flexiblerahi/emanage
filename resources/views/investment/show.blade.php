<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Duration :
                    </div>
                    <div class="col">
                        {{ $investment->duration }} {{ $investment->duration_in }}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Mature Date :
                    </div>
                    <div class="col">
                        {{ matureDate($investment->bank_transaction->date, $investment->duration, $investment->duration_in) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Created At :
                    </div>
                    <div class="col">
                        {{$investment->created}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Updated At :
                    </div>
                    <div class="col">
                        {{$investment->updated}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            @if(!is_null($investment->document))
                <div class="col border-right">
                    <div class="row">
                        <div class="col-4 font-weight-bold">
                            Document :
                        </div>
                        <div class="col">
                            <a href="{{url($investment->document)}}" target="_blank" rel="paid document"><i class="fa fa-file" aria-hidden="true"></i> Pay Proof document</a>
                        </div>
                    </div>
                </div>
            @else 
                <div class="col border-right">
                    <div class="row">
                        <div class="col-3 font-weight-bold">
                            Document :
                        </div>
                        <div class="col">
                            <p class="text-danger">No Entry Yet.</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col ">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Rate :
                    </div>
                    <div class="col">
                        {{ $investment->rate }} %
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    {{-- <div class="card-header"><h5>Investor Information</h5></div> --}}
    @include('modules.header', ['title' => 'Investor Information', 'type' => 'investor_profile'])
    <div class="card-body show"  id="investor_profile">
        <div class="row">
            <div class="col">
                <div class="row mb-3">
                    <div class="col">
                        <div class="row">
                            <div class="col-4 font-weight-bold">Name :</div>
                            <div class="col">{{ $investment->investor->name }}</div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="row">
                            <div class="col-4 font-weight-bold">Account Number:</div>
                            <div class="col">{{ $investment->investor->account_id }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="row">
                            <div class="col-4 font-weight-bold">Phone :</div>
                            <div class="col">{{ $investment->investor->phone }}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-4 font-weight-bold">Emergency :</div>
                            <div class="col">{{ $investment->investor->emergency_contact }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <img src="{{setImage($investment->investor->image)}}" alt="" width="100px" height="100px" srcset="">
                <p><span class="font-weight-bold">Status:</span> @if($investment->investor->status == 0) <span class="text-danger">Deactive</span> @else <span class="text-success">Active</span> @endif</p>
            </div>
        </div>
        
    </div>
</div>
@include('modules.show_bank_transaction', ['bank_transaction' => $investment->bank_transaction])
@include('modules.editor', ['entrier' => $investment->entrier, 'title' => 'Edited by'])