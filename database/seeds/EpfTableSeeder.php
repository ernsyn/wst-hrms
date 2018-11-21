<?php

use Illuminate\Database\Seeder;

class EpfTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('epfs')->insert([
            [
                'name' => 'A',
                'category' => 'A',
                'salary' => 10.00,
                'employer' => 0,
                'employee' => 0
            ],
            [
                'name' => 'A',
                'category' => 'A',
                'salary' => 20.00,
                'employer' => 3.00,
                'employee' => 3.00
            ],
            [
                'name' => 'A',
                'category' => 'A',
                'salary' => 40.00,
                'employer' => 6.00,
                'employee' => 5.00
            ],
            [
                'name' => 'A',
                'category' => 'A',
                'salary' => 60.00,
                'employer' => 8.00,
                'employee' => 7.00
            ],
            [
                'name' => 'A',
                'category' => 'A',
                'salary' => 80.00,
                'employer' => 11.00,
                'employee' => 9.00
            ],
            [
                'name' => 'A',
                'category' => 'A',
                'salary' => 100.00,
                'employer' => 13.00,
                'employee' => 11.00
            ],
            
        ]);
        
    }
}
