
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title">New Expense Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <form id="formHandle" method="POST">
                <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col" id="nameinput">
                                <div class="form-group">
                                    <input type="text" required class="form-control" id="title" name="title" placeholder="Title">
                                </div>
                            </div>
                        </div>
                        <div class="parent">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="heading[]" placeholder="heading" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <textarea name="describe[]" rows="1" class="form-control" placeholder="description" required></textarea>
                                    </div>
                                </div>
                                <div class="col-1 text-right mb-2">
                                    <button type="button" class="btn btn-primary" id="addother"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-url="{{route('expense-item.store')}}" class="btn btn-primary" id="onsubmit"> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="other" class="d-none">
    <div class="child">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <input type="text" class="form-control" name="heading[]" placeholder="heading" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <textarea name="describe[]" rows="1" class="form-control" placeholder="description" required></textarea>
                </div>
            </div>
            <div class="col-1 text-right">
                <button type="button" class="btn btn-danger remove" ><i class="fa fa-minus" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</div>
