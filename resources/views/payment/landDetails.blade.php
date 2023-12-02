<div class="row p-3 @isset($modalClass) {{$modalClass}} @endisset">
    <div class="col-3">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="name">Sector :</label>
            <span class="customer_info">{{$sale->sector}}</span>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="phone">Block :</label>
            <span class="customer_info">{{$sale->block}}</span>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="occupation">Road :</label>
            <span class="customer_info">{{$sale->road}}</span>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="name">Katha :</label>
            <span class="customer_info">{{$sale->kata}}</span>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="name">Price :</label>
            <span class="customer_info">{{$sale->price}}</span>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="text-info font-weight-bold" for="name">Plot :</label>
            <span class="customer_info">{{$sale->plot}}</span>
        </div>
    </div>
</div>