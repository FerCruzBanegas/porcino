<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'nano',
            'email'    => 'nano.fer777@gmail.com',
            'password' => bcrypt('nanolei'),
        ]);
    }
}
