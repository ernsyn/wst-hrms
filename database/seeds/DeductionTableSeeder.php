<?php

use Illuminate\Database\Seeder;
use App\Deduction;

class DeductionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deduction::create([
            'company_id' => '1',
            'code' => 'UL',
            'name' => 'Unpaid Leave',
            'type' => 'Custom',
            'amount' => '0',
            'status' => 'Active',
            'confirmed_employee' => 1,
            'ea_form_id' => 1
        ]);
    }
}
