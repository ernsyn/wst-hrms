<?php

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
        $user = App\User::create([
            'name' => 'Super Admin',
            'password' => bcrypt('superadmin'),
            'email' => 'superadmin@wisetech.com',
        ]);

        $user->assignRole('Super Admin');
    }
}
