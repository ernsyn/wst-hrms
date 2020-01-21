<?php

use Illuminate\Database\Seeder;
use App\JobCompany;

class JobCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobCompany::create([
            'company_name' => 'JIE BUSINESS SDN BHD ("OPPO")',
            'company_id' => 1
        ]);
    }
}
