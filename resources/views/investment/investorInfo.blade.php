<input type="hidden" name="investor_id" value="{{$investor->id}}">
<div class="row">
    <div class="col">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="name">Name: </label>
            <span>{{$investor->name}}</span>
        </div>
    </div>
    <hr>
    <div class="col">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="occupation">Current Balance: </label>
            <span class="investor_info" id="investor_balance">{{tk($investor->income)}}</span>
        </div>
    </div>
   
</div>
<hr>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="phone">Phone: </label>
            <span >{{$investor->phone}}</span>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="phone">Account No.: </label>
            <span >{{$investor->account_id}}</span>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="name">Present Address</label>
            <p class="investor_info">{{$investor->present_address}}</p>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="occupation">Permanent Address</label>
            <p class="investor_info" id="investor_permanent_address">{{$investor->permanent_address}}</p>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="occupation">Occcupation: </label>
            <span>{{$investor->occupation_name}}</span>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="occupation">Status: </label>
            <span class="investor_info" id="status">{{($investor->status == 1) ? 'ACTIVE' : 'DEACTIVE'}}</span>
        </div>
    </div>
</div>