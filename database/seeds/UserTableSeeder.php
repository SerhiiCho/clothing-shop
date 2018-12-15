<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    // Run the database seeds.
    public function run()
    {
        User::create([
            'member' => 1,
            'master' => 0,
            'admin' => 1,
            'blogger' => 0,
            'name' => 'Кристина',
            'email' => 'kris@kris.com',
            'password' => bcrypt(config('custom.pwd1')),
        ]);

        User::create([
            'member' => 1,
            'master' => 1,
            'admin' => 1,
            'blogger' => 1,
            'name' => 'Серый',
            'email' => 'ser@ser.com',
            'password' => bcrypt(config('custom.pwd2')),
        ]);
    }
}
