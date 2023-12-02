
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="startDate">From</label>
            <input type="date" required class="form-control" value="{{now()->format('Y-m-d')}}" name="startDate" id="startDate" aria-describedby="fromId" placeholder="From">
            <small id="fromId" class="form-text text-muted">Select Specific Date</small>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary">Generate Report</button>