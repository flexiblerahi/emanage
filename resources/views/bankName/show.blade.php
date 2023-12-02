<div class="container mb-3">
    <div class="row">
        <div class="col border-right">
            <div class="row">
                <div class="col-4 font-weight-bold">
                    Name:
                </div>
                <div class="col">
                    {{$bankName->name}}
                </div>
            </div>
        </div>
        <div class="col border-right">
            <div class="row">
                <div class="col-4 font-weight-bold">
                    Status:
                </div>
                <div class="col">
                    @if ($bankName->status == 1) 
                        <div class="text-success">Active</div>
                    @else
                        <div class="text-danger"> Deactive</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col ">
            <div class="row">
                <div class="col-4 font-weight-bold">
                    Created At:
                </div>
                <div class="col">
                    <div>{{$bankName->created}}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modules.editor',['editor_header' => 'Entry By'])