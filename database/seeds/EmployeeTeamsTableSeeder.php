<?php

use Illuminate\Database\Seeder;

class EmployeeTeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = App\Team::create([
            'name' => 'A',

        ]);
    } 
    }

