<link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('css/toastr.min.css')}}">
<link rel="stylesheet" href="{{url('css/fontawsome.css')}}">
<link rel="stylesheet" href="{{url('css/datatables.min.css')}}">
<link rel="stylesheet" href="{{url('css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('css/sweetalert.css')}}">
<link rel="stylesheet" href="{{url('daterangepicker-master/daterangepicker.css')}}">
<link rel="stylesheet" href="{{url('css/tagsInput.css')}}"/>
{{-- dashboard style --}}
 <!--begin::Fonts-->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
 <!--end::Fonts-->
 <!--end::Page Vendors Styles-->
 <!--begin::Global Theme Styles(used by all pages)-->
 <link href="{{ url('dashboard/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ url('dashboard/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ url('dashboard/css/app.css') }}" rel="stylesheet" type="text/css" />
 <!--end::Global Theme Styles-->
 <!--begin::Layout Themes(used by all pages)-->
 <link href="{{ url('dashboard/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ url('dashboard/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ url('dashboard/css/themes/layout/brand/light.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ url('dashboard/css/themes/layout/aside/light.css') }}" rel="stylesheet" type="text/css" />

 <style>
   .select2-container .select2-search--inline .select2-search__field {
     margin-bottom: 5px !important;
   }

   .select2-container--default .select2-selection--single,
   .select2-container--default .select2-selection--multiple {
     border-color: #E4E6EF !important;
   }

   .aside-minimize .logo-alt {
     display: none !important;
   }

   .aside-minimize.aside-minimize-hover .logo-alt {
     display: flex !important;
   }

 </style>

 <!--end::Layout Themes-->
 @stack('style')