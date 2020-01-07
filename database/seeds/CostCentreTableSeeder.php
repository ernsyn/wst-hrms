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
        ]);
        
        CostCentre::create([
            'name' => 'SELANGOR',
        ]);
    }
}
