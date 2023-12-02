<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{$route}}" method="get">
      <div class="modal-content">
        <div class="modal-body">
            @isset($user_id)
              <input type="hidden" name="user_id" value="{{$user_id}}">
            @endisset
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="startDate">From</label>
                  <input type="date" required class="form-control" value="{{now()->format('Y-m-d')}}" name="startDate" id="startDate" aria-describedby="fromId" placeholder="From">
                  <small id="fromId" class="form-text text-muted">Start Date with</small>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="endDate">To</label>
                  <input type="date" required class="form-control" value="{{now()->format('Y-m-d')}}" name="endDate" id="endDate" aria-describedby="toId" placeholder="To">
                  <small id="toId" class="form-text text-muted">End Date</small>
                </div>
              </div>
            </div>
          
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Generate Report</button>
        </div>
      </div>
    </form>
  </div>
</div>
 