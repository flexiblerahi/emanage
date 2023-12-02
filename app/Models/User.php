<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const ACTIVE =  1, CLOSE = 0;
    public $incrementing = true;
    protected $keyType = 'string';
    protected $guarded = [];

    protected $hidden = [
        
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userdetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }

    public static function status($id, $status)
    {
        $user = self::findorfail($id);
        $user->status = $status;
        $user->save();
    }
}
