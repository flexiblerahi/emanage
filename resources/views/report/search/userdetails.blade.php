
@if (!in_array($type, ['shareholders']))

    <div id="userdetails">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <input type="text" class="form-control" data-user="agent" id="user_details_phone" list="user_details_list" placeholder="Search by agent or master agent phone number or Account Id">
                    <datalist id="user_details_list">
                    </datalist>
                </div>
            </div>
        </div>
        <div  class="card-body" id="agentInfo">
        </div>
    </div>

@endif

<div class="row mb-2">
    <div class="col">
        <input type="text" value="" id="daterange" class="form-control" name="daterange" autocomplete="off" placeholder="Date Range" readonly/>
    </div>
</div>
@if (in_array($type, ['salePaymentDetails', 'saleTransaction', 'withdraw']))
    <div class="row mb-2">
        <div class="col">
            <input type="checkbox" style="height:35px;width:35px;" name="alldata" id="alldata"> Get All
        </div>
    </div>
@endif
<button type="submit" class="btn btn-primary">Generate Reporter</button>