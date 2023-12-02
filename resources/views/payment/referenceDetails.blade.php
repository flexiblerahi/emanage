<div class="row pb-2">
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
            <div class="text-info col-4 font-weight-bold">
                Emergency:
            </div>
            <div class="col">
                {{$user->emergency_contact}}
            </div>
        </div>
    </div>
    <div class="col ">
        <div class="row">
            <div class="text-info col-3 font-weight-bold">
                Role:
            </div>
            <div class="col">
                {{ucfirst($user->role_name)}}
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row mt-2">
    <div class="col border-right">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="name" >Present Address:</label >
            <p class="customer_info">{{$user->present_address}}</p>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="name" >Permanent Address:</label >
            <p class="customer_info">{{$user->permanent_address}}</p>
        </div>
    </div>
</div>