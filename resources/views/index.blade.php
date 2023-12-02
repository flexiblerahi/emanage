@push('style')
    <style>
        .card-body {
            background-color: red;
        }
    </style>
@endpush
@if (isset($modal))
    <div class="show">
        @include($modal)
    </div>
@endif
@if (isset($modalForm))
    @include($modalForm)
@endif

{{$dataTable->table()}}

@push('script')
    <script src="{{url('js/datatables/datatables.min.js')}}"></script>
    <script src="{{url('js/datatables/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{url('js/datatables/buttons.server-side.js')}}"></script>
    {{$dataTable->scripts()}}
    <script src="{{url('js/index.js')}}"></script>
    @include('layouts.sweetAlertDelete')
@endpush
