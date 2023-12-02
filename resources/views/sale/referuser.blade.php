<div class="row border p-2 rounded mx-0">
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
                Role:
            </div>
            <div class="col">
                {{$user->role_name}}
            </div>
        </div>
    </div>
    <div class="col">
        <div class="row">
            <div class="col-5 font-weight-bold text-info">
                Total Katha:
            </div>
            <div class="col">
                {{$user->total_kata}}
            </div>
        </div>
    </div>
</div>