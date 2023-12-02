
<input type="hidden" name="reference_id" value="{{$user->phone}}">
@include('sale.referuser')
<table class="table table-bordered mt-2 mb-0">
    <thead>
        <th>Rank {{$rank}}</th>
        @foreach (range(1,3) as $hand) <th>hand{{$hand}}</th> @endforeach
        <th>shareholder</th>
        <th>total</th>
        @if (is_null($payment)) <th>Remaining</th> @endif
    </thead>
    <tbody>
        <tr>
            <th scope="row">Details</th>
            @if (is_null($sale->agent_id))
                <td></td>
                <td></td>
                <td></td>
                @include('sale.heading', ['user' => $user])
            @else
                @foreach (range(0,2) as $item)
                    @php $reference_user = (array_key_exists($item, $referencesIds)) ? $referenceUsers->where('id', $referencesIds[$item])->first()  : null; @endphp
                    @if (!is_null($reference_user) && ($reference_user->role == 4)) 
                        {{-- role = agent --}}
                        @include('sale.heading', ['user' => $reference_user])
                    @else
                        <td></td>
                    @endif
                @endforeach
                @php
                    $reference_user = $referenceUsers->where('role', 3)->first();
                    // role = master agent/shareholder
                @endphp
                @include('sale.heading', ['user' => $reference_user])
            @endif
        </tr>
        @foreach ($commissions as $key => $commission)
            @php
                $total_percentage = 0;
                $commission_id = $commission_id + 1;
                $className = "form-control user commission_".$commission_id;
            @endphp
            @if (is_null($payment))
                <tr>
                    <th scope="row">{{$commission_names[$key]}}</th>
                    @if (!is_null($sale->agent_id))
                        @foreach (range(0, 2) as $item)
                            @if  (array_key_exists($item, $commission) && key_exists('agent_id', $commission[$item]))
                                @php
                                    $total_percentage = $total_percentage + $commission[$item]['percentage'];
                                    $agentId = $commission[$item]['hand']."-commission_".$commission_id."-user_".$commission[$item]['agent_id'];
                                @endphp
                                <td><input type="number" required step="0.01" commission-name="{{$key}}" name="{{$agentId}}" id="{{$agentId}}" class="{{$className}}" total="{{array_sum(array_column($commissions[$key], 'percentage'))}}" value="{{$commission[$item]['percentage']}}"></td>
                            @else
                                <td></td>
                            @endif
                        @endforeach
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                    @php $shareholderId = "shareholder-commission_".$commission_id."-user_".end($commission)['shareholder_id']; @endphp
                    @if (is_null($sale->agent_id))
                        <td>{{end($commission)['percentage']}}%</td>
                    @else
                        <td><input type="number" required step="0.01" commission-name="{{$key}}" class="{{$className}}" id="{{$shareholderId}}" total="{{array_sum(array_column($commissions[$key], 'percentage'))}}" name="{{$shareholderId}}" value="{{end($commission)['percentage']}}"></td>
                    @endif
                    <td>{{$total_percentage + end($commission)['percentage']}}%</td>
                    <td id="commission_{{$commission_id}}">0%</td>
                </tr>
            @else
                <tr>
                    <th scope="row">{{$commission_names[$key]}}</th>
                    @if (!is_null($sale->agent_id))
                        @foreach (range(0,2) as $item)
                            @if (key_exists('agent_id', $commission[$item]))
                                @php
                                    $total_percentage = $total_percentage + $commission[$item]['percentage'];
                                @endphp
                                <td>{{$commission[$item]['percentage']}}% </td>
                            @else
                                <td></td>
                            @endif
                        @endforeach
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                    <td>{{end($commission)['percentage']}}%</td>
                    <td>{{$total_percentage + end($commission)['percentage']}}%</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>