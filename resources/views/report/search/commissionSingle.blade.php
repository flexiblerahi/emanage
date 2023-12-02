
<div class="row mb-2">
    <div class="col">
        <select name="role" id="role" class="form-control">
            @foreach ($roles as $key => $item)
                <option value="{{$key}}">{{$item}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-2">
    <div class="col">
        <select name="user_id" id="sale_user_id" class="form-control select2">
            <option value="">Select User</option>
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{ $user->name.' ('.$user->phone.')'}}</option>
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
<div class="mb-2">
    <table class="table table-bordered" id="landdetils">
        <thead>
            <tr><th>Export</th>
                <th>Sector</th>
                <th>Block</th>
                <th>Road</th>
                <th>Price</th>
                <th>Katha</th>
                <th>Plot</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<button type="submit" class="btn btn-primary">Generate Report</button>