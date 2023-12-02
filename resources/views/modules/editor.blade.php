@php
    $user = isset($entrier) ? $entrier : auth()->user()->userdetails;
    $editor_header = isset($editor_title) ? $editor_title : 'Edited by';
@endphp
<div class="card my-2">
    <div class="card-header text-info font-weight-bold ">{{$editor_header}}-</div>
    <div class="card-body">
        <div class="row">
            <div class="col border-right">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Name:
                    </div>
                    <div class="col">
                        {{$user->name}}
                    </div>
                </div>
            </div>
            <div class="col border-right">
                <div class="row">
                    <div class="col-6 font-weight-bold">
                        Account No:
                    </div>
                    <div class="col">
                        {{$user->account_id}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4 font-weight-bold">
                        Phone:
                    </div>
                    <div class="col">
                        {{$user->phone}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>