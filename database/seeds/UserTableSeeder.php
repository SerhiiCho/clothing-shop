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
			'master' => 1,
			'admin' => 1,
			'blogger' => 1,
			'name' => 'Admin',
			'email' => '11@11.com',
			'password' => bcrypt('111111')
		]);
    }
}
