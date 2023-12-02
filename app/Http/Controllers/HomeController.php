<?php

namespace App\Http\Controllers;

use App\Models\BankInfo;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\UserDetail;

class HomeController extends Controller
{
    public function dashboard()
    {
        $data['cashAmount'] = BankInfo::query()->where('bank_name_id', 1)->first()->amount;
        $data['otherAmount'] = BankInfo::query()->whereNotIn('bank_name_id', [1])->sum('amount');
        $data['shareholder'] = UserDetail::where(['role'=> UserDetail::USER['shareholder'], 'status' => 1])->select('id', 'name', 'phone', 'income', 'total_kata')->get();
        $paymentweekly = Payment::query()->with('bank_transaction')
                            ->whereBetween('created_at', [now()->subWeek(), now()])
                            ->select('id', 'created_at')->oldest()->get();
        
        $paymentmonthly = Payment::query()->with('bank_transaction')->whereMonth('created_at', '=', date('m'))
                            ->whereYear('created_at', '=', date('Y'))
                            ->select('id', 'created_at')->oldest()->get();

        $data['paymentmonthly'] = $paymentmonthly->groupBy(function ($item) {
            return $item->created_at->toDateString();
        })->mapWithKeys(function ($group, $date) {
            $perDayAmount = 0;
            foreach($group as $value) {
                $perDayAmount = $perDayAmount + $value->bank_transaction->amount;
            }
            return [$date => $perDayAmount];
        });
        $data['paymentweekly'] = $paymentweekly->groupBy(function ($item) {
            return $item->created_at->toDateString();
        })->mapWithKeys(function ($group, $date) {
            $perDayAmount = 0;
            foreach($group as $value) {
                $perDayAmount = $perDayAmount + $value->bank_transaction->amount;
            }
            return [$date => $perDayAmount];
        });
        $data['monthly'] = Sale::whereMonth('created_at', '=', date('m'))
        ->whereYear('created_at', '=', date('Y'))->select('id', 'price', 'kata', 'created_at')->get();
        $data['weekly'] = Sale::whereBetween('created_at', [now()->subWeek(), now()])->select('id', 'price', 'kata', 'created_at')->get();
        $data['title'] = 'Dashboard';
        $data['page'] = 'manager';
        
        return view('dashboard', $data);
    }
}
