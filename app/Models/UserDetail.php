<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    const ACTIVE =  1, CLOSE = 0;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    const ROLE = ['Agent', 'Customer', 'Accountant', 'Managing Director', 'Shareholder'];
    const USER = ['accountant' => 2, 'shareholder' => 3, 'agent' => 4, 'customer' => 5, 'withdraw' => 6, 'employee' => 7, 'managing-director' => 1];
    const WITHDRAWUSER = [1, 3, 4]; // 'shareholder' => 3, 'agent' => 4
    const TYPE = ['accountant' => 'Ac', 'shareholder' => 'Sh', 'agent' => 'Ag', 'customer' => 'Cu', 'manager' => 'Gm'];
    const PROFILEROLE= [ 2 => 'Ac', 1 => 'Gm', 3 => 'Sh'];
    const TITLE = ['accountant' => 'Accountant', 'shareholder' => 'Master Agent', 'agent' => 'Agent'];

    public static function updatekata($id, $kata)
    {
        $user_detail = self::findorfail($id);
        $user_detail->total_kata = (int) $user_detail->total_kata - (int) $kata;
        $user_detail->save();
    }

    public static function queryroles($type)
    {
        $roles = self::USER;
        if(str_contains($type, 'sale') || ($type == 'agent')) return array($roles['agent'], $roles['shareholder']);
        else if($type == 'employee') return array($roles['accountant'], $roles['employee']);
        else if($type == 'customer') return array($roles['customer']);
        return array($roles['agent'], $roles['shareholder'], $roles['managing-director']);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_details_id', 'id');
    }

    public function getParentNameAttribute($value)
    {
        if(is_null($value)) {
            return (object) array('father' => null, 'mother' => null);
        }
        return json_decode($value);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'agent_id', 'id');
    }

    public function getRoleNameAttribute()
    {
        $user = ['Accountant' => 2, 'Master Agent' => 3, 'Agent' => 4, 'Customer' => 5, 'Withdraw' => 6, 'Stuff' => 7, 'Managing Director' => 1];
        $role = array_flip($user);
        return $role[$this->role];
    }

    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('F j, Y');
    }

    public function getOccupationAttribute($value)
    {
        return is_null($value) ? 'Not Given Yet' : $value;
    }

    public function getUpdatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('F j, Y');
    }

    public function getOnStatusAttribute()
    {
        return ($this->status == 1) ? 'Active' : 'Deactive';
    }

    public function getProfileImageAttribute()
    {
        return is_null($this->image) ? url('img/no_image.jpg') : url($this->image);
    }

    public function refer_account()
    {
        return $this->belongsTo(self::class, 'refer_id', 'id');
    }

    public function total_agents($id, $data)
    {
        $count = 0;
        foreach ($data as $element) {
            $count += substr_count($element, $id);
        }
        return $count;
    }

    public function transaction($startDate, $endDate, $id)
    {
        return Transaction::where('user_details_id', $id)->whereBetween('created_at', [$startDate, Carbon::parse($endDate. ' 24:00:00')])->get();
    }

}
