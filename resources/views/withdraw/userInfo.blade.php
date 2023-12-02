<input type="hidden" name="withdraw_user" value={{$user->id}}>
<div class="card my-2">
    @include('modules.header', ['title' => $user->name, 'type' => 'userdetails'])
    <div class="card-body p-3 show" id="userdetails">
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="text-info col-3 font-weight-bold">
                        Role:
                    </div>
                    <div class="col">
                        {{ucfirst($user->role_name)}}
                    </div>
                </div>
            </div>
            <div class="col border-right">
                <div class="row">
                    <div class="text-info col-6 font-weight-bold">
                        Account Number:
                    </div>
                    <div class="col">
                        {{$user->account_id}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="text-info col-4 font-weight-bold">
                        Phone:
                    </div>
                    <div class="col">
                        {{$user->phone}}
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="text-info col-4 font-weight-bold">
                        Amount:
                    </div>
                    <div class="col">
                        <span id="userbalance">{{tk($user->income)}}</span>
                    </div>
                </div>
            </div>
            <div class="col border-right">
                <div class="row">
                    <div class="text-info col-6 font-weight-bold">
                        Total Katha:
                    </div>
                    <div class="col">
                        {{$user->total_kata}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="text-info col-5 font-weight-bold">
                        Emergency:
                    </div>
                    <div class="col">
                        {{$user->emergency_contact}}
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col border-right">
                <div class="form-group">
                    <label class="text-info font-weight-bold" for="name">Present Address:</label>
                    <p id="ag_sh_name">{{$user->present_address}}</p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="text-info font-weight-bold" for="name">Permanent Address:</label>
                    <p id="ag_sh_name">{{$user->permanent_address}}</p>
                </div>
            </div>
        </div>
    </div>
</div>