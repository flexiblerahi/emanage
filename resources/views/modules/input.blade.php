<div class="form-group">
    @isset($record)
        <label for="{{$name}}">{{ $label }}</label>
    @endisset
    <input type="text" class="form-control" name="{{ $name }}" id="{{ $name }}" value="" placeholder="{{ isset($placeholder) ? $placeholder : ''}}">
</div>