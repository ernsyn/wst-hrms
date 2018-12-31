<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LeaveTypesTableSeeder::class);
        $this->call(BankCodeTableSeeder::class);
        $this->call(AdditionTableSeeder::class);
        $this->call(DeductionTableSeeder::class);
        $this->call(EaFormSeederTable::class);
        $this->call(EisTableSeeder::class);
        $this->call(PayrollSetupTableSeeder::class);
        $this->call(SocsoTableSeeder::class);
    }
}
