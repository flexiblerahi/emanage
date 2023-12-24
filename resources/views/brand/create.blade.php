@if (isset($brand))
    <form id="formSubmit" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$brand->name}}" placeholder="Brand Name">
        </div>
        <button type="button" data-action="{{route('brand.update', $brand->id)}}" class="btn btn-primary" id="submit">Update</button>
        @include('modules.editor')
    </form>
@else
    <form id="formSubmit"  method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Brand Name">
        </div>
        <button type="button" data-action="{{route('brand.store')}}" class="btn btn-primary" id="submit">Save</button>
    </form>
@endif
