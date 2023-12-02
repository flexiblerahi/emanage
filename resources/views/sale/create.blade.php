@include('sale.style')
@include('modules.backbutton')
@include('sale.createcustomer')
<form action="{{route('sale.store')}}" method="POST">
    @csrf
    <div class="card">
        @include('modules.header', ['title' => 'CUSTOMER INFORMATION', 'type' => 'first'])
        <div class="card-body collapse show" id="first">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control" data-user="customer" name="cus_phone" id="customer_details_phone" list="customer_details_list" placeholder="Search by customer phone number">
                        <datalist id="customer_details_list">
                        </datalist>
                    </div>
                </div>
            </div>
            <div class="card-body border" id="customerInfo">
            </div>
        </div>
    </div>
    <div class="card">
        @include('modules.header', ['title' => 'COMMISION (Reference Details)', 'type' => 'third'])
        <div class="card-body collapse show" id="third">
            <div class="row">
                <div class="col">
                    <div class="form-group mb-0">
                        <input type="text" class="form-control" name="ref_id" data-user="agent" id="user_details_phone" list="user_details_list" placeholder="Search by agent or Master Agent phone number">
                        <datalist id="user_details_list">
                        </datalist>
                    </div>
                </div>
            </div>
            <div  class=" pb-0 pt-2" id="agentInfo">
            </div>
        </div>
    </div>
    <div class="card">
        @include('modules.header', ['title' => 'DESCRIPTION OF LAND', 'type' => 'second'])
        <div class="card-body collapse show" id="second">
            @include('sale.landdetails')
        </div>
    </div>
    <div class="m-2">
        <button type ="submit" class="btn btn-primary">submit</button>
    </div>
</form>
@include('sale.script')