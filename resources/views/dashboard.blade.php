<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
        <meta name="csrf-token" content="{{csrf_token()}}" />
        @php
            $page_title = empty($title) ? "Real Estate" : "Real EState | ". $title;
        @endphp
        <title>{{ $page_title }}</title>
        @yield('styles')
        @include('layouts.style')
        @stack('style')
    </head>
    @if (checkUserForm())
        <body class="bg-gradient-primary">
            <div class="container">
                @yield('content')
            </div>
            <script src="{{url('js/jquery.min.js')}}"></script>
            <script src="{{url("js/toastr.min.js")}}"></script>
            @if(Session::has('message'))
                <script>
                    var type="{{Session::get('alert-type')}}";
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
            @php
                Session::forget('message');
            @endphp 
        </body>
    @else
        <body id="page-top">
            <div id="wrapper">
                @include("layouts.sidebar")
                <div id="content-wrapper" class="d-flex flex-column">
                    <div id="content">
                        @include("layouts.navbar")
                        @include($page)
                        <footer class="mt-3 sticky-footer bg-white">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <span>Real State Business</span>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
            @include('layouts.script')
            
        </body>
    @endif
</html>