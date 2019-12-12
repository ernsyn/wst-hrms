<?php

use App\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // create permissions
        Permission::create(['name' => 'View Admin Dashboard', 'mode' => 'admin', 'module' => 'Admin Dashboard']);
        
        Permission::create(['name' => 'View Roles and Permissions', 'mode' => 'admin', 'module' => 'Roles & Permissions']);
        Permission::create(['name' => 'Add Role', 'mode' => 'admin', 'module' => 'Roles & Permissions']);
        Permission::create(['name' => 'Update Role', 'mode' => 'admin', 'module' => 'Roles & Permissions']);
        Permission::create(['name' => 'Delete Role', 'mode' => 'admin', 'module' => 'Roles & Permissions']);
        Permission::create(['name' => 'Duplicate Role', 'mode' => 'admin', 'module' => 'Roles & Permissions']);
        
        Permission::create(['name' => 'View Employee Dashboard', 'mode' => 'employee', 'module' => 'Employee Dashboard']);
        
        $role = Role::where('name', 'Super Admin')->first();
        $role->givePermissionTo(Permission::all());
    }
}
