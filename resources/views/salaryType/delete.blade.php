<div class="row">
    <div class="col">
        <div class="row">
            <div class="col-4 font-weight-bold">
                Title:
            </div>
            <div class="col">
                {{$salaryType->title}}
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col text-center">
        <button class="btn btn-danger" id="deleteBtn" data-action="{{route('type-salary.destroy', $salaryType->id)}}">Please Confirm to delete this salary type</button>
    </div>
</div>