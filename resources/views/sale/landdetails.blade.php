@if (isset($sale))
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Price</label>
                <input required type="number" value="{{$sale->price}}" class="form-control kataprice" name="price" id="price" placeholder="Price">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="">katha</label>
                <input required type="number" value="{{$sale->kata}}" class="form-control kataprice" name="kata" id="kata" placeholder="Katha">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <input type="number" class="form-control" value="{{(int) $sale->price * $sale->kata}}" id="totalprice" disabled placeholder="Total Price">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Block</label>
                <input required type="text" value="{{$sale->block}}" class="form-control" name="block" id="block" placeholder="Block">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="">Road</label>
                <input required type="text" value="{{$sale->road}}" class="form-control" name="road" id="road" placeholder="Road">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Plot</label>
                <input required type="text" value="{{$sale->plot}}" class="form-control" name="plot" id="plot" placeholder="Plot">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="">Sector</label>
                <input required type="text" value="{{$sale->sector}}" class="form-control" name="sector" id="sector" placeholder="Sector">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Sale Date</label>
                <input id="txtDate" required type="text" class="form-control date-input bg-white" name="saledate" value="{{ getdateformat($sale->date) }}" @readonly(true)/>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
            <label for="">Sale Type</label>
            <select class="form-control" name="type" id="type">
                <option>Select Type</option>
                <option @selected($sale->type == "cash") value="cash">At a time</option>
                <option @selected($sale->type == "emi") value="emi">Installment</option>
            </select>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="price">Price(Each katha)</label>
                <input required type="number" value="0" class="form-control kataprice" name="price" id="price" placeholder="Price">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="kata">Katha</label>
                <input required type="number" value="0" class="form-control kataprice" name="kata" id="kata" placeholder="Katha">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <input type="number" class="form-control"  id="totalprice" disabled placeholder="Total Price">
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Block</label>
                <input required type="text" class="form-control" name="block" id="block" placeholder="Block">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="">Road</label>
                <input required type="text" class="form-control" name="road" id="road" placeholder="Road">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Plot</label>
                <input required type="text" class="form-control" name="plot" id="plot" placeholder="Plot">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="">Sector</label>
                <input required type="text" class="form-control" name="sector" id="sector" placeholder="Sector">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Sale Date</label>
                <input id="txtDate" type="text" class="form-control date-input bg-white" name="saledate" value="{{ now()->format('d/m/Y') }}" @readonly(true)/>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
            <label for="">Sale Type</label>
            <select class="form-control" name="type" id="type">
                <option>Select Type</option>
                <option value="cash">At a time</option>
                <option value="emi">Installment</option>
            </select>
            </div>
        </div>
    </div>
@endif
