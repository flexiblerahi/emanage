<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgentReportController extends Controller
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
    
    public function agentsReport(Request $request)
    {
        $data = $this->validation($request);
        $data['shareholder']  = $user = UserDetail::where('id', $request->get('user_id'))->firstorfail();
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
}
