<div class="container">
    <div class="main-body">
        <table class="table table-bordered   table-inverse ">
            <tbody>
                <tr>
                    <td scope="row" class="font-weight-bold">Amount of Land (জমির পরিমাণ)</td>
                    <td>{{$landpurchase->land}}</td>
                </tr>
                <tr>
                    <td scope="row" class="font-weight-bold">Price of Land (জমির মুল্য)</td>
                    <td>{{tk($landpurchase->amount)}}</td>
                </tr>
                <tr>
                    <td scope="row" class="font-weight-bold">Mouza (মৌজা)</td>
                    <td>{{$landpurchase->mouza}}</td>
                </tr>
                <tr>
                    <td scope="row" class="font-weight-bold">Receiver (দাতা)</td>
                    <td>{{$landpurchase->giver}}</td>
                </tr>
                <tr>
                    <td scope="row" class="font-weight-bold">Taker (গ্রহীতা)</td>
                    <td>{{$landpurchase->taker}}</td>
                </tr>
                <tr>
                    <td scope="row" class="font-weight-bold">R.S Pointer (R.S দাগনং)</td>
                    <td>{{$landpurchase->rs}}</td>
                </tr>
                <tr>
                    <td scope="row" class="font-weight-bold">Price of Land (S.A দাগনং)</td>
                    <td>{{$landpurchase->sa}}</td>
                </tr>
                @if(!is_null($landpurchase->document))
                    <tr>
                        <td scope="row" class="font-weight-bold">Document</td>
                        <td><a target="_blank" href="{{setImage($landpurchase->document)}}"><i class="fa fa-file" aria-hidden="true"></i> Prove document</a></td>
                    </tr>
                @endif
                <tr>
                    <td scope="row" class="font-weight-bold">Entry Details</td>
                    <td>
                        <ul>
                            <li><span class="font-weight-bold">Name:</span> {{$landpurchase->entrier->name}}</li>
                            <li><span class="font-weight-bold">Phone:</span> {{$landpurchase->entrier->phone}}</li>
                            <li><span class="font-weight-bold">Account Id:</span> {{$landpurchase->entrier->account_id}}</li>
                            <li><span class="font-weight-bold">Emergency Phone:</span> {{$landpurchase->entrier->emergency_contact}}</li>
                           
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>