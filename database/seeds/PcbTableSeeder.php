<?php

use Illuminate\Database\Seeder;

class PcbTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pcbs')->insert([
            [
                'salary' => 3145.00,
                'category' => '1',
                'total_children' => 0,
                'amount' => 1.00
            ],
            [
                'salary' => 3145.00,
                'category' => '2',
                'total_children' => 0,
                'amount' => 0
            ],
            [
                'salary' => 3145.00,
                'category' => '3',
                'total_children' => 0,
                'amount' => 2
            ],
            
        ]);
        
    }
}
