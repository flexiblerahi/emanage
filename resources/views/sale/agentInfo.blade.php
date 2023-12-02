<input type="hidden" name="reference_id" value="{{$user->phone}}">
@include('sale.referuser')
<table class="table table-bordered mt-2 mb-0">
    <thead>
        <th>Rank {{($rank)}}</th>
        @foreach (range(1,3) as $hand) <th>hand{{$hand}}</th> @endforeach
        <th>Master Agent</th>
        <th>Total</th>
        @if (!is_null($user->reference_id)) <th>Remaining</th> @endif
    </thead>
    @if (is_null($user->reference_id) )
        <tr>
            <th>Details</th>
            @foreach (range(0, 2) as $key)<td></td>@endforeach
            @include('sale.heading', ['user' => $user])
            <td></td>
        </tr>
    @else
        <tr>
            <th>Details</th>
            @foreach (range(0, 2) as $key)
                @if (isset($agents[$key])) @include('sale.heading', ['user' => $agents[$key]])
                @else <td></td> @endif
            @endforeach
            @include('sale.heading', ['user' => $shareholder])
        </tr>
    @endif
    @foreach ($commissions as $commission)
        @if (is_null($user->reference_id) )
            <tr>
                <th>{{$commission->type_name}}</th>
                @foreach (range(0, 2) as $key) <td></td> @endforeach
                <td>{{$commission->total.' %'}}</td>
                <td>{{$commission->total.' %'}}</td>
            </tr>
        @else
            @php 
                $total_shareholder = (float) $commission->total; 
                $className = "form-control user commission_".$commission->id;
            @endphp
            <tr>
                <th>{{$commission->type_name}}</th>
                @foreach (range(0, 2) as $key)
                    @if (isset($agents[$key]))
                        @php $total_shareholder = $total_shareholder - (float) $commission->ranking['hand'.$key+1]; @endphp
                        @php $agentId = "hand_".($key+1)."-commission_".$commission->id."-user_".$agents[$key]['id']; @endphp
                        <td>
                            <input type="number" step="0.01" class="{{$className}}" commission-name="{{$commission->type_name}}" total="{{$commission->total}}" id="{{$agentId}}" name="{{$agentId}}" value="{{$commission->ranking['hand'.$key+1]}}">
                        </td>                        
                    @else
                        <td></td>
                    @endif
                @endforeach
                @php $shareholderId = "shareholder-commission_".$commission->id."-user_".$shareholder['id']; @endphp
                <td>
                    <input type="number" step="0.01" name="{{$shareholderId}}" commission-name="{{$commission->type_name}}" total="{{$commission->total}}" id="{{$shareholderId}}" class="{{$className}}" value="{{$total_shareholder}}">
                </td>
                <td>{{$commission->total}} %</td>
                <td id="commission_{{$commission->id}}">0%</td>
            </tr>
        @endif
    @endforeach
</table>