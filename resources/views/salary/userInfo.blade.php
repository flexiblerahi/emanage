<input type="hidden" name="user_id" value={{$user->id}}>
<div class=" my-2">
    <div>
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="text-info col-3 font-weight-bold">
                        Name:
                    </div>
                    <div class="col">
                        {{$user->name}}
                    </div>
                </div>
            </div>
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
            <div class="col">
                <div class="row">
                    <div class="text-info col-6 font-weight-bold">
                        Account Number:
                    </div>
                    <div class="col">
                        {{$user->account_id}}
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="text-info col-4 font-weight-bold">
                        Phone:
                    </div>
                    <div class="col">
                        {{$user->phone}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="text-info col-5 font-weight-bold">
                        Emergency Contact:
                    </div>
                    <div class="col">
                        {!! emergencyContact($user->emergency_contact) !!}
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col border-right">
                <div class="form-group">
                    <label class="text-info font-weight-bold" for="name">Present Address:</label>
                    {!! emergencyContact($user->present_address) !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="text-info font-weight-bold" for="name">Permanent Address:</label>
                    {!! emergencyContact($user->permanent_address) !!}
                </div>
            </div>
        </div>
    </div>
</div>