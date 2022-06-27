<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'name' => 'Jumcert',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
            'phone_no' => '123456789',
            'address' => 'US 705788',
            'remember_token' => Str::random(10)
        ];
    }
}
