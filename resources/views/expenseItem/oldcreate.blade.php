




@push('style')
    <style>
        .dropdown-submenu {
        position: relative;
        }
        
        .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
        }
        
    </style>
@endpush
<style>
    .select2-results__option:hover{
          background-color: #3875d7 !important; 
          color:white !important;
      }
</style>
@include('modules.backbutton')
<form action="{{route('expense-item.store')}}" method="POST">
    @csrf
    <div class="eachoptions">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Other Options</label>
                    <select class="form-control select2" id="optiontitle_0">
                        <option value="">Select an Option</option>
                        @foreach ($expenseItems as $expenseItem)
                            <option value="{{$expenseItem->id}}">{{$expenseItem->title}}</option>
                        @endforeach
                    </select>
                    <small>Please select for new sub expense</small>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                  <label for="title_0">New Option</label>
                  <textarea class="form-control" name="title-0" id="title_0" cols="1" rows="1"></textarea>
                </div>
            </div>
            <div class="col-3 text-right mt-4">
                <button type="button" class="btn btn-primary" id="addother">Add New Option <i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
        </div>
        <div id="addtags">
    
        </div>
    </div>
   
    <button type="submit" class="btn btn-primary btn-block" role="button"> Save</button>
</form>
<div id="newoptions" class="d-none">
    <div class="child row " >
        <div class="col">
            <div class="form-group">
                <label for="title_0">New Option</label>
                <textarea class="form-control" name="title-0-1" id="title_0" cols="1" rows="1"></textarea>
            </div>
        </div>
        <div class="col-1 mt-4">
            <button  type="button" class="btn btm-sm btn-danger removeoptions"><i class="fa fa-minus" aria-hidden="true"></i></button>
        </div>
    </div>    
</div>

<div id="neweachoptions" class="d-none">
    <div class="eachoptions">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Other Options</label>
                    <select class="form-control select2" id="optiontitle_0">
                        <option value="">Select an Option</option>
                        @foreach ($expenseItems as $expenseItem)
                            <option value="{{$expenseItem->id}}">{{$expenseItem->title}}</option>
                        @endforeach
                    </select>
                    <small>Please select for new sub expense</small>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                  <label for="title_0">New Option</label>
                  <textarea class="form-control" name="title-0" id="title_0" cols="1" rows="1"></textarea>
                </div>
            </div>
            <div class="col-3 text-right mt-4">
                <button type="button" class="btn btn-primary" id="addother">Add New Option <i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
        </div>
        <div id="addtags">
    
        </div>
    </div>
</div>

@push('script')
    <script>
        $('#addother').on('click', function() {
            console.log('alert');
            var clonedChild = $('#newoptions .child').first().clone();

            // Append the cloned child element to the target container
            $('#addtags').append(clonedChild);
        })

        $(document).on('click', '.removeoptions', function() {
            console.log($(this).parent('.child'));
            $(this).closest('.child').remove();

        })

        $(document).on('click', '.remove', function() {
            $(this).closest('.child').remove();
        });
    </script>
@endpush