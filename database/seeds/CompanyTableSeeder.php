<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'code' => 'OPPO',
            'name' => 'OPPO ELECTRONICS SDN BHD',
            'registration_no' => '1075187D',
            'description' => '1)TO DISTRIBUTE OF MOBILE ELECTRONIC DEVICES UNDER THE OPPO BRAND 2)TO CARRY ON ON BUSINESS AS IMPORTERS, EXPORTERS & DISTRIBUTORS 3)TO CARRY ON ANY OTHER TRADE OR BUSINESS',
            'url' => 'http://oppo.com.my',
            'address' => 'Unit 2.2 Level 2, Menara Axis no.2 Jalan 51A/223, 46100 Petaling Jaya, Selangor',
            'phone' => '0379541969',
            'gst_no' => '',
            'tax_no' => '001457233920',
            'epf_no' => '1075187D',
            'socso_no' => '1075187D',
            'eis_no' => '1075187D',
            'status' => 'Active'
        ]);
    }
}
