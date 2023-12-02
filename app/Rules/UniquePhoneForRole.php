<?php

namespace App\Rules;

use App\Models\UserDetail;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniquePhoneForRole implements ValidationRule
{
    protected $role;
    protected $role_name;
    protected $userId;

    public function __construct($role, $role_name, $userId = null)
    {
        $this->role = $role;
        $this->role_name = $role_name;
        $this->userId = $userId;
    }
    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(is_null($this->userId)) { 
            $user_details = UserDetail::where(['role' => $this->role, 'phone' => $value])->exists();
            if($user_details) $fail("The :attribute already exists for the {$this->role_name}."); 
        } else {
            $user_details = UserDetail::where('role', $this->role)->where('phone', $value)->where('id', '!=', $this->userId)->exists();
            if($user_details) $fail("The :attribute already exists for the {$this->role_name}."); 
        }

    }
}
