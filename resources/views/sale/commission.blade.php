<table class="table table-bordered" id="commission-rank-table">
    <thead>
        <th>Rank {{$rank}}</th>
        @foreach (range(1,3) as $hand) <th>hand{{$hand}}</th> @endforeach
        <th>Master Agent</th>
        <th>Total</th>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Details</th>
            @if (is_null($sale->agent_id))
                @foreach (range(0,2) as $step) <td></td> @endforeach
                @include('sale.heading', ['user' => $user])
            @else
                @foreach (range(0,2) as $item)
                    @if (array_key_exists($item, $referencesIds))
                        @php 
                            $reference_user = $referenceUsers->where('id', $referencesIds[$item])->first();
                        @endphp
                        @if ($reference_user->role == 4) @include('sale.heading', ['user' => $reference_user])
                        @else <td></td> @endif
                    @else <td></td> @endif
                @endforeach
                @php $reference_user = $referenceUsers->where('role', 3)->first(); @endphp
                @include('sale.heading', ['user' => $reference_user])
            @endif
        </tr>
        @foreach ($commissions as $key => $commission)
            @php $total_percentage = 0; @endphp
            <tr>
                <th scope="row">{{$commission_names[$key]}}</th>
                @if (!is_null($sale->agent_id))
                    @foreach (range(0,2) as $item)
                        @if (key_exists($item, $commission))
                            @if (key_exists('agent_id', $commission[$item]))
                                @php $total_percentage = $total_percentage + $commission[$item]['percentage']; @endphp
                                <td>{{$commission[$item]['percentage']}}% </td>
                            @else <td></td> @endif
                        @else <td></td> @endif
                    @endforeach
                @else
                    @foreach (range(0,2) as $step) <td></td> @endforeach
                @endif
                <td>{{end($commission)['percentage']}}%</td>
                <td>{{$total_percentage + end($commission)['percentage']}}%</td>
            </tr>
        @endforeach
    </tbody>
</table>