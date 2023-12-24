<script src="{{url('js/jquery.min.js')}}"></script>

<script src="{{url('js/popper.min.js')}}"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<script src="{{url('js/moment.min.js')}}"></script>
<script src="{{url('js/tagsinput.js')}}"></script>
<script src="{{url("js/toastr.min.js")}}"></script>
<script src="{{url('js/select2.min.js')}}"></script>
<script src="{{url('js/sweetalert.js')}}"></script>

{{-- <script src="{{ url('dashboard/plugins/global/plugins.bundle.js') }}"></script> --}}
<script src="{{ url('dashboard/js/scripts.bundle.js') }}"></script>

<script>
    $('[data-tooltip="tooltip"]').tooltip();
        $('.alert').delay(4000).fadeOut();
        $('.select2').select2(
            {
                placeholder: 'Select option',
            }
        );
        $('.select2-withTag').select2(
            {
                placeholder: 'Select option',
                tags: "true",
            }
        );
        $('.select2_multiple').select2(
            {
                placeholder: 'Select option',
                closeOnSelect: false
            }
        );
</script>
<script>
    var KTAppSettings = {
        "breakpoints": 
        {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
  </script>

@if(Session::has('message'))
    <script>
        var type="{{Session::get('alert-type')}}";

        switch(type) {
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

