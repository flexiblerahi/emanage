<div class="card-header bg-light p-2 px-3">
    <div class="row">
        <div class="col @if(!isset($type)) text-center @endif"><h5 class="text-info font-weight-bold pt-1 pl-2">{{$title}}</h5></div>
        @isset($type)
            <div class="col text-right">
                @if ($type == 'first')
                    @can('new-customer')
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#customerModel">Create New Customer</button>
                    @endcan
                @endif
                <a class="btn btn-primary sectioncollapse btn-sm" data-toggle="collapse" href="#{{$type}}" aria-expanded="false" aria-controls="{{$type}}"><i class=" fa fa-chevron-up" aria-hidden="true"></i></a>
            </div>
        @endisset 
    </div>  
</div>