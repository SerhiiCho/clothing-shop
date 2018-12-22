<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    // Run the database seeds.
    public function run()
    {
        User::create([
            'admin' => 1,
            'name' => 'Кристина',
            'email' => 'kris@kris.com',
            'password' => bcrypt(config('custom.pwd1')),
        ]);

        User::create([
            'admin' => 1,
            'name' => 'Серый',
            'email' => 'ser@ser.com',
            'password' => bcrypt(config('custom.pwd2')),
        ]);
    }
}
