<?php

namespace App\Http\Controllers;

use App\DataTables\SaleDataTable;
use App\Models\BackupSale;
use App\Models\Commission;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct() {
        $this->middleware('permission:sale-list|new-sale|sale-view|sale-edit', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update']]);
        $this->middleware('permission:new-sale', ['only' => ['create', 'store']]);
        $this->middleware('permission:sale-view', ['only' => ['show']]);
        $this->middleware('permission:sale-edit', ['only' => ['update', 'edit']]);
    }

    public function index(SaleDataTable $saleDataTable) //view('index') view('modules.modal')
    {
        $data['page'] = 'index';
        $data['title'] = 'Sale';
        if(auth()->user()->can('sale-view')) {
            $data['modal'] = 'modules.modal';
            $data['modal_title'] = 'Sale Details';
            $data['modal_type'] = 'sale';
            $data['modalbodyClass'] = 'p-0';
            $saleDataTable->setModaltype($data['modal_type']);
        }
        return $saleDataTable->render('home', $data);
    }
    
    public function show($id) //view('sale.show')
    {
        if(request()->ajax()) {
            $data = Sale::getDetails($id);
            return view('sale.show', $data)->render();
        } return abort(404);
    }

    public function create() // view('sale.create')
    {
        return view('home', array('page' => 'sale.create', 'title' => 'New Sale'));
    }

    public function store(Request $request)
    {
        $this->validation($request);
        $sale = $this->saveorupdate($request->all(), new Sale());
        return redirect()->route('deposit-payment.create', ['sale' => $sale->uuid])->with(['message' => 'Sale Created Successfully', 'alert-type' => 'success']);
    }

    public function edit($id) // view('sale.edit') 
    {
        $data = Sale::getDetails($id);
        $data['payment'] = Payment::where('sale_id', $data['sale']->uuid)->oldest()->first();
        $data['title'] = 'Edit Sale';
        $data['commission_id'] = 0;
        $data['page'] = 'sale.edit';
        return view('home', $data);
    }

    public function update(Request $request, $id)    
    {
        $this->validation($request, $id);
        $oldsale = Sale::findorfail($id);
        $payment = Payment::where('sale_id', $oldsale->uuid)->first();
        if(is_null($payment)) {
            $sale = $this->saveorupdate($request->all(), $oldsale, true);
            return redirect()->route('deposit-payment.create', ['sale' => $sale->uuid])->with(['message' => 'Sale Updated Successfully', 'alert-type' => 'success']);
        }
        $sale = Sale::store($oldsale, $request->all());
        return redirect()->route('old-payment', ['sale' => $sale->uuid])->with(['message' => 'Sale Update Successfully', 'alert-type' => 'success']);
    }

    public function saveorupdate($input, $sale, $is_update = false)
    {
        $user_details = UserDetail::whereIn('phone', [$input['customer_phone'], $input['reference_id']])->select('id', 'reference_id', 'total_kata', 'phone')->get();
        $customer = Customer::query()->where('phone', $input['customer_phone'])->select('id')->first();
        if(is_null($customer)) return redirect()->back()->with(['message' => 'No Customer is found', 'alert-type', 'alert-type' => 'error']);
        $reference_user = $user_details->where('phone', $input['reference_id'])->first();
        if(is_null($reference_user)) return redirect()->back()->with(['message' => 'No Agent or Master Agent is found', 'alert-type', 'alert-type' => 'error']);

        DB::beginTransaction();
        try {
            $sale->customer_id = $customer->id;
            $sale->shareholder_id = is_null($reference_user->reference_id) ? $reference_user->id : referenceIds($reference_user->reference_id, 'shareholder');
            $sale->agent_id = is_null($reference_user->reference_id) ? null : $reference_user->id;
            if($is_update) {
                $oldsale = $sale->toArray();
                BackupSale::store($oldsale, $input['comment']);
                $user_id = (is_null($oldsale['agent_id'])) ? $oldsale['shareholder_id'] : $oldsale['agent_id'];
                if($user_id == $reference_user->id) $reference_user->total_kata =(int) $reference_user->total_kata - (int) $oldsale['kata'];
                else UserDetail::updatekata($user_id, $oldsale['kata']);
            } else $sale->uuid = hash('md5', autoIdGenerator('sales', true)); //hash('md5', 2)
            $sale->commission = Commission::commissionCal($input, $reference_user);
            $sale = Sale::store($sale, $input);
            $reference_user->total_kata = (int) $input['kata'] + (int) $reference_user->total_kata;
            $reference_user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();// Something went wrong, rollback the transaction
            return redirect()->back()->with(['message' => 'New Sale Create Failed. Please try again!', 'alert-type' => 'error']);
        }
        return $sale;
    }

    public function validation($request, $id = null)
    {
        $validation = [ 
            'customer_phone' => ['required'], 'reference_id' => ['required'], 'price' => ['required', 'numeric'], 
            'sector' => ['required'], 'block' => ['required'], 'road' => ['required'], 
            'plot' => ['required'], 'kata' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'], 
            'saledate' => ['required'], 'type' => ['required'],
        ];
        if(!is_null($id)) $validation['comment'] = ['required'];
        return $request->validate($validation);
    }
}