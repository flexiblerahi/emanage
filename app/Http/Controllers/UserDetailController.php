<?php

namespace App\Http\Controllers;

use App\DataTables\UserDetailDataTable;
use App\Models\Commission;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserDetailController extends Controller
{
    private $user;
    
    public function __construct() {
        $this->user = request()->get('user');
        if(in_array($this->user, ['accountant', 'shareholder'])) {
            $this->middleware('permission:'.$this->user.'-list|'.$this->user.'-view', ['only' => ['index', 'show']]);
        } else {
            $this->middleware('permission:'.$this->user.'-list|'.$this->user.'-view|new-'.$this->user.'|'.$this->user.'-edit', ['only' => ['index', 'show', 'edit', 'updatestatus', 'update', 'store', 'create']]);
            $this->middleware('permission:'.$this->user.'-edit', ['only' => ['edit', 'update', 'updatestatus']]);
            $this->middleware('permission:new-'.$this->user, ['only' => ['store', 'create']]);
        }
        $this->middleware('permission:'.$this->user.'-view', ['only' => ['show']]);
        if(!key_exists($this->user, UserDetail::USER)) abort(404, 'Unknown User');
    }

    public function index(UserDetailDataTable $userDetailDataTable) //view('index') view('report.modalform') view('modules.modal')
    {
        $data['page'] = 'index';
        $data['title'] = UserDetail::TITLE[$this->user];
        if(auth()->user()->can($this->user.'-view')) {
            $data['modal'] = 'modules.modal';
            $data['modal_title'] = UserDetail::TITLE[$this->user].' Detail';
            $data['modal_type'] = $this->user;
        }
        return $userDetailDataTable->render('home', $data);
    }

    public function show($id) //view('accountant.show') //view('customer.show') //view('shareholder.show') //view('agent.show')
    {
        if(request()->ajax()) {
            $data[$this->user] = UserDetail::find($id);
            return view($this->user.'.show', $data)->render();
        } return abort(404);
    }

    public function create() //view('agent.create')
    {
        $data['page'] = $this->user.'.create';
        $data['title'] = 'New '.ucfirst($this->user);
        return view('home', $data);
    }

    public function edit(string $id)//view('agent.edit') //view('customer.edit')
    {
        $data[$this->user] = UserDetail::findorfail($id);
        if($this->user == 'agent') {
            $agentId = $data['agentId'] = explode(',', $data['agent']->reference_id);
            $data['sh_agent'] = UserDetail::query()->where('id', $agentId[0])->select('id', 'role', 'name', 'phone', 'account_id')->first();
        }
        $data['page'] = $this->user.'.edit';
        $data['title'] = ucfirst($this->user).' Details Edit';
        return view('home', $data);
    }

    public function usersearch(Request $request)
    {  
        $input = $request->all();
        $data['users'] = array();
        if(is_null($input['query'])) return response()->json($data);
        $query = $input['query'];
        $data['users'] = $users = UserDetail::query()->whereIn('role', UserDetail::queryroles($input['type']))->where(function ($search) use ($query) {
            $search->where('account_id', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', $query . '%');
        })->select('id', 'role', 'name', 'phone', 'account_id', 'status')->get();
        if(count($data['users']) == 1) {
            if($input['type'] == 'agent') $data['view'] = view($this->user.'.referenceDetails', $data)->render();
            else { //['customer', 'saleCreate', 'saleEdit', 'withdraw'] == $input['type']
                $data['user'] = UserDetail::with('user')->find($data['users'][0]->id);
                if($input['type'] == 'withdraw') $data['view'] = view('withdraw.userInfo', $data)->render();
                else if($input['type'] == 'customer') $data['view'] = view('sale.customerInfo', $data)->render();
                else $data = $this->saleCommission($data);
            }
        }
        return response()->json($data);
    }

    public function saleCommission($data)
    {
        $data['rank'] = countRank($data['user']->total_kata);
        $data['commissions'] = Commission::all(['id', 'type', 'total', 'rank'.$data['rank']." as rank"]);
        if($data['user']->role == 4) { // UserDetail::USER['agent'] ==  4
            $data['referencesIds'] = referenceIds($data['user']->reference_id);
            $users = UserDetail::query()->whereIn('id', $data['referencesIds'])->select('account_id', 'role', 'name', 'phone', 'total_kata', 'id')->get();
            $data['agents'] = array();
            foreach($data['referencesIds'] as $referenceId) {
                $agent = $users->where('id', $referenceId)->where('role', 4)->first();
                if(!is_null($agent)) $data['agents'][] = $agent;
            }
            array_unshift($data['agents'], $data['user']->toArray());
            $data['referencesIds'] = array_merge([$data['user']['id']], $data['referencesIds']);
            $data['shareholder'] = $users->where('role', UserDetail::USER['shareholder'])->first()->toArray();
        }
        $data['view']= view('sale.agentInfo', $data)->render();
        return $data;
    }

    public function updatestatus(Request $request)
    {
        $user_detail = UserDetail::findorfail($request->get('id'));
        $user_detail->status = $request->get('status');
        $user_detail->save();
        if(in_array($this->user, ['accountant', 'shareholder'])) User::status($user_detail->user_id, $user_detail->status);
        return response()->json(['message' => 'Status Update Successfully', 'alert-type' => 'success']);        
    }

    public static function updateAmount($commissions, $referencesIds, $amount, $payment) { // comming from deposit payment 
        $total_commission = 0;
        $user_details = UserDetail::query()->whereIn('id', $referencesIds)->select('income', 'account_id', 'id')->get();
        if(isUpdate()) $old_transactions = Transaction::where(['model_type' => 'App\Models\Payment', 'model_id' => $payment->id])->select(['id', 'user_details_id', 'amount'])->get()->toArray();
        $transactions = array();
        foreach($user_details as $user) {
            $commission = $commissions[array_search($user->id, array_column($commissions, 'account_id'))];
            if(isUpdate()) {
                $trn_user = array_search($user->id, array_column($old_transactions, 'user_details_id'));
                $user->income = (double) $user->income - $old_transactions[$trn_user]['amount'];
            }
            $total_commission = $total_commission + $commission['percentage'];
            $cash = $amount * ($commission['percentage']/100);
            $user->income = (double) $user->income + $cash;
            $transactions[] =  ['user_details_id' => $user->id, 'amount' => $cash, 'percentage' => number_format($commission['percentage'], 2), 'balance' => $user->income];
            $user->save();
        }

        $gm = UserDetail::find(1); // gm = general manager
        if(isUpdate()) {
            $trn_user = array_search($gm->id, array_column($old_transactions, 'user_details_id'));
            $gm->income = (double) $gm->income - $old_transactions[$trn_user]['amount'];
        }
        $gm_percentage = 100 - $total_commission;
        $gmcash = $amount * ($gm_percentage/100);
        $gm->income = (double) $gm->income + $gmcash;
        $gm->save();
        $transactions[] =  ['user_details_id' => $gm->id, 'amount' => $gmcash, 'percentage' => number_format($gm_percentage, 2), 'balance' => $gm->income];
        $commissions[] = ["hand" => "general_manager", "account_id" => $gm->id, "percentage" => number_format($gm_percentage, 2)];
        return ['total_commission' => $total_commission, 'transactions' => $transactions, 'commissions' => $commissions];
    }
}