<div class="row">
    <div class="col-3 text-center">
        <img src="{{url('img/logo.jpeg')}}" class="img-fluid" style="height: 110px;" alt="">
    </div>
    <div class="col-6 text-center pb-2" >
        <h2>Pushpodhara Properties Ltd.</h2>
        <h6>Level 4, Hosaf Tower, Malibag, Dhaka</h6>
        {!! html_entity_decode($heading) !!}
        @if (isset($startDate) && isset($endDate))
            <h6><span class="font-weight-bold"></span> (<span>{{Carbon\Carbon::parse($startDate)->format('d-m-Y')}}</span>@isset($endDate) to <span>{{Carbon\Carbon::parse($endDate)->format('d-m-Y')}}@endisset </span>)</h6>
        @endif
        
    </div>
    <div class="col-3 p-3 align-text-bottom text-center">
        <h6><span class="font-weight-bold">Report Generation Time </span></h6>
        <h6>{{now()->format('d-m-Y h:i a')}}</h6>
    </div>
</div>
<div class="row">
    <div class="col-12 text-right">
        <a class="btn btn-primary" href="{{url()->previous()}}">Back</a>
        <div id="print" class="btn btn-primary">Print</div>
    </div>
</div>
<script src="{{url('js/jquery.min.js')}}"></script>
<script>
    $('#print').on('click', function () {
        $('.btn').addClass('d-none');
        window.print();
        $('.btn').removeClass('d-none');
    });
</script>