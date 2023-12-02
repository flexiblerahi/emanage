
@include('modules.backbutton')
<form action="{{route('type-salary.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required placeholder="Salary Type Title">
            </div>
        </div>
    </div>
    @include('modules.checkbox', ['status' => 1])
    <button type="submit" class="btn btn-primary btn-block" role="button"> Save</button>
</form>