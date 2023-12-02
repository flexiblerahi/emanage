<script src="{{url('js/jquery.min.js')}}"></script>

<script src="{{url('js/popper.min.js')}}"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<script src="{{url('js/moment.min.js')}}"></script>
<script src="{{url("js/sb-admin-2.min.js")}}"></script>
<script src="{{url('js/jquery-ui.js')}}"></script>
<script src="{{url('js/jquery.nicescroll.min.js')}}"></script>
<script src="{{url('js/tagsinput.js')}}"></script>
<script src="{{url("js/toastr.min.js")}}"></script>
<script src="{{url('js/select2.min.js')}}"></script>
{{-- <script src="vendor/chart.js/Chart.min.js"></script> --}}
<script src="{{url('js/sweetalert.js')}}"></script>
<!-- Page level custom scripts -->
@if (request()->routeIs('home'))
    <script src="{{url("vendor/chartjs/Chart.min.js")}}"></script>
    <script src="{{url("js/chart-area-demo.js")}}"></script>
    <script src="{{url("js/chart-pie-demo.js")}}"></script>
    <script src="{{url("js/chart-bar-demo.js")}}"></script>
@endif

<script>
    $(function () {
        $('.select2').select2();
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).off('click', '.sectioncollapse').on('click', '.sectioncollapse', function() {
        let chevronIcon = $(this).find('i');
        if (chevronIcon.hasClass('fa-chevron-up')) {
            chevronIcon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
        } else {
            chevronIcon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
        }
    });
</script>

@if(Session::has('message'))
    <script>
        var type="{{Session::get('alert-type')}}"
        console.log('type :>> ', type);
        switch(type){
            case 'info':
            toastr.info("{{Session::get('message')}}");
                break;
            case 'success':
            toastr.success("{{Session::get('message')}}");
                break;
            case 'warning':
            toastr.warning("{{Session::get('message')}}");
                break;
            case 'error':
            toastr.error("{{Session::get('message')}}");
                break;
        }
    </script>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{$error}}');
        </script>
    @endforeach
@endif
@php
    Session::forget('message');
@endphp 
@if (session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
@endif

@stack('script')

