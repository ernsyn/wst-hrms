<?php

use Illuminate\Database\Seeder;
use App\EmployeeGrade;

class EmployeeGradeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeGrade::create([
            'name' => 'OP1'
        ]);
    }
}
