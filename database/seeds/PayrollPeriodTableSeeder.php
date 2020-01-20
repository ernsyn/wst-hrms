<?php

use Illuminate\Database\Seeder;
use App\PayrollPeriod;

class PayrollPeriodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PayrollPeriod::create([
            'name' => 'Add Month'
        ]);
        
        PayrollPeriod::create([
            'name' => 'Mid Month'
        ]);
        
        PayrollPeriod::create([
            'name' => 'End Month'
        ]);
    }
}
