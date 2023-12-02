<input type="hidden" name="customer_phone" value="{{$user->phone}}">
<div class="row p-2">
    <div class="col border-right">
        <div class="row">
            <div class="col-3 font-weight-bold text-info">
                Name:
            </div>
            <div class="col">
                {{$user->name}}
            </div>
        </div>
    </div>
    <div class="col border-right">
        <div class="row">
            <div class="col-3 font-weight-bold text-info">
                Phone:
            </div>
            <div class="col">
                {{$user->phone}}
            </div>
        </div>
    </div>
    <div class="col">
        <div class="row">
            <div class="col-4 font-weight-bold text-info">
                Account:
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
        <div class="form-group">
            <label class="text-info font-weight-bold" >Present Address :</label>
            <p >{{$user->present_address}}</p>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label class="text-info font-weight-bold">Permanent Address :</label>
            <p >{{$user->permanent_address}}</p>
        </div>
    </div>
</div> 
