<?php

use Illuminate\Database\Seeder;

class EmployeeGradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = App\EmployeeGrade::create([
            'name' => 'OP5',

        ]);
    }
}
