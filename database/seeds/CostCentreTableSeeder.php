<?php

use App\CostCentre;
use Illuminate\Database\Seeder;

class CostCentreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CostCentre::create([
            'name' => 'HQ',
            'seniority_pay' => 'Auto',
            'amount' => '50.00'
        ]);
        
        CostCentre::create([
            'name' => 'SELANGOR',
            'seniority_pay' => 'Auto',
            'amount' => '50.00'
        ]);
    }
}
