<div class="modal fade" id="{{$modal_type}}Id" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$modal_title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body @isset($modalbodyClass) {{$modalbodyClass}} @endisset">
                @isset(${$modal_type})
                    @include($modal_type.'.show')
                @endisset
            </div>
        </div>
    </div>
</div>