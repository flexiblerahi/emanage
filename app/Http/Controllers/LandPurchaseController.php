<?php

namespace App\Http\Controllers;

use App\DataTables\LandPurchaseDataTable;
use App\Models\LandPurchase;
use Illuminate\Http\Request;

class LandPurchaseController extends Controller
{
    public function __construct() {
        $this->middleware('permission:land-purchase-list|new-land-purchase|land-purchase-edit|land-purchase-view', ['only' => ['index', 'create', 'store', 'edit', 'update', 'show']]);
        $this->middleware('permission:new-land-purchase', ['only' => ['create', 'store']]);
        $this->middleware('permission:land-purchase-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:land-purchase-view', ['only' => ['show']]);
    }

    public function index(LandPurchaseDataTable $landPurchaseDataTable) //view('landpurchase.create') //view('modules.modal')
    {
        $data['page'] = 'index';
        $data['title'] = 'Land Purchases';
        if(auth()->user()->can('land-purchase-view')) {
            $data['modal'] = 'modules.modal';
            $data['modal_title'] = 'Land Purchase Profile';
            $data['modal_type'] = 'landpurchase';
            $landPurchaseDataTable->setModaltype($data['modal_type']);
        }
        return $landPurchaseDataTable->render('home', $data);
    }

    public function show($id)
    {
        if(request()->ajax()) {
            $data['landpurchase'] = LandPurchase::with('entrier')->findorfail($id);
            return view('landpurchase.show', $data)->render();    
        } else abort(404);
    }

    public function create() //view('landpurchase.create')
    {
        $data['title'] = 'New Land Purchase';
        $data['page'] = 'landpurchase.create';
        return view('home', $data);
    }
    
    public function edit($id) //view('landpurchase.edit')
    {
        $data['landPurchase'] = LandPurchase::findorfail($id);
        $data['title'] = 'New Land Purchase';
        $data['page'] = 'landpurchase.edit';
        return view('home', $data);
    }

    public function store(Request $request) { return $this->upstore($request); }
    
    public function update(Request $request, $id) { return $this->upstore($request, $id); }

    private function validation($request)
    {
        $validate['land'] = ['required'];
        $validate['amount'] = ['required'];
        $validate['mouza'] = ['required'];
        $validate['giver'] = ['required'];
        $validate['taker'] = ['required'];
        $validate['rs'] = ['required'];
        $validate['sa'] = ['required'];
        $validate['document'] = ['required'];
        return $request->validate($validate);
    }

    private function upstore($request, $id = null) 
    {
        $input = $this->validation($request);
        $landPurchase = is_null($id) ? new LandPurchase() : LandPurchase::findorfail($id);
        $landPurchase->land = $input['land'];
        $landPurchase->amount = $input['amount'];
        $landPurchase->mouza = $input['mouza'];
        $landPurchase->giver = $input['giver'];
        $landPurchase->taker = $input['taker'];
        $landPurchase->rs = $input['rs'];
        $landPurchase->sa = $input['sa'];
        if($request->has('document')) {
            if(is_null($id)) $landPurchase->document = uploadFile($input['document'], autoIdGenerator('land_purchases', true), 'landpurchase/');
            else $landPurchase->document = uploadFile($input['document'], autoIdGenerator('land_purchases', true), 'landpurchase/', $landPurchase->document);
        }
        $landPurchase->entry = entry();
        $landPurchase->save();
        $msg = is_null($id) ? 'Land Purchase Create Successfully.' : 'Land Purchase Updated Successfully.';
        return redirect()->route('land-purchase.index')->with(['message' => $msg, 'alert-type' => 'success']);
    }
}
