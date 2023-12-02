<?php

namespace App\Http\Controllers;

use App\DataTables\CommissionDataTable;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function __construct() {
        $this->middleware('permission:commission-list|commission-edit|commission-view', ['only' => ['index', 'show', 'edit', 'update']]);
        $this->middleware('permission:commission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:commission-view', ['only' => ['show']]);
    }

    public function index(CommissionDataTable $dataTable) //view('home'); //view('index'); view('commission.show');
    {
        $data['page'] = 'index';
        $data['title'] = 'Commission';
        $data['modal'] = 'commission.show';
        return $dataTable->render('home', $data);
    }

    public function show(Commission $commission)
    {
        $commission = $commission->toArray();
        foreach(range(1,3) as $rank) $commission['rank'.$rank] = json_decode($commission['rank'.$rank]);
        return response()->json($commission);
    }

    public function edit($id) //view('commission.edit');
    {
        $data['commission'] = Commission::findorfail($id)->toArray();
        $data['page'] = 'commission.edit';
        $data['title'] = 'Commission Edit | '. Commission::NAMES[$data['commission']['type']];
        return view('home', $data);
    }

    public function update(Request $request, Commission $commission)
    {
        $request->validate([ 'total' => 'required' ]);
        $ranks_hands_input = $request->except(['_token', '_method', 'total']); 
        $total = $request->input('total');
        if((float) $total > 100) return redirect()->back()->with(['message' => 'Total can not be higher than 100', 'alert-type' => 'error']);
        $ranks = array();
        foreach(range(1,3) as $rank) {
            $hands = array();
            $rank_total = 0;
            foreach(range(1,3) as $hand) {
                $hand_val = $ranks_hands_input['rank'.$rank.'_hand'.$hand] ?? 0;
                $rank_total += $hand_val;
                $hands['hand'. $hand] = $hand_val;
            }
            if($rank_total>$total) return redirect()->back()->with(['message' => 'Agents percentage greater than '. $total. 'in Rank '. $rank, 'alert-type' => 'warning']);
            $ranks['rank'.$rank] = json_encode(array_merge($hands, ['shareholder' => number_format($total-$rank_total, 2)]));
        }
        $commission->total = $total;
        $commission->rank1 = $ranks['rank1'];
        $commission->rank2 = $ranks['rank2'];
        $commission->rank3 = $ranks['rank3'];
        // dd($commission);
        $commission->save();
        return redirect()->route('commission.index')->with(['message' => 'Succesfully Updated', 'alert-type' => 'success']);
    }
}
