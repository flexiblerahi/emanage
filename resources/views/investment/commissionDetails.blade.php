<div class="card mb-2">
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
                            <div class="col-4 font-weight-bold">Phone :</div>
                            <div class="col">{{ $investment->investor->phone }}</div>
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
@include('modules.show_bank_transaction', ['bank_transaction' => $investment->investment->bank_transaction])