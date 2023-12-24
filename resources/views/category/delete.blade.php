<div class="row">
    <div class="col">
        <div class="row">
            <div class="col-4 font-weight-bold">
                Name:
            </div>
            <div class="col">
                {{$category->title}}
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col text-center">
        <button class="btn btn-danger" id="deleteBtn" data-action="{{route('expense-item.destroy', $category->id)}}">Please Confirm to delete this expense item</button>
    </div>
</div>