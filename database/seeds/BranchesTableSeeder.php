<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = App\Branch::create([
            'name' => 'Kuala Langat',
            'contact_no_primary' => '0123456',
            'contact_no_secondary' =>'0123456',
            'fax_no' => '1234',
            'address' =>'add',
            'country_code' => '+60',
            'state' => 'Selangor',
            'city' => 'Kuala Langat',
            'zip_code' =>'41000',

        ]);
    }
}
