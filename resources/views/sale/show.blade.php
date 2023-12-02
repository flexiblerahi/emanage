
<div class="card">
    {{-- <div class="card-header"><h5>CUSTOMER INFORMATION</h5></div> --}}
    @include('modules.header', ['title' => 'CUSTOMER INFORMATION'])
    <div class="card-body">
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Name:</div>
                    <div class="col">{{$sale->customer->name}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Phone:</div>
                    <div class="col">{{$sale->customer->phone}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Occupation:</div>
                    <div class="col">{{$sale->customer->occupation}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Status:</div>
                    <div class="col">{!! setStatus($sale->customer->status) !!}</div>                   
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Emergency Contact:</div>
                    <div class="col">{{$sale->customer->emergency_contact}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Account Id:</div>
                    <div class="col">{{$sale->customer->account_id}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Present Address:</div>
                    <div class="col">{{$sale->customer->present_address}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Permanent Address:</div>
                    <div class="col">{{$sale->customer->permanent_address}}</div>
                </div>
            </div>
        </div>
    </div>
    @include('modules.header', ['title' => 'REFERENCE INFORMATION'])
    <div class="card-body">
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Name:</div>
                    <div class="col">{{$user->name}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Phone:</div>
                    <div class="col">{{$user->phone}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Occupation:</div>
                    <div class="col">{{$user->occupation}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Status:</div>
                    <div class="col">{!! setStatus($user->status) !!}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Emergency:</div>
                    <div class="col">{{$user->emergency_contact}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Account Id:</div>
                    <div class="col">{{$user->account_id}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Total Katha:</div>
                    <div class="col">{{$user->total_kata}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Role:</div>
                    <div class="col">{{$user->role_name}}</div>
                </div>
            </div>
        </div>
    </div>
    @include('modules.header', ['title' => 'COMMISION'])

    <div class="mt-3">
        @include('sale.commission')
    </div>
    @include('modules.header', ['title' => 'DESCRIPTION OF LAND'])
    <div class="card-body">
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Price:</div>
                    <div class="col">{{$sale->price}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Sector:</div>
                    <div class="col">{{$sale->sector}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Block:</div>
                    <div class="col">{{$sale->block}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Road:</div>
                    <div class="col">{{$sale->road}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Plot:</div>
                    <div class="col">{{$sale->plot}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Katha:</div>
                    <div class="col">{{$sale->kata}}</div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Sale date:</div>
                    <div class="col">{{$sale->date}}</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">Sale Type:</div>
                    <div class="col">{{$sale->type}}</div>
                </div>
            </div>
        </div>
    </div>
</div>