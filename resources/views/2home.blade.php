<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        {{-- <link rel="shortcut icon" href="assets/media/logos/favicon.ico" /> --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @php
            $page_title = empty($title) ? "Smart Pos" : "Smart Pos | ". $title;
        @endphp
        <title>{{ __($page_title) }}</title>
        @include('layouts.style')
    </head>

    <!--end::Head-->
    <!--begin::Body-->

    <body id="kt_body" class="header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <!--begin::Main-->
        <!--begin::Header Mobile-->
        @include('layouts.mobile_navbar')
        <!--end::Header Mobile-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            @include("layouts.sidebar")
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                @include("layouts.navbar")
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Subheader-->
                <!--end::Subheader-->
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container m-0">
                        <!--begin::Dashboard-->
                        @yield('content')
                        <!--end::Dashboard-->
                        @isset($page)
                            @include($page)
                        @endisset
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                {{-- @include('admin.includes.footer') --}}
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Main-->
        @include('layouts.script')
    </body>
<!--end::Body-->

</html>
