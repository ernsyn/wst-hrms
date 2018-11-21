<?php

use Illuminate\Database\Seeder;

class SocsoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socsos')->insert([
            [
                'salary' => 30.00,
                'first_category_employer' => 0.40,
                'first_category_employee' => 0.10
            ],
            [
                'salary' => 50.00,
                'first_category_employer' => 0.70,
                'first_category_employee' => 0.20
            ],
            [
                'salary' => 70.00,
                'first_category_employer' => 1.10,
                'first_category_employee' => 0.30
            ],
            [
                'salary' => 100.00,
                'first_category_employer' => 1.50,
                'first_category_employee' => 0.40
            ],
            [
                'salary' => 140.00,
                'first_category_employer' => 2.10,
                'first_category_employee' => 0.60
            ],
            [
                'salary' => 200.00,
                'first_category_employer' => 2.95,
                'first_category_employee' => 0.85
            ],
            
        ]);
    }
}
