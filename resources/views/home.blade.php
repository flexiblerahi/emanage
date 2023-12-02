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
    <body id="kt_body" class="header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        @include('admin.includes.header_mobile')

        {{-- scripted files --}}
        @include('layouts.script')
    </body>
</html>