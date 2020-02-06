<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'company_id' => '1',
            'name' => 'HQ'
        ]);
        
        Category::create([
            'company_id' => '1',
            'name' => 'T1'
        ]);
        
        Category::create([
            'company_id' => '1',
            'name' => 'T2'
        ]);
        
        Category::create([
            'company_id' => '1',
            'name' => 'T3'
        ]);
    }
}
