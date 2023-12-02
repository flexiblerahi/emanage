
<div id="userdetails">
    <div class="row">
        <div class="col">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" class="form-control" id="employee_details_phone" list="employee_details_list" placeholder="Search by Employee phone number">
                            <datalist id="employee_details_list">
                            </datalist>
                        </div>
                    </div>
                </div>
                <div id="employeeInfo" class="card card-body">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="startDate">From</label>
            <input type="date" required class="form-control" value="{{now()->format('Y-m-d')}}" name="startDate" id="startDate" aria-describedby="fromId" placeholder="From">
            <small id="fromId" class="form-text text-muted">Start Date with</small>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary">Generate Report</button>