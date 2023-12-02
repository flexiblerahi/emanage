@if (isset($bankName))
    <form id="formSubmit" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$bankName->name}}" placeholder="Bank Name">
        </div>
        @include('modules.checkbox', ['status' => $bankName->status])
        <button type="button" data-action="{{route('bank-name.update', $bankName->id)}}" class="btn btn-primary" id="submit">Update</button>
        @include('modules.editor')
    </form>
@else
    <form id="formSubmit"  method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Bank Name">
        </div>
        @include('modules.checkbox', ['status' => 1])
        <button type="button" data-action="{{route('bank-name.store')}}" class="btn btn-primary" id="submit">Save</button>
    </form>
@endif
