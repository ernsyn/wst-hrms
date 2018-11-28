<?php

use Illuminate\Database\Seeder;
use App\EmployeePosition;

class EmployeePositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeePosition::create([
            'name' => 'Executive'
        ]);
        
        EmployeePosition::create([
            'name' => 'Supervisor'
        ]);
        
        EmployeePosition::create([
            'name' => 'Manager'
        ]);
    }
}
