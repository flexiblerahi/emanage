
<div class="row mb-2">
    <div class="col">
        <select name="user_id" id="sale_multiple_user_id" class="form-control select2">
            <option value="">Select User</option>
            @foreach ($users as $user)
                <option value="{{ $roles[$user->role].'-'.$user->id}}">{{ $user->name.' ('.$user->account_id.') - '. $user->phone}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-2">
    <div class="col">
        <input type="text" value="" id="daterange" class="form-control" name="daterange" autocomplete="off" placeholder="Date Range" readonly/>
    </div>
</div>
<div class="row mb-2">
    <div class="col">
        <input type="checkbox" style="height:35px;width:35px;" name="alldata" id="alldata"> Get All Data
    </div>
</div>
<button type="submit" class="btn btn-primary">Generate Report</button>