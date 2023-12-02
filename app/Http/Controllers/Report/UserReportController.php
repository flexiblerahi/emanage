<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserReportController extends Controller
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
    
    public function userInfo(Request $request)
    {
        $query = $request->get('query');
        $roles = UserDetail::USER;
        $user_query = UserDetail::query()->where('status', 1)->whereIn('role', array($roles['agent'], $roles['shareholder']));
        $data['users'] = $user_query->where('phone', 'like', $query. '%')->orWhere('account_id', 'like', $query. '%')->select('id', 'name', 'account_id', 'phone')->get();
        
        if(count($data['users']) == 1) {
            $user = $data['users']->first();
            $user = UserDetail::find($user->id);
            $data['user'] = $user;
            $data['roles'] = array_flip(UserDetail::USER);
            return view('report.userInfo', $data);
        }
        return response()->json($data);
    }

    
    public function customersReport(Request $request)
    {
        $data = $this->validation($request);
        $data['shareholder'] = $user = UserDetail::where('id', $request->get('user_id'))->firstorfail();
        if(!in_array($user->role_name, ['Master Agent', 'Agent'])) return redirect()->back()->with(['message' => 'No Report for '.ucfirst(str_replace('-', ' ', $user->role_name)), 'alert-type' => 'warning']);
        $role = ($user->role_name == 'Agent') ? 'agent' : 'shareholder';
        $customers = Sale::select('customer_id', DB::raw('SUM(kata) as total_amount'))->groupBy('customer_id');
        $data['customers'] = $customers->where($role.'_id', $user->id)->whereBetween('created_at', [$data['startDate'], Carbon::parse($data['endDate']. ' 24:00:00')])->with('customer')->get();
        $data['heading'] = "<h4>Customer's list of ". ucfirst($role). ': '. $user->name. '</h4>';
        $data['title'] = 'Customer List';
        $data['page'] = 'report.customer'; //view('report.customer')
        return view('report.view', $data);
    }
}
