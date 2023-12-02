<div class="form-group">
    <div class="control-label">Status</div>
    <label class="custom-switch pl-0 mt-2">
        <input type="checkbox" name="status" class="custom-switch-input" @isset($status) @checked($status == 1) @endisset>
        <span class="custom-switch-indicator"></span>
        <span class="custom-switch-description">Deactive / Active</span>
    </label>
</div>