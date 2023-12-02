<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentDataTable;
use App\DataTables\SaleDataTable;
use App\Models\BackupPayment;
use App\Models\BankInfo;
use App\Models\BankName;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositPaymentController extends Controller
{
    public function __construct() {
        $this->middleware('permission:payment-list|new-payment|old-payment-list|old-payment-edit', ['only' => ['index', 'oldpayment', 'create', 'store', 'edit', 'update']]);
        $this->middleware('permission:new-payment', ['only' => ['create', 'store']]);
        $this->middleware('permission:old-payment-list|old-payment-edit', ['only' => ['oldpayment', 'edit', 'update']]);
        $this->middleware('permission:old-payment-edit', ['only' => ['update', 'edit']]);
    }

    public function index(SaleDataTable $dataTable) //view('report.modalform')
    {
        $data['page'] = 'index';
        $data['title'] = 'Sale Payment';
        $data['modalForm'] = 'report.modalform';
        $data['route'] = route('report.deposit');
        $data['id'] = 'depositId';
        return $dataTable->render('home', $data);
    }

    public function oldpayment(PaymentDataTable $dataTable, Request $request) //view('index') // view('payment.landDetails')
    {
        $data['page'] = 'index';
        $data['title'] = 'Sale Payment History';
        $data['modal'] = 'payment.landDetails';
        $data['modalClass'] = "border mb-3";
        $data['sale'] = Sale::findOrFail($request->get('sale'));
        return $dataTable->render('home', $data);
    }

    public function create(Request $request) //view('payment.create')
    {
        $data = Sale::getDetails(null, $request->get('sale'));
        $data['bankNames'] = BankName::where('status', 1)->get(['id', 'name']);
        $data['title'] = 'New Sale Payment';
        $data['page'] = 'payment.create';
        return view('home', $data);
    }
    
    public function edit($id) //view('payment.edit')
    {
        $data['payment'] = Payment::with('bank_transaction', 'bank_transaction.bank_info', 'bank_transaction.bank_info.entrier', 'bank_transaction.bank_info.bankname:id,name')->findorfail($id);
       
        $data = array_merge($data, Sale::getDetails($data['payment']->sale_id));
        $data = array_merge($data, bankDetails($data['payment']));
        $data['title'] = 'Edit Sale Payment';
        $data['page'] = 'payment.edit';
        return view('home', $data);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::with('bank_transaction', 'bank_transaction.bank_info')->findorfail($id);
        return $this->uporsave($request, $payment);
    }

    public function store(Request $request)
    {
        return $this->uporsave($request, new Payment);
    }

    public function uporsave($request, $payment)
    {
        $input = $this->validation($request);
        $input['amount'] = (double) $input['amount'];
        $input['date'] = formatdate($input['pay_at']);
        $sale = Sale::query()->where('uuid', $input['sale'])->firstOrFail();
        $commissions = json_decode($sale->commission, 1);
        $commissions = $commissions[$input['type']];
        foreach($commissions as $key => $commission) {
            if($commission['hand'] == "shareholder") {
                $commission['account_id'] = $commission['shareholder_id'];
                unset($commission['shareholder_id']);
            } else {
                $commission['account_id'] = $commission['agent_id'];
                unset($commission['agent_id']);
            }
            $commissions[$key] = $commission;
            $referencesIds[] = $commission['account_id'];
        }
        DB::beginTransaction();
        try {
            if(isUpdate()) {
                BackupPayment::store($payment, $input['comment']);
                BankInfo::updateOldPayment($payment->bank_transaction->amount, $payment->bank_transaction->bank_info);
            }
            $userDetails = UserDetailController::updateAmount($commissions, $referencesIds, $input['amount'], $payment);
            //payment create or update
            $payment->sale_id = $sale->id;
            $payment->commission = json_encode($userDetails['commissions']);
            $payment->commission_type = $input['type'];
            $payment->percentage = $userDetails['total_commission'];
            $payment->entry = entry();
            $payment->save();
            $input['model_type'] = get_class($payment);
            $input['model_id'] = $payment->id;
            $input['status'] = 1;
            Transaction::store($input, $userDetails['transactions']);
            BankTransactionController::upstore($input);
            BankInfo::updateAmount($input);
            DB::commit();
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollback();
            return response()->json(['message' => 'Payment Failed. Please Try Again!', 'alert-type' => 'danger'], 422);
        }
        $msg = (isUpdate()) ? 'Deposit Update Successfully' : 'Deposit Successfully';
        return response()->json(['message' => $msg, 'alert-type' => 'success']);
    }

    public function validation($request)
    {
        $validation = [ 'pay_at' => ['required'], 
            'type' => ['required'], 'bank_type' => ['required'], 'sale' => ['required'],
            'other' => ['required'] ];
        $validation = array_merge($validation, BankTransactionController::validation($request));
        return $request->validate($validation);
        
    }
}