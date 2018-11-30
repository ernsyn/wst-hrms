<?php

use Illuminate\Database\Seeder;
use App\EPF;

class EpfTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EPF::create([
            'name' => 'A',
            'category' => 'A',
            'salary' => 10.00,
            'employer' => 0,
            'employee' => 0
        ]);
        
        EPF::create([
            'name' => 'A',
            'category' => 'A',
            'salary' => 20.00,
            'employer' => 3.00,
            'employee' => 2.00
        ]);
        
        EPF::create([
            'name' => 'A',
            'category' => 'A',
            'salary' => 40.00,
            'employer' => 6.00,
            'employee' => 4.00
        ]);
        
        EPF::create([
            'name' => 'A',
            'category' => 'A',
            'salary' => 60.00,
            'employer' => 8.00,
            'employee' => 5.00
        ]);
    }
}
