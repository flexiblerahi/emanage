<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Created At :
                    </div>
                    <div class="col">
                        {{$depositother->created}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Updated At :
                    </div>
                    <div class="col">
                        {{$depositother->updated}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            @if(!is_null($depositother->document))
                <div class="col">
                    <div class="row">
                        <div class="col-2 font-weight-bold">
                            Document :
                        </div>
                        <div class="col">
                            <a href="{{url($depositother->document)}}" target="_blank" rel="paid document"><i class="fa fa-file" aria-hidden="true"></i> Pay Proof document</a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="row">
                    <div class="col-2 font-weight-bold">
                        Other Info. :
                    </div>
                    <div class="col">
                        {!! emergencyContact($depositother->other) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modules.show_bank_transaction', ['bank_transaction' => $depositother->bank_transaction])
@include('modules.editor', ['entrier' => $depositother->entrier])