<?php

use Illuminate\Database\Seeder;
use App\Eis;

class EisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eis::create([
            'salary' => 30.00,
            'employer' => 0.05,
            'employee' => 0.05
        ]);
        
        Eis::create([
            'salary' => 50.00,
            'employer' => 0.10,
            'employee' => 0.10
        ]);
        
        Eis::create([
            'salary' => 70.00,
            'employer' => 0.15,
            'employee' => 0.15
        ]);
        
        Eis::create([
            'salary' => 100.00,
            'employer' => 0.20,
            'employee' => 0.20
        ]);
        
        Eis::create([
            'salary' => 140.00,
            'employer' => 0.25,
            'employee' => 0.25
        ]);
        
        Eis::create([
            'salary' => 200.00,
            'employer' => 0.35,
            'employee' => 0.35
        ]);
        
    }
}
