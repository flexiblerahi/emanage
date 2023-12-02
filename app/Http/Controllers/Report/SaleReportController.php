<?php

namespace App\Http\Controllers\Report;

use App\DataTables\SalePaymentReportDataTable;
use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Payment;
use App\Models\Report;
use App\Models\Sale;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SaleReportController extends Controller
{

    public function salePaymentList(SalePaymentReportDataTable $dataTable)
    {
        $data['page'] = 'index';
        $data['title'] = 'Sale Payment Report';
        return $dataTable->render('home', $data);
    }
    
    public function saleReport($request, $data)
    {
        list($data['startDate'], $data['endDate']) = Report::dateSplit($request->daterange);
        $data['user'] = $user = UserDetail::where('id', $request->get('user_id'))->firstorfail();
        if(!in_array($user->role_name, ['Master Agent', 'Agent'])) return redirect()->back()->with(['message' => 'No Report for '.ucfirst(str_replace('-', ' ', $user->role_name)), 'alert-type' => 'warning']);
        $role = ($data['user']->role_name == 'Agent') ? 'agent' : 'shareholder'; 
        $data['sales'] = Sale::where($role.'_id', $data['user']->id)->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')])->with('customer')->get();
        $data['title'] = "Sale's List";
        $data['heading'] = "<h4>Sale's list of ". ucfirst($user->role_name). ': '. $user->name. '</h4>';
        $data['page'] = 'report.sale'; //view('report.sale')
        
        return view('report.view', $data);
    }

    public function salePaymentDetailsReport($request, $data)
    {
        $input = $request->all();

        
        list($data['startDate'], $data['endDate']) = Report::dateSplit($request->daterange);
        $sales = Sale::query();
        if(isset($input['user_id'])) {
            $data['user'] = $user = UserDetail::where('id', $input['user_id'])->firstorfail();
            if(!in_array($user->role_name, ['Master Agent', 'Agent'])) return redirect()->back()->with(['message' => 'No Report for '.ucfirst(str_replace('-', ' ', $user->role_name)), 'alert-type' => 'warning']);    
            $role = ($data['user']->role_name == 'Agent') ? 'agent' : 'shareholder'; 
            $sales = $sales->where($role.'_id', $data['user']->id);
            $data['heading'] = "<h4>Sale's list of ". ucfirst($user->role_name). ': '. $user->name. '</h4>';
        } else {
            $data['heading'] = "<h4>Sale's list of All</h4>";
        }
        if(!isset($input['alldata'])) {
            $sales = $sales->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')]);
        }
        $sales = $sales->with('customer');
        $data['sales'] = $sales = $sales->get();
        if(isset($input['alldata']) && (count($sales)>0)) {
            $data['startDate'] = $sales->first()->created_at;
            $data['endDate'] = $sales->last()->created_at;
        }
        $data['title'] = "Sale's List";
        
        $data['page'] = 'report.sale'; //view('report.sale')
        return view('report.view', $data);
    }

    public function salePaymentReport($id)
    {
        $data = Sale::getDetails($id);
        $data['startDate'] = Carbon::now();// $request->get('startDate'); 
        $data['endDate'] = Carbon::now(); // $request->get('endDate');
        $data['payments'] = Payment::with('bank_transaction', 'bank_transaction.bank_info', 'bank_transaction.bank_info.entrier', 'bank_transaction.bank_info.bankname:id,name', 'transactions:id,user_details_id,amount,model_type,model_id')->where('sale_id', $id)->get();
        
        $data['heading'] = "<h4>Sale's Payment</h4>";
        $data['title'] = "Sale's Payment";
        
        $data['sl'] = 0;
        $users = [];
        foreach($data['commission_names'] as $key => $item) {
            foreach(range(1,3) as $hand) {
                $users[$key.'_hand_'.$hand] = 0;
                $users['hand_'.$hand.'_total'] = 0;
            }
            $users[$key.'_shareholder'] = 0;
            $users['shareholder_total'] = 0;
            $users[$key.'_company'] = 0;
            $users['company_total'] = 0;
            $users[$key.'_amount'] = 0;
            $users['amount_total'] = 0;
        }
        $data['users'] = $users;
        return view('report.sale.individualdetails', $data);
    }

    public function shareholdersReport($request) {
        list($data['startDate'], $data['endDate']) = Report::dateSplit($request->daterange);
        $sales = Sale::select('shareholder_id', DB::raw('SUM(kata) as total_amount'))->groupBy('shareholder_id')->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')]);
        $data['shareholders'] = $sales->with('shareholder')->get();
        $data['title'] = "Total Sale Report";
        $data['heading'] = "<h4>Total Sale Report</h4>";
        $data['page'] = 'report.shareholder'; //view('report.shareholder')
        return view('report.view', $data);
    }

    public function list(Request $request)
    {
        $sale = Sale::query();
        if($request->input('role') == 'customer') {
            $sale = $sale->where('customer_id', $request->input('user_id'));
        } else if($request->input('role') == 'agent') {
            $sale = $sale->where('agent_id', $request->input('user_id'));
        } else {
            $sale = $sale->where('shareholder_id', $request->input('user_id'));
        }
        $sale = $sale->select(['id', 'price', 'sector', 'block', 'road', 'plot', 'kata', 'date']);
        $sale = $sale->get();
        return response()->json($sale);

    }
}
