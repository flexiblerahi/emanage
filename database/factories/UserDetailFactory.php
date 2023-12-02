<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class UserDetailFactory extends Factory
{
    public function definition()
    {
        $user_type =$this->faker->randomElement(['Sh', 'Ac', 'Ag', 'Cu']);
        $data['account_id'] = $user_type.rand(1000000, 9999999);
        $data['name'] = $this->faker->name;
        $data['phone'] = Str::of(rand(1111111, 9999999))->replaceMatches('/(\d{3})(\d{4})/', '018$1$2');
        $data['present_address'] = $this->faker->address;
        $data['permanent_address'] = $this->faker->address;
        $data['emergency_contact'] = Str::of(rand(1111111, 9999999))->replaceMatches('/(\d{3})(\d{4})/', '018$1$2');
        if ($user_type == 'Ac') {
            $data['role'] = 2;
            $data['user_id'] = $this->faker->randomElement([2,3,4,5,6,7,8,9]);
        }
        else if ($user_type == 'Sh') {
            $data['role'] = 3;
            $data['user_id'] = $this->faker->randomElement([2,3,4,5,6,7,8,9]);
        }
        else if ($user_type == 'Ag') {
            $data['role'] = 4;
            $data['reference_id'] = rand(1,5).','.rand(6,10).','.rand(11,20);
        }
        else {
            $data['role'] = 5;
            $data['reference_id'] = rand(1,5).','.rand(6,10).','.rand(11,20);
        }
        $data['parent_name'] = json_encode(['father' => $this->faker->name, 'mother' => $this->faker->name]);
        $data['status'] = 1;
        return $data;
    }
}