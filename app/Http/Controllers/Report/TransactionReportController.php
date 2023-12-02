<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\BankName;
use App\Models\BankTransaction;
use App\Models\Payment;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionReportController extends Controller
{
    public function validation($request)
    {
        $rules['startDate'] = 'required';
        $rules['endDate'] = 'required';
        $customMessages['startDate.required'] = 'From Date is required!';
        $customMessages['endDate.required'] = 'to Date Email is required!';
        if(!in_array($request->input('type'), ['shareholders', 'deposit', 'expense'])) {
            $rules['user_id'] = 'required';
            $customMessages['user_id.required'] = 'Undefined User!';
        }
        return $this->validate($request, $rules, $customMessages);
    }

    public function transactionReport($request, $data)
    {
        list($data['startDate'], $data['endDate']) = Report::dateSplit($request->daterange);    
        $input = $request->all();
        
        $transactions = Transaction::query();
        $relations = [
            'payment', 
            'payment.sale', 
            'payment.sale.shareholder', 
            'payment.sale.agent'
        ];
        $transactions = $transactions->with($relations);
        if(isset($input['user_id'])) {
            $data['user'] = $user = UserDetail::find($input['user_id']);
            $transactions = $transactions->where('user_details_id', $input['user_id']);
            $data['heading'] = "<h4>Transaction list of ". ucfirst($user->role_name). ': '. $user->name. '</h4>';
        } else {
            $data['heading'] = "<h4>Transaction list of All</h4>";
        }
        if(!isset($input['alldata'])) {
            $transactions = $transactions->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')]);
        }
        
        $data['transactions'] = $transactions = $transactions->get();
        // dd($transactions);
        if(isset($input['alldata']) && (count($transactions)>0)) {
            $data['startDate'] = $transactions->first()->created_at;
            $data['endDate'] = $transactions->last()->created_at;
        }
        $data['total_commission'] = $transactions->where('status', 1)->sum('amount');
        $data['total_withdraw'] = 0;
        $data['balance'] = 0;
        $data['title'] = 'Transaction List';
        
        $data['page'] = 'report.transaction'; //view('report.transaction')
        $data['balance'] = 0;
        return view('report.view', $data);
    }

    public function depositReport(Request $request)
    {
        $rules['startDate'] = 'required';
        $rules['endDate'] = 'required';
        $customMessages['startDate.required'] = 'From Date is required!';
        $customMessages['endDate.required'] = 'to Date Email is required!';
        $data = $this->validate($request, $rules, $customMessages);;
        $data['deposits'] = Payment::query()->with('sale', 'bank_transaction')->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')])->get();
        $data['title'] = 'Deposit List';
        $data['heading'] = "<h4>Deposit Report </h4>";
        $data['page'] = 'report.deposit'; //view('report.deposit')
        return view('report.view', $data);
    }

    public function withdrawReport(Request $request)
    {
        $data = $this->validation($request);
        $user_id = $request->get('user_id');
        $data['user']= $user = UserDetail::find($user_id);
        $withdraws = Transaction::query()->where(['user_details_id' => $user_id, 'status' => 0]);
        $withdraws = $withdraws->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')]);
        $data['withdraws'] = $withdraws->get();
        $data['title'] = 'Withdraw List';
        $data['heading'] = "<h4>Withdraw list of ". ucfirst($user->role_name). ': '. $user->name. '</h4>';
        $data['total'] = $withdraws->sum('amount');
        $data['page'] = 'report.withdraw'; //view('report.withdraw')
        return view('report.view', $data);
    }

    public static function allTransactionReport($request) {
        list($data['startDate'], $data['endDate']) = Report::dateSplit($request->daterange);
        $data['bankNames'] = $bankNames = BankName::query()->with('bankInfos:id,bank_name_id,amount,account_id')->select(['id', 'name'])->orderby('id', 'asc')->get();
        $bankTransactions = BankTransaction::query()->with(['bank_info:id,bank_name_id,amount,account_id', 'bank_info.bankname:id,name']);
        $bankTransactions = $bankTransactions->where('date', '<=', Carbon::parse($data['endDate']));
        $bankTransactions = $bankTransactions->get();
        $initialAmounts = [];
        $closingAmounts = [];
        
        $data['totalInitialAmounts'] = 0;
        $data['totalClosingAmount'] = [
            'in' => 0,
            'out' => 0,
            'balance' => 0
        ];
        foreach($bankNames as $bankName) {
            foreach($bankName->bankInfos as $bankInfo) {
                list($initialAmounts[$bankInfo->id], $data['totalInitialAmounts']) = self::initialAmount($bankName, $bankTransactions, $bankInfo, $data['startDate'], $data['totalInitialAmounts']);
                $closingAmounts[$bankInfo->id] = [
                    'in' => 0,
                    'out' => 0,
                    "bank_name_id" => $bankName->id,
                    "bank_info_id" => $bankInfo->id,
                    "bank_name" => $bankName->name,
                    'account_id' => $bankInfo->account_id,
                    'balance' => 0
                ];  
            }
        }
        $data['closingAmounts'] = $closingAmounts;
        $data['initialAmounts'] = $data['beginingAmounts'] = $initialAmounts;
        $data['bankTransactions'] = $bankTransactions->whereBetween('date', [$data['startDate'], Carbon::parse($data['endDate'])]);
        $data['title'] = 'Transaction List';
        $data['heading'] = "<h4>Transaction list Report</h4>";
        $data['sl'] = 0;
        return view('report.transaction.allTransaction', $data);
    }

    public static function initialAmount($bankName, $bankTransactions, $bankInfo, $startDate, $totalAmount) {
        $initialAmounts['account_id'] = $bankInfo->account_id;
        $initialAmounts['bank_name_id'] = $bankName->id;
        $initialAmounts['bank_info_id'] = $bankInfo->id;
        $initialAmounts['bank_name'] = $bankName->name;
        $initialAmounts['amount'] = $bankTransactions->where('bank_info_id', $bankInfo->id)->where('date', '<', Carbon::parse($startDate))->sum('amount');
        $totalAmount = $totalAmount + $initialAmounts['amount'];
        return [$initialAmounts, $totalAmount];
    }
}
