<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Report\SaleReportController;
use App\Http\Controllers\Report\TransactionReportController;
use App\Models\BankTransaction;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\ExpenseItem;
use App\Models\Payment;
use App\Models\Report;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{

    public function search(Request $request) {
        $type = $request->get('type');
        if($type == "expense") {
            $data['expenseItems'] = ExpenseItem::get(['id', 'title']);
            return view('report.search.expense', $data)->render();
        } elseif($type == "salary") return view('report.salary')->render();
        else if($type == "allexpenseday") return view('report.allexpenseday')->render();
        else if ($type == "allTransaction") return view('report.search.allTransaction')->render();
        else if($type == "commissionSingle") return $this->commissionSingle();
        else if($type == "commissionMultiple") return $this->commissionMultiple();
        else return view('report.search.userdetails', ['type' => $type])->render();
    }

    public function commissionMultiple() {
        $data['users'] = UserDetail::query()->whereIn('role', [UserDetail::USER['shareholder'], UserDetail::USER['agent']])->select('id', 'name', 'phone', 'account_id', 'role')->get();
        $data['roles'] = [UserDetail::USER['shareholder'] => 'shareholder', UserDetail::USER['agent'] => 'agent'];
        return view('report.search.commissionMultiple', $data)->render();
    }

    public function commissionSingle() {
        $data['roles'] = ['customer' => 'Customer', 'agent' => 'Agent', 'shareholder' => 'Master Agent'];
        $data['users'] = Customer::query()->select(['id', 'name', 'phone'])->get();
        return view('report.search.commissionSingle', $data)->render();
    }

    public function index() //view('report.index')
    {
        $data['title'] = 'Reports';
        $data['page'] = 'report.index';

        return view('home', $data);
    }

    public function all(Request $request) {
        
        if(request()->isMethod('GET')) return redirect()->route('report.index');
        if($request->input('type') == 'sale') return $this->{$request->input('saleInput').'Report'}($request);
        
        return $this->{$request->input('type').'Report'}($request); 
    }

    public function allexpensedayReport(Request $request) {
        $data['startDate'] = $request->get('startDate');
        $data['endDate'] = $request->get('endDate');
        $expenses = Expense::query()->with(array_merge(['type'], BankTransaction::JOINTABLES));
        $expenses = $expenses->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')]);
        $data['expenses'] = $expenses->get();
        $data['heading'] = "<h4>Expense's list of Day ".getdateformat($data['startDate'])."</h4>";
        $data['title'] = 'Expense List';
        $data['page'] = 'report.allexpensedayReport'; //view('report.allexpensedayReport')
        return view('report.view', $data);
    }

    public function salaryReport(Request $request) {
        $data = $input = $request->validate(['startDate' => 'required', 'user_id' => 'required']);
        $data['endDate'] = now()->format('Y-m-d');
        $startDate = new DateTime($input['startDate']);
        $endDate = new DateTime(now());

        $interval = DateInterval::createFromDateString('1 month');
        $data['periods'] = new DatePeriod($startDate, $interval, $endDate);
        
        $data['user_details'] = UserDetail::find($data['user_id']);
        $salaries = Salary::query()->with(BankTransaction::JOINTABLES)->where('user_detail_id', $input['user_id']);
        $salaries = $salaries->whereNull('type_id');
        $salaries = $salaries->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')]);
        $data['salaries'] = $salaries->get();

        $data['heading'] = "<h4>Salaries list of ".$data['user_details']->name."</h4>";
        $data['title'] = 'Salaries List';
        $data['page'] = 'report.salaryReport'; //view('report.salaryReport')
        return view('report.view', $data);
    }

    public function expenseReport(Request $request) {
        $rules = [ 'expense_item_id' => 'required' ];
        $messeges = [ 'expense_item_id.required' => 'Expense Item is required' ];
        $data = $this->validation($request->all(), $rules, $messeges);
        list($data['startDate'], $data['endDate']) = Report::dateSplit($request->daterange);

        $type = ExpenseItem::find($request->get('expense_item_id'));
        $expenses = Expense::query()->with(BankTransaction::JOINTABLES)->where('expense_item_id', $request->get('expense_item_id'));
        $expenses = $expenses->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')]);
        $data['expenses'] = $expenses->get();
        $data['heading'] = "<h4>Expense's list of Type " . $type->title . "</h4>";
        $data['title'] = 'Expense List';
        $data['page'] = 'report.expenseReport'; //view('report.expenseReport')
        return view('report.view', $data);
    }

    public function customersReport(Request $request)
    {
        list($rules, $messeges) = $this->userValidation();
        $data = $this->validation($request->all(), $rules, $messeges);
        list($data['startDate'], $data['endDate']) = Report::dateSplit($request->daterange);
        $data['shareholder'] = $user = UserDetail::where('id', $request->get('user_id'))->firstorfail();
        if(!in_array($user->role_name, ['Master Agent', 'Agent'])) return redirect()->back()->with(['message' => 'No Report for '.ucfirst(str_replace('-', ' ', $user->role_name)), 'alert-type' => 'warning']);
        $role = ($user->role_name == 'Agent') ? 'agent' : 'shareholder';
        $customers = Sale::select('customer_id', DB::raw('SUM(kata) as total_amount'))->groupBy('customer_id');
        $data['customers'] = $customers->where($role.'_id', $user->id)
                                ->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')])
                                ->with('customer')->get();
        $data['heading'] = "<h4>Customer's list of ". ucfirst($role). ': '. $user->name. '</h4>';
        $data['title'] = 'Customer List';
        $data['page'] = 'report.customer'; //view('report.customer')
        return view('report.view', $data);
    }

    public function userValidation() {
        $rules = [ "user_id" => 'required' ];
        $messages = [ 'user_id.required' => 'Undefined User!' ];
        return [$rules, $messages];
    }

    public function validation($input, $extraRules = null, $extraMsg = null)
    {
        $rules['daterange'] = 'required';
        $customMessages['daterange.required'] = 'Date range is required!';
        if(!empty($extraRules)) {
            $rules = array_merge($rules, $extraRules);
        }
        if(!empty($extraMsg)) {
            $customMessages = array_merge($customMessages, $extraMsg);
        }
        return Validator::validate($input, $rules, $customMessages);
    }

    public function saleReport(Request $request) {
        list($rules, $messeges) = $this->userValidation();
        $data = $this->validation($request->all(), $rules, $messeges);
        return (new SaleReportController)->saleReport($request, $data); 
    }

    public function agentsReport(Request $request)
    {
        list($rules, $messeges) = $this->userValidation();
        $data = $this->validation($request->all(), $rules, $messeges);
        $data['shareholder']  = $user = UserDetail::where('id', $request->get('user_id'))->firstorfail();
        list($data['startDate'], $data['endDate']) = Report::dateSplit($request->daterange);
        if(!in_array($user->role_name, ['Master Agent', 'Agent'])) return redirect()->back()->with(['message' => 'No Report for '.ucfirst(str_replace('-', ' ', $user->role_name)), 'alert-type' => 'warning']);
        $data['agents'] = UserDetail::with('sales')->where('reference_id', 'like', '%,'. $request->get('user_id'))
                            ->orWhere('reference_id', 'like', '%,'.$request->get('user_id').',')
                            ->orWhere('reference_id', 'like', '%,'.$request->get('user_id').',%')
                            ->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')])->get();
        
        $data['title'] = "Agent's List";
        $data['heading'] = "<h4>Agent's information</h4>";
        $data['heading'] = "<h4>Agent's list of ". ucfirst($user->role_name). ': '. $user->name. '</h4>';
        $data['page'] = 'report.agent'; //view('report.agent')
        return view('report.view', $data);
    }

    public function agentsDetailsReport(Request $request)
    {
        $data = $this->validation($request);
        $startDate = $data['startDate']; 
        $endDate= $data['endDate'];
        $data['shareholder']  = $user = UserDetail::where('id', $request->get('user_id'))->firstorfail();
        if($user->role_name != 'Master Agent') return redirect()->back()->with(['message' => 'No Report for '.ucfirst(str_replace('-', ' ', $user->role_name)), 'alert-type' => 'warning']);
        
        $data['agents'] = $agents = UserDetail::query()->with(['sales', 'transactions' => function($q) use ($startDate, $endDate){
            $q->whereBetween('created_at', [$startDate, Carbon::parse($endDate. ' 24:00:00')]);
        }, 'refer_account:account_id,id'])
        ->where('reference_id', 'like', '%,'. $request->get('user_id'))
        ->orWhere('reference_id', 'like', '%,'.$request->get('user_id').',')
        ->orWhere('reference_id', 'like', '%,'.$request->get('user_id').',%')
        ->whereBetween('created_at', [$startDate, Carbon::parse($endDate. ' 24:00:00')])->get();
        $ids = $agents->pluck('id');
        $data['refer_users'] = UserDetail::whereIn('reference_id', function($query) use ($ids) {
                $query->select('reference_id')
                    ->from('user_details');
                foreach($ids as $id) {
                    $query->orWhere('reference_id', 'like', $id.',%')->orWhere('reference_id', 'like', '%,'.$id.',%');
                }
            })
            ->pluck('reference_id');
        $data['title'] = "Agent's List";
        $data['heading'] = "<h4>Agent's information</h4>";
        $data['heading'] = "<h4>Agent's list of ". ucfirst($user->role_name). ': '. $user->name. '</h4>';
        $data['page'] = 'report.agentdetails'; //view('report.agentdetails')
        return view('report.view', $data);
    }

    public function shareholdersReport(Request $request) {
        // list($rules, $messeges) = $this->userValidation();
        return (new SaleReportController)->shareholdersReport($request); 
    }

    public function salePaymentDetailsReport(Request $request) {
        // list($rules, $messeges) = $this->userValidation();
        $data = $this->validation($request->all());
        return (new SaleReportController)->salePaymentDetailsReport($request, $data);
    }

    public function depositReport(Request $request)
    {
        $data = $this->validation($request->all());
        list($data['startDate'], $data['endDate']) = Report::dateSplit($request->daterange);
        $data['deposits'] = Payment::query()->with('sale', 'bank_transaction')->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')])->get();
        $data['title'] = 'Deposit List';
        $data['heading'] = "<h4>Deposit Report </h4>";
        $data['page'] = 'report.deposit'; //view('report.deposit')
        $data['total'] = 0;
        return view('report.view', $data);
    }

    public function withdrawReport(Request $request)
    {
        $data = $request->all();
        list($rules, $messeges) = $this->userValidation();
        Validator::validate($data, $rules, $messeges);
        
        if(!isset($data['alldata'])) {
            list($data['startDate'], $data['endDate']) = Report::dateSplit($request->daterange);
        }
        $withdraws = Transaction::query();
      
        if(!empty($request->get('user_id'))) {
            $user_id = $request->get('user_id');
            $data['user']= $user = UserDetail::find($user_id);
            $withdraws = $withdraws->where('user_details_id' , $user_id);
            $data['heading'] = "<h4>Withdraw list of ". ucfirst($user->role_name). ': '. $user->name. '</h4>';
        } else {
            $data['heading'] = "<h4>All Withdraw lists</h4>";
        }
        $withdraws = $withdraws->where( 'status' , 0);
        if(!isset($data['alldata'])) {
            $withdraws = $withdraws->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')]);
        }
        $data['withdraws'] = $withdraws = $withdraws->get();
        
        if(isset($data['alldata']) && (count($withdraws)>0)) {
            $data['startDate'] = $withdraws->first()->created_at;
            $data['endDate'] = $withdraws->last()->created_at;
        }

        $data['title'] = 'Withdraw List';
        if(count($withdraws)>0) {
            $data['total'] = $withdraws->sum('amount');
        } else {
            $data['total'] = 0;
        }
        $data['page'] = 'report.withdraw'; //view('report.withdraw')
        return view('report.view', $data);
    }
    
    public function saleTransactionReport(Request $request) {
        $data = $this->validation($request->all());
        return (new TransactionReportController)->transactionReport($request, $data);
    }

    public function allTransactionReport(Request $request) { return TransactionReportController::allTransactionReport($request); }

    public function commissionSingleReport(Request $request) {
        list($rules, $messeges) = $this->userValidation();
        $newRule = [
            'sale_id' => ['required']
        ];
        $newMessage = [
            'sale_id.required' => 'Sale is required'
        ];
        $rules = array_merge($rules, $newRule);
        $messeges = array_merge($messeges, $newMessage);
        $data = $this->validation($request->all(), $rules, $messeges);
        return (new CommissionReportController)->commissionSingleReport($request, $data);
    }

    public function commissionMultipleReport(Request $request) {
        list($rules, $messeges) = $this->userValidation();
        $this->validation($request->all(), $rules, $messeges);
        return (new CommissionReportController)->commissionMultipleReport($request);
    }
}
