<?php

use Illuminate\Database\Seeder;
use App\Addition;

class AdditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Addition::create([
            'company_id' => '1',
            'code' => 'OT',
            'name' => 'Overtime',
            'type' => 'Custom',
            'amount' => '0',
            'status' => 'Active',
            'confirmed_employee' => 1,
            'ea_form_id' => 1
        ]);
        
        Addition::create([
            'company_id' => '1',
            'code' => 'ALP',
            'name' => 'Annual Leave Payback',
            'type' => 'Custom',
            'amount' => 0,
            'status' => 'Active',
            'confirmed_employee' => 1,
            'ea_form_id' => 1
        ]);
        
        Addition::create([
            'company_id' => '1',
            'code' => 'CFLP',
            'name' => 'Carry Forward Leave Payback',
            'type' => 'Custom',
            'amount' => 0,
            'status' => 'Active',
            'confirmed_employee' => 1,
            'ea_form_id' => 1
        ]);
        
        Addition::create([
            'company_id' => '1',
            'code' => 'PH',
            'name' => 'Public Holiday',
            'type' => 'Custom',
            'amount' => 0,
            'status' => 'Active',
            'confirmed_employee' => 1,
            'ea_form_id' => 1
        ]);
        
        Addition::create([
            'company_id' => '1',
            'code' => 'RD',
            'name' => 'Rest Day',
            'type' => 'Custom',
            'amount' => 0,
            'status' => 'Active',
            'confirmed_employee' => 1,
            'ea_form_id' => 1
        ]);
        
        Addition::create([
            'company_id' => '1',
            'code' => 'MC',
            'name' => 'Medical Claims',
            'type' => 'Custom',
            'amount' => 0,
            'status' => 'Active',
            'confirmed_employee' => 1,
            'ea_form_id' => 1
        ]);
        
    }
}
