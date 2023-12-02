@include('sale.style')
@include('modules.backbutton')
@include('sale.createcustomer')
<form action="{{route('sale.update', $sale->id)}}" method="POST">
    @csrf
    @method('put')
    <div class="card">
        @include('modules.header', ['title' => 'CUSTOMER INFORMATION', 'type' => 'first'])
        <div class="card-body collapse show" id="first">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control" data-user="customer" value="{{$sale->customer->phone}}" name="cus_phone" id="customer_details_phone" list="customer_details_list" placeholder="Search by customer phone number">
                        <datalist id="customer_details_list">
                        </datalist>
                    </div>
                </div>
            </div>
            <div class="card-body border" id="customerInfo">
                @include('sale.customerInfo', ['user' => $sale->customer])
            </div>
        </div>
    </div>
    <div class="card">
        @include('modules.header', ['title' => 'COMMISION (Reference Details)', 'type' => 'third'])
        <div class="card-body collapse show" id="third">
            @if (is_null($payment))
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control" name="ref_id" value="{{$user->phone}}" data-user="agent" id="user_details_phone" list="user_details_list" placeholder="Search by agent or master agent phone number">
                            <datalist id="user_details_list">
                            </datalist>
                        </div>
                    </div>
                </div>
            @endif
            <div  class=" pb-0 pt-2" id="agentInfo">
                @include('sale.editAgentInfo')
            </div>
        </div>
    </div>
    <div class="card">
        @include('modules.header', ['title' => 'DESCRIPTION OF LAND', 'type' => 'second'])
        <div class="card-body collapse show" id="second">
            @include('sale.landdetails')
        </div>
    </div>
    @include('modules.editor')
    <div class="row">
        <div class="col-1">
            <div class="m-2">
                <button type ="submit" class="btn btn-primary">submit</button>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
              <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Please enter comment that why need to update this section."></textarea>
            </div>
        </div>
    </div>
</form>
@include('sale.script')
