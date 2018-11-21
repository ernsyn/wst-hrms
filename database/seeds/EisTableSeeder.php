<?php

use Illuminate\Database\Seeder;

class EisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eis')->insert([
            [
                'salary' => 30.00,
                'employer' => 0.50,
                'employee' => 0.50
            ],
            [
                'salary' => 50.00,
                'employer' => 2.10,
                'employee' => 0.10
            ],
            [
                'salary' => 70.00,
                'employer' => 0.15,
                'employee' => 0.15
            ],
            [
                'salary' => 100.00,
                'employer' => 0.20,
                'employee' => 0.20
            ],
            [
                'salary' => 140.00,
                'employer' => 0.25,
                'employee' => 0.25
            ],
            [
                'salary' => 200.00,
                'employer' => 0.35,
                'employee' => 0.35
            ],
            
        ]);
    }
}
