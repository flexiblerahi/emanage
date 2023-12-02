<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use App\Rules\UniquePhoneForRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function register()
    {
        $data['roles'] = Role::whereIn('id', [2, 3])->get(['id', 'name']); //['2' => 'Master Agent', '3' => 'Accountant'];
        $data['page_title'] = 'User Register';
        return view('auth.register', $data);
    }

    public function login()
    {
        if(auth()->check()) return redirect()->route('home');
        $data['page_title'] = 'User Login';
        return view('auth.login', $data);
    }

    protected function usercreate(Request $request)
    {
        $roles = Role::findorfail($request->input('role'))->toArray();//['2' => 'Master Agent', '3' => 'Accountant'];
        $input = $request->validate([
            'name' => [ 'required' ],
            'phone' => [ 'required', new UniquePhoneForRole($roles['id'], $roles['name']) ],
            'account_id' => [ 'nullable' ],
            'email' => [ 'required', 'email', 'unique:users,email' ],
            'password' => ['required', 'same:confirm_password', 'min:4'],
            'role' => [ 'required' ]
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([ 'email' => $input['email'], 'password' => Hash::make($input['password']) ]);
            $user->assignRole($roles['name']);
            UserDetail::create([ 'account_id' => $input['account_id'], 'user_id' => $user->id, 'name' => $input['name'], 'phone' => $input['phone'], 'role' => $roles['id'] ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();// Something went wrong, rollback the transaction
            return redirect()->route('login')->with([ 'message' => 'error : ' . $e, 'alert-type'=>'error' ]);
        }
        return redirect()->route('login')->with(['message'=>'please wait for account confirmation','alert-type'=>'warning']);
    }

    public function checkLogin(Request $request)
    {
        $input= $request->validate([ 'email' => 'required|email', 'password' => 'required' ]); 
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']], $request->get('remember'))) {
            session()->put(['message'=>'login Successfully','alert-type'=>'success']);
            if(auth()->user()->status == 0) {
                auth()->logout();
                session()->put(['message'=>'Your Account not active yet.','alert-type'=>'error']);
                return back();
            }
            return redirect()->route('home');
        }
        session()->put(['message'=>'credencial does not match','alert-type'=>'error']);
        return back();
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
