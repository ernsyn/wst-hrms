<?php

use Illuminate\Database\Seeder;

class CostCentresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $costcentre = App\CostCentre::create([
            'name' => 'HQ',
            'seniority_pay' => 'auto',
            'amount' =>'50',
            'payroll_type' =>'',
        ]);
    }
}
