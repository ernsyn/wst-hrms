<?php

use Illuminate\Database\Seeder;

class EmployeePositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = App\EmployeePosition::create([
            'name' => 'Manager',

        ]);
    }
}
