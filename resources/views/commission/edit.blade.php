
<form action="{{route('commission.update', $commission['id'])}}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        <div class="row mb-2">
            <div class="col">
                <label for="">Total</label>
            </div>
            <div class="col text-right">
                <a class="btn btn-primary" href="{{route('commission.index')}}">Back</a>
            </div>
        </div>
        <input type="number" required step="0.01" class="form-control" name="total" id="total" placeholder="Total Parcentage from 100%" value="{{$commission['total']}}">
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">Rank/Hand</th>
            @foreach (range(1, 3) as $hand)<th scope="col">Hand {{$hand}}</th> @endforeach
            <th scope="col">Master Agent</th>
            </tr>
        </thead>
        <tbody>
            @foreach (range(1, 3) as $rank)
                <tr>
                    <th>Rank {{$rank}}</th>
                    @php $all = json_decode($commission['rank'.$rank], true); @endphp
                    @foreach (range(1, 3) as $hand)
                        @php $nameid = "rank".$rank."_hand".$hand; @endphp
                        <td><input type="number" required step="0.01" class="form-control childs rank{{$rank}}" 
                            id="{{$nameid}}" name="{{$nameid}}" value="{{$all['hand'.$hand]}}"></td>
                    @endforeach
                    <td><input type="number" disabled step="0.01" class="form-control childs shareholder" 
                        id="rank{{$rank}}_shareholder" name="rank{{$rank}}_shareholder" value="{{$all['shareholder']}}"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button class="btn btn-primary" type="submit">Save</button>
</form>
                
@push('script')
    <script>
        $('#total').on('keyup', function() {
            $('.childs').val('0');
            if(parseFloat($(this).val()) < 1) {
                $(this).val(1);
            }
            if(parseFloat($(this).val())> 100) {
                toastr.warning('Please enter below 100'); 
                $(this).val(0);
            }
        })
        $('.shareholder').on('keyup', function() {
            if(parseFloat($(this).val()) < 0) {
                $(this).val(0);
            }
            const id = $(this).attr('id').split('_');
            $('.'+id[0]).val(0);
        })
        $('.childs').on('keyup', function() {
            if(parseFloat($(this).val()) < 0) {
                $(this).val(0);
            }
            const id = $(this).attr('id').split('_');
            const total = parseFloat($('#total').val()).toFixed(2);
            let hand = 1;
            let ranktotal = 0;
            while(hand<4) {
                ranktotal += parseFloat($('#'+id[0]+'_hand'+hand).val());
                hand++;
            }
            // console.log('ranktotal :>> ', ranktotal);
            let shareholder = total - (ranktotal);
            shareholder = shareholder.toFixed(2);
            console.log('shareholder :>> ', shareholder);
            if(shareholder<0) {
                toastr.warning('Please Input under '+ total);
                $('#'+id[0]+'_shareholder').val(0);
            } else {
                $('#'+id[0]+'_shareholder').val(shareholder);
            }
        })
    </script>
@endpush