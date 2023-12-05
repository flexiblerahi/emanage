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
        $data['title'] = 'Dashboard';
        $data['page'] = 'manager';
        
        return view('dashboard', $data);
    }
}
