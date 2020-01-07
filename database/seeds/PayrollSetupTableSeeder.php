<?php

use Illuminate\Database\Seeder;
use App\PayrollSetup;

class PayrollSetupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        PayrollSetup::create([
            'key' => 'MIN_OT_HOUR',
            'value' => '1',
            'remark' => 'Minimum extra hours allowed before OT claim Is allowed.',
            'company_id' => 1,
            'status' => 1,
            'created_by' => 1
        ]);
        
        PayrollSetup::create([
            'key' => 'PAYROLL_BACK_DATE_PERIOD',
            'value' => '3',
            'remark' => 'Payroll back date period in month',
            'company_id' => 1,
            'status' => 1,
            'created_by' => 1
        ]);
        
        PayrollSetup::create([
            'key' => 'LHDN_CHILD_DEPARTURE_AMOUNT',
            'value' => '2000',
            'remark' => 'Pelepasan anak',
            'company_id' => 1,
            'status' => 1,
            'created_by' => 1
        ]);
        
        PayrollSetup::create([
            'key' => 'PAYROLL_PERIOD',
            'value' => '25-24',
            'remark' => 'eg. start date-end date',
            'company_id' => 1,
            'status' => 1,
            'created_by' => 1
        ]);
    }
}
