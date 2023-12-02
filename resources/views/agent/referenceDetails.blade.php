@php
    $user_detail = (isset($user_detail)) ? $user_detail : $users->first();
@endphp
<input type="hidden" id='reference_id' name="reference_id" value="{{$user_detail->id}}">
<div class="card my-2">
    <div class="card-header bg-primary text-white">Name: {{$user_detail->name}}</div>
    <div class="card-body">
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="col-3 font-weight-bold">
                        Role:
                    </div>
                    <div class="col">
                        {{$user_detail->role_name}}
                    </div>
                </div>
            </div>
            <div class="col border-right">
                <div class="row">
                    <div class="col-6 font-weight-bold">
                        Account Number:
                    </div>
                    <div class="col">
                        {{$user_detail->account_id}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Phone:
                    </div>
                    <div class="col">
                        {{$user_detail->phone}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>