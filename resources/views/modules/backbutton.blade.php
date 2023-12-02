@php
    $previous = isset($previous) ? $previous : URL::previous();
@endphp
<div class="row mb-2">
    <div class="col text-right">
        <a class="btn btn-primary " href="{{ $previous }}" role="button"><i class="fas fa-arrow-circle-left"></i> Back</a>
       @isset($button)
           {!! $button !!}
       @endisset
    </div>
</div>     
