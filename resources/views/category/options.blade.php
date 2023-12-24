<div class="row" @isset($parent) id="options-{{$parent->id}}" @endisset>
    <div class="col">
        <div class="form-group">
            @if (isset($parent))
                <label for="">Other {{$parent->name}} Options</label>
                <select class="form-control select2 suboptions" id="optionname_{{$parent->id}}">
            @else
                <label for="">Other Options</label>
                <select class="form-control select2 suboptions" id="optionname_0">
            @endif
                <option value="">Select an Option</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" >{{$category->name}}</option>
                @endforeach
            </select>
            <small>Please select @isset($parent) {{$parent->name}} @endisset for new sub category</small>
        </div>
    </div>
    @if(isset($parent))
        <div class="col-2">
            <div class="form-group">
                <label for="name_{{$parent->id}}">New {{$parent->name}}</label>
                <br>
                @if(!$edit)
                    <button type="button" class="btn btn-primary btn-sm addnewbtn" data-parent="{{$parent->id}}" data-toggle="modal" data-target="#addnew"><i class="text-white fa fa-plus" aria-hidden="true"></i></button>
                @endif
                <button type="button" class="btn btn-danger btn-sm removebtn" id="remove-{{$parent->id}}" data-parent="{{$parent->id}}"><i class="text-white fa fa-minus" aria-hidden="true"></i></button>
            </div>
        </div>
    @else
        <div class="col-2">
            <div class="form-group">
                <label for="name_x">New Option</label>
                <br>
                <button type="button" class="btn btn-primary btn-sm addnewbtn" data-parent="0" data-toggle="modal" data-target="#addnew"><i class="text-white fa fa-plus" aria-hidden="true"></i></button>
            </div>
        </div>   
    @endif
</div>