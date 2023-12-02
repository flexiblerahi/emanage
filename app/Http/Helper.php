<?php

use App\Models\BankInfo;
use App\Models\BankName;
use Illuminate\Support\Facades\DB;

function checkUserForm () {
    return in_array(true,  [
        request()->routeIs('register'), request()->routeIs('login'), request()->routeIs('password.request'),request()->routeIs('password.reset'), 
    ]);
}

function setImage($url = null): string
{
    return ($url != null) ? url($url) : url('img/no_image.jpg');
}

function countRank($kata) {
    if($kata <= 24) return 1;
    else if($kata <= 99) return 2;
    else return 3;
}

function referenceIds($ids, $get = null) {
    $referencesIds = array_filter(explode(',', $ids));
    if($get == 'shareholder') return end($referencesIds);
    if($get == 'first') return $referencesIds[0];
    if(count($referencesIds) > 2) $referencesIds = array(...array_splice($referencesIds, 0, 2), end($referencesIds));
    return $referencesIds;
}

function filter_key_array($input, $string) {
      $filteredArray = array_filter($input, function($key) use ($string) {
          return strpos($key, $string) !== false;
      }, ARRAY_FILTER_USE_KEY);
      return groupByCommission($filteredArray);
}

function groupByCommission($array) {
    $groupedArray = [];

    foreach($array as $key => $value) {
        $commissionNumber = explode('-', $key)[1]; // Extract the commission number from the key
        $split_commission = explode('_', $commissionNumber)[1];
        $groupedArray[$split_commission][$key] = $value; // Group the values based on the commission number
    }
    return $groupedArray;
}

function uploadFile($file, $image_name, $path, $old = null)
{
    if(is_null($file)) return null;
    if(!is_null($old)) unlink(public_path($old));
    $filename = $image_name . '.' . $file->getClientOriginalExtension();
    $file->move(public_path($path), $filename);
    return $path . $filename;
}

function newuploadFile($path, $image_name, $file, $old = null)
{
    if(!is_null($old)) unlink(public_path($old));
    $filename = $image_name . '.' . $file->getClientOriginalExtension();
    $file->move(public_path($path), $filename);
    return $path . $filename;
}

function isStatus($status) {
    return ($status == 'on') ? 1 : 0;
}

function setStatus($status) {
    return ($status == 1) ? '<div class="text-success">Active</div>' : '<div class="text-danger"> Deactive</div>';
}
 
function formatdate($date)
{
    return \DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
}

function getdateformat($date)
{
    return  date('d/m/Y', strtotime($date));
}

function matureDate($date, $duration, $in)
{
    return date('d M Y', strtotime('+'.$duration.' '.$in, strtotime($date)));
}

function filename($file) {
    $split = explode('/', $file);
    return $split[1];
}

function setobj($inputs, $obj)
{
    foreach($inputs as $key => $input) $obj->{$key} = $input;
    return $obj;
}

function unsetKey($array, $keys)
{
    foreach($keys as $key) {
        if(array_key_exists($key, $array)) unset($array[$key]);
    }
    return $array;
}

function autoIdGenerator($table, $id = false, $long = false, $longid = false) {
    $lastRecord = DB::table($table)->orderBy('id', 'desc')->first();
    if(is_null($lastRecord)) $generatedid = ($longid) ? 1 : (int) ('1'.str_repeat('0', 4)).'1';
    else $generatedid = ($id) ? (int) $lastRecord->id+1 : (int) $lastRecord->account_id+1;
    if($long) $generatedid = (int) ('1'.str_repeat('0', 4)) + $generatedid;
    return $generatedid;
}

function randomnumbers($id)
{
    return (int) ('1'.str_repeat('0', (10- strlen($id)))).($id+1);
}

function entry() {
    return auth()->user()->userdetails->id;
}

function bankDetails($model) {
    $data = array();
    $data['bankNames'] = BankName::where('status', 1)->get(['id', 'name']);
    $data['bank_name_id'] = $model->bank_transaction->bank_info->bank_name_id; 
    $data['bankInfos'] = BankInfo::where(['bank_name_id' => $data['bank_name_id'], 'status' => 1])->select(['id', 'account_id'])->get();
    return $data;
}

function isUpdate() {
    return (request()->method() == 'PUT');
}

function emergencyContact($data) { return is_null($data) ? '<p class="text-danger">No Entry Yet.</p>' : '<p>'.$data.'</p>'; }

function checkBalance(int $amount, int $bankbalance, $userbalance = null) {
    // $balance = (int) $amount;
    if($amount> $bankbalance) return ['message' => 'Insufficient Bank Balance'];
    if(!is_null($userbalance)) {
        if($amount> (int) $userbalance) return ['message' => 'Insufficient User Balance'];
    }
    return ['amount' => $amount];
}

function isRequest($arrays) : bool {
    $isrequest= false;
    foreach($arrays as $item) {
        if(request()->is($item)) $isrequest = true;
    }
    return $isrequest;
}

function tk($amount) {
    return (int) $amount. ' tk';
}

function printNestedArray($array, $indent = 0, $titles = '') {
    foreach ($array as $key => $value) {
        if (is_array($value)) {
        //     // echo str_repeat(" ", $indent) . $key . " => <br>";
        //     // if($key == 'title') echo $value;
            if($key == 'title') $titles .= $value;
            if($key == 'parent' && !is_null($value)) $titles .= '->';
            return printNestedArray($value, $indent + 2, $titles);
        } else {
        //     // echo str_repeat(" ", $indent) . $key . " => " . $value . "<br>";
        //     if($key == 'title') echo $value;
            if($key == 'title') $titles .= $value;
            if($key == 'parent' && !is_null($value)) $titles .= '->';
        }
    }
    // dd($titles);
    return $titles;
}