<div class="row" @isset($parent) id="options-{{$parent->id}}" @endisset>
    <div class="col">
        <div class="form-group">
            @if (isset($parent))
                <label for="">Other {{$parent->title}} Options</label>
                @if(isset($end) && isset($selected))
                    <select class="form-control select2 suboptions" id="optiontitle_{{$parent->id}}" @if($end != $selected) disabled @endif>
                @else
                    <select class="form-control select2 suboptions" id="optiontitle_{{$parent->id}}">
                @endif
            @else
                <label for="">Other Options</label>
                @if(isset($end) && isset($selected))
                    <select class="form-control select2 suboptions" id="optiontitle_0" disabled>
                @else
                    <select class="form-control select2 suboptions" id="optiontitle_0">
                @endif
            @endif
                <option value="">Select an Option</option>
                @if(isset($selected))
                    @foreach ($expenseItems as $expenseItem)
                        <option value="{{$expenseItem->id}}" @selected($expenseItem->id == $selected)>{{$expenseItem->title}}</option>
                    @endforeach
                @else
                    @foreach ($expenseItems as $expenseItem)
                        <option value="{{$expenseItem->id}}" >{{$expenseItem->title}}</option>
                    @endforeach
                @endif
            </select>
            <small>Please select @isset($parent) {{$parent->title}} @endisset for new sub expense</small>
        </div>
    </div>
    @if(isset($parent))
        <div class="col-2">
            <div class="form-group">
                <label for="title_{{$parent->id}}">New {{$parent->title}}</label>
                <br>
                @if(isset($end) && isset($selected))
                    <button type="button" class="btn btn-danger @if($end != $selected) d-none @endif btn-sm removebtn" id="remove-{{$parent->id}}" data-parent="{{$parent->id}}" data-parentSelect={{$previous}} ><i class="fa fa-minus" aria-hidden="true"></i></button>
                @endif
            </div>
        </div>
    @else
        <div class="col-2">
            <div class="form-group">
                <label for="title_x">New Option</label>
                <br>
            </div>
        </div>   
    @endif
</div>