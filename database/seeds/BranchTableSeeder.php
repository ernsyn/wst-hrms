<?php

use Illuminate\Database\Seeder;
use App\Branch;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            'name' => 'Malaysia HQ',
            'contact_no_primary' => '0379313550',
            'contact_no_secondary' => '0379313550',
            'fax_no' => '0379313550',
            'address' => 'Level 15, Tower 1, Jaya33, Jalan Semangat, Seksyen 13, 46200 Petaling Jaya, Selangor',
            'country_code' => 'MY',
            'state' => 'Selangor',
            'city' => 'Petaling Jaya',
            'zip_code' => '46200'
        ]);
        
        Branch::create([
            'name' => 'Selangor Branch Office',
            'contact_no_primary' => '0333585885',
            'contact_no_secondary' => '0333585885',
            'fax_no' => '0333585885',
            'address' => 'Suite 8-01, Level 8, Menara Trend, Intan Millennium Square, No. 68, Jalan Batai Laut 4, Taman Intan, 41300 Klang, Selangor Darul Ehsan',
            'country_code' => 'MY',
            'state' => 'Selangor',
            'city' => 'Klang',
            'zip_code' => '41300'
        ]);
    }
}
