<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = App\Employee::create([
            'user_id' => '32',
            'contact_no' => '012464646',
            'address' => 'N/A',
            'company_id' => '1',
        ]);
    }
}
