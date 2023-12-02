<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Report;
use App\Models\Sale;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommissionReportController extends Controller
{
    public function commissionSingleReport($request, $data) {
        $relations = [$request->input('role') => function($query) {
            $query->select('id', 'name', 'phone', 'account_id');
        }];

        if($request->input('role') != 'customer') {
            $customer = ['customer' => function($query) {
                $query->select('id', 'name', 'phone', 'account_id');
            }];
            $relations = array_merge($relations, $customer);
        }

        $sale = Sale::query()->with($relations);

        $sale = $sale->where('id', $request->input('sale_id'));
        
        $sale = $sale->first();
        if(is_null($sale)) abort(404);
        else $data['sale'] = $sale->toArray(); 
        $data['referUser'] = $data['sale'][$request->input('role')];
        list($data['payments'], $data['startDate'], $data['endDate']) = Payment::getPayments($request->all());

        $data['title'] = "Commission Summary Report (single land)";
        $data['heading'] = "<h4>Commission Summary Report (single land)</h4>";

        $data['requestRole'] = $request->input('role');
        $data['requestAll'] = $request->input('alldata') ?? 'Off';
        $data['total_col'] = [
            'total_hand_1' => 0,
            'total_hand_2' => 0,
            'total_hand_3' => 0,
            'total_shareholder' => 0,
            'total_deposit_amount' => 0
        ];
        return view('report.sale.commissionSingle', $data);
    }

    public function commissionMultipleReport($request)
    {   
        $data = array();
        $data['title'] = "Commission Summary Report (Multiple lands)";
        $data['heading'] = "<h4>Commission Summary Report (Multiple lands)</h4>";
        $data['requestAll'] = $request->input('alldata') ?? 'Off';
        if($data['requestAll'] == 'Off') {
            list($data['startDate'], $data['endDate']) = Report::dateSplit($request->daterange);
        }

        $refers = explode('-', $request->input('user_id')); //refers[0] = shareholder/agent

        
        $data['referUser'] = $referUser = UserDetail::query()->select('account_id', 'name', 'phone', 'id')->find($refers[1]);
        $sales = Sale::query();

        $relations = [
            'customer' => function($query) {
                $query->select('id', 'name', 'phone', 'account_id');
            },
            'payments' => function ($query) {
                $query->select('id', 'commission_type', 'sale_id');
            },
            'payments.transactions' => function ($query) use ($referUser) {
                $query->select('id', 'model_id', 'model_type', 'amount', 'user_details_id');
                $query->where(['user_details_id' => $referUser->id]);
            },
            'payments.bank_transaction' => function ($query) {
                $query->select('id', 'amount', 'date', 'status', 'model_type', 'model_id');
            },
        ];
        $sales = $sales->with($relations);
        $sales = $sales->where($refers[0].'_id', $refers[1]);
        if($data['requestAll'] == 'Off') {
            $sales = $sales->whereHas('payments.bank_transaction', function ($query) use ($data) {
                $query = $query->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')]);
            });
        }
        $sales = $sales->select('id', 'price', 'sector', 'block', 'road', 'plot', 'kata', 'customer_id');
        $data['sales'] = $sales->get();
        // if(($data['requestAll'] == 'on') && (count($data['sales']->payments) > 0)) {
        //     $data['startDate'] = $data['sales']->payments->first()->bank_transaction->date;
        //     $data['endDate'] = $data['sales']->payments->end()->bank_transaction->date;
        //     dd($data['startDate'], $data['endDate']);
        // }
        $data['deposit_final_total'] = 0;
        $data['commission_final_total'] = 0;
        return view('report.sale.commissionMultiple', $data);
    }

    public function list(Request $request)
    {
        $role = $request->input('role');
        if($role == "customer") {
            $data['users'] = Customer::query()->select(['id', 'name', 'phone'])->get();
        } else {
            $data['users'] = UserDetail::query()->select(['id', 'name', 'phone'])->where('role', UserDetail::USER[$role])->get();
        }
        return response()->json($data);
    }    
}
