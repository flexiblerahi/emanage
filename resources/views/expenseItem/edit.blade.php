<form method="post" data-link="{{route('expense-item.update', $expenseItem->id)}}" id="onSubmit">
    @csrf
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" required value="{{$expenseItem->title}}" name="title" id="title" aria-describedby="helpId" placeholder="Edit Title">
            </div>
        </div>
    </div>
    {{-- @include('modules.editor') --}}
    <div class="row">
        <div class="col">
            <div class="form-group">
              <label for="comment">Comment</label>
              <textarea class="form-control" name="comment" required id="comment" rows="3"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>