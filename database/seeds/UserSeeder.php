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
            'email' => config('custom.admin_email'),
            'password' => bcrypt(config('custom.admin_password')),
        ]);
    }
}
