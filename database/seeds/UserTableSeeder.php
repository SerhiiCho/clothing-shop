<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
			'admin'     => 1,
			'name'      => 'Admin',
			'email'     => '11@11.com',
			'password'  => '$2y$10$gC6H5a1KnMnOL4nyOzsBju/iMdh7.nGoSB5N8vAfnk39.Yk2Jrg0K'
		]);
    }
}
