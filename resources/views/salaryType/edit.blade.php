
@include('modules.backbutton')
<form action="{{route('type-salary.update', $salaryType->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="title">Title</label>
                <input value="{{$salaryType->title}}" type="text" class="form-control" id="title" name="title" required placeholder="Salary Type Title">
            </div>
        </div>
    </div>
    @include('modules.checkbox', ['status' => $salaryType->status])
    <button type="submit" class="btn btn-primary btn-block" role="button">Update</button>
</form>