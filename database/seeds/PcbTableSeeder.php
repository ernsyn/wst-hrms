<?php

use Illuminate\Database\Seeder;
use App\Pcb;

class PcbTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pcb::create([
            'salary' => 3145.00,
            'category' => '1',
            'total_children' => 0,
            'amount' => 1.00
        ]);
        
        Pcb::create([
            'salary' => 3145.00,
            'category' => '2',
            'total_children' => 0,
            'amount' => 0
        ]);
        
        Pcb::create([
            'salary' => 3145.00,
            'category' => '3',
            'total_children' => 0,
            'amount' => 2
        ]);
    }
}
