@include('modules.backbutton')
<form action="{{route('land-purchase.update', $landPurchase->id)}}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="land">Amount of land</label>
                <input type="text" class="form-control" id="land" name="land" value="{{$landPurchase->land}}" placeholder="জমির পরিমাণ">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="amount">Price of Land</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{$landPurchase->amount}}" placeholder="জমির মুল্য">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="mouza">Mouza</label>
                <input type="text" class="form-control" id="mouza" name="mouza" value="{{$landPurchase->mouza}}" placeholder="মৌজা">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="giver">Receiver</label>
                <input type="text" class="form-control" id="giver" name="giver" value="{{$landPurchase->giver}}" placeholder="দাতা">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="taker">Taker</label>
                <input type="text" class="form-control" id="taker" name="taker" value="{{$landPurchase->taker}}" placeholder="গ্রহীতা">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="rs">R.S Pointer</label>
                <input type="text" class="form-control" id="rs" name="rs" value="{{$landPurchase->rs}}" placeholder="R.S দাগনং">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="sa">S.A Pointer</label>
                <input type="text" class="form-control" id="sa" name="sa" value="{{$landPurchase->sa}}" placeholder="S.A দাগনং">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="document">Document @if(!is_null($landPurchase->document)):(<a target="_blank" href="{{setImage($landPurchase->document)}}"><i class="fa fa-file" aria-hidden="true"></i> Previous document</a>)@endif</label>
                <input type="file" class="form-control" name="document" id="document">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block" role="button"> Save</button>
</form>