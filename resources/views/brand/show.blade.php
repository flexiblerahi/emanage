<div class="container mb-3">
    <div class="row">
        <div class="col border-right">
            <div class="row">
                <div class="col-4 font-weight-bold">
                    Name:
                </div>
                <div class="col">
                    {{$brand->name}}
                </div>
            </div>
        </div>
        <div class="col ">
            <div class="row">
                <div class="col-4 font-weight-bold">
                    Created At:
                </div>
                <div class="col">
                    <div>{{$brand->created}}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modules.editor',['editor_header' => 'Entry By'])