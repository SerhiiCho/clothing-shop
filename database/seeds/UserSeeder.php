<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'admin' => 1,
            'name' => 'Админ',
            'email' => 'ser@ser.com',
            'password' => bcrypt(config('custom.pwd2')),
        ]);
    }
}
