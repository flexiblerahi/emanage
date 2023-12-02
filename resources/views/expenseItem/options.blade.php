<div class="row" @isset($parent) id="options-{{$parent->id}}" @endisset>
    <div class="col">
        <div class="form-group">
            @if (isset($parent))
                <label for="">Other {{$parent->title}} Options</label>
                <select class="form-control select2 suboptions" id="optiontitle_{{$parent->id}}">
            @else
                <label for="">Other Options</label>
                <select class="form-control select2 suboptions" id="optiontitle_0">
            @endif
                <option value="">Select an Option</option>
                @foreach ($expenseItems as $expenseItem)
                    <option value="{{$expenseItem->id}}" >{{$expenseItem->title}}</option>
                @endforeach
            </select>
            <small>Please select @isset($parent) {{$parent->title}} @endisset for new sub expense</small>
        </div>
    </div>
    @if(isset($parent))
        <div class="col-2">
            <div class="form-group">
                <label for="title_{{$parent->id}}">New {{$parent->title}}</label>
                <br>
                @if(!$edit)
                    <button type="button" class="btn btn-primary btn-sm addnewbtn" data-parent="{{$parent->id}}" data-toggle="modal" data-target="#addnew"><i class="fa fa-plus" aria-hidden="true"></i></button>
                @endif
                <button type="button" class="btn btn-danger btn-sm removebtn" id="remove-{{$parent->id}}" data-parent="{{$parent->id}}"><i class="fa fa-minus" aria-hidden="true"></i></button>
            </div>
        </div>
    @else
        <div class="col-2">
            <div class="form-group">
                <label for="title_x">New Option</label>
                <br>
                <button type="button" class="btn btn-primary btn-sm addnewbtn" data-parent="0" data-toggle="modal" data-target="#addnew"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
        </div>   
    @endif
</div>