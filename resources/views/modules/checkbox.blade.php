<div class="form-group">
    <div class="control-label">{{ isset($title) ? $title : 'Status'}}</div>
    <label class="custom-switch pl-0 mt-2">
        <input  type="checkbox" 
                name="{{ isset($name) ? $name : 'status' }}" 
                class="custom-switch-input" 
                @isset($checked) @checked($checked == 1) @endisset>
        <span class="custom-switch-indicator"></span>
        <span class="custom-switch-description">{{ isset($text) ? $text : 'Deactive / Active'}}</span>
    </label>
</div>