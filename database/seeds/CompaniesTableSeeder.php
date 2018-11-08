<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = App\Company::create([
            'code' => 'GM123456',
            'name' => 'OPPO SDN BHD',
            'registration_no' => 'SYASHA123456',
            'description' =>'Description',
            'url' =>'oppon.com.my',
            'address' =>'N/A',
            'phone' =>'03-123456',
            'gst_no' =>'123456',
            'tax_no' =>'123456',
            'epf_no' =>'123456',
            'socso_no' =>'123456',
            'eis_no' =>'123456',
            'status' =>'ACTIVE',
        ]);
    }
}
