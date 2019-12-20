<?php

use App\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Constants\PermissionConstant;

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
        //Admin mode
        Permission::create(['name' => PermissionConstant::VIEW_ADMIN_DASHBOARD, 'mode' => 'admin', 'module' => 'Admin Dashboard']);
        Permission::create(['name' => PermissionConstant::VIEW_AUDIT_TRAIL, 'mode' => 'admin', 'module' => 'Audit Trail']);
        
        Permission::create(['name' => PermissionConstant::VIEW_ROLE_AND_PERMISSION, 'mode' => 'admin', 'module' => 'Roles & Permissions']);
        Permission::create(['name' => PermissionConstant::ADD_ROLE, 'mode' => 'admin', 'module' => 'Roles & Permissions']);
        Permission::create(['name' => PermissionConstant::UPDATE_ROLE, 'mode' => 'admin', 'module' => 'Roles & Permissions']);
        Permission::create(['name' => PermissionConstant::DELETE_ROLE, 'mode' => 'admin', 'module' => 'Roles & Permissions']);
        Permission::create(['name' => PermissionConstant::DUPLICATE_ROLE, 'mode' => 'admin', 'module' => 'Roles & Permissions']);
        
        Permission::create(['name' => PermissionConstant::ASSIGN_ROLE, 'mode' => 'admin', 'module' => 'Employees']);
        
        Permission::create(['name' => PermissionConstant::VIEW_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company']);
        Permission::create(['name' => PermissionConstant::ADD_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company', 'superadmin' => 1]);
        Permission::create(['name' => PermissionConstant::UPDATE_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company']);
        Permission::create(['name' => PermissionConstant::DELETE_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company', 'superadmin' => 1]);
        
        Permission::create(['name' => PermissionConstant::VIEW_COMPANY_BANK, 'mode' => 'admin', 'module' => 'Settings - Company Details']);
        Permission::create(['name' => PermissionConstant::ADD_COMPANY_BANK, 'mode' => 'admin', 'module' => 'Settings - Company Details']);
        Permission::create(['name' => PermissionConstant::UPDATE_COMPANY_BANK, 'mode' => 'admin', 'module' => 'Settings - Company Details']);
        Permission::create(['name' => PermissionConstant::DELETE_COMPANY_BANK, 'mode' => 'admin', 'module' => 'Settings - Company Details']);
        
        Permission::create(['name' => PermissionConstant::VIEW_JOB_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company Details']);
        Permission::create(['name' => PermissionConstant::ADD_JOB_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company Details']);
        Permission::create(['name' => PermissionConstant::UPDATE_JOB_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company Details']);
        Permission::create(['name' => PermissionConstant::DELETE_JOB_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company Details']);
        
        Permission::create(['name' => PermissionConstant::VIEW_BRANCH, 'mode' => 'admin', 'module' => 'Settings - Branch']);
        Permission::create(['name' => PermissionConstant::ADD_BRANCH, 'mode' => 'admin', 'module' => 'Settings - Branch']);
        Permission::create(['name' => PermissionConstant::UPDATE_BRANCH, 'mode' => 'admin', 'module' => 'Settings - Branch']);
        Permission::create(['name' => PermissionConstant::DELETE_BRANCH, 'mode' => 'admin', 'module' => 'Settings - Branch']);
        
        Permission::create(['name' => PermissionConstant::VIEW_SECTION, 'mode' => 'admin', 'module' => 'Settings - Section']);
        Permission::create(['name' => PermissionConstant::ADD_SECTION, 'mode' => 'admin', 'module' => 'Settings - Section']);
        Permission::create(['name' => PermissionConstant::UPDATE_SECTION, 'mode' => 'admin', 'module' => 'Settings - Section']);
        Permission::create(['name' => PermissionConstant::DELETE_SECTION, 'mode' => 'admin', 'module' => 'Settings - Section']);
        
        Permission::create(['name' => PermissionConstant::VIEW_AREA, 'mode' => 'admin', 'module' => 'Settings - Area']);
        Permission::create(['name' => PermissionConstant::ADD_AREA, 'mode' => 'admin', 'module' => 'Settings - Area']);
        Permission::create(['name' => PermissionConstant::UPDATE_AREA, 'mode' => 'admin', 'module' => 'Settings - Area']);
        Permission::create(['name' => PermissionConstant::DELETE_AREA, 'mode' => 'admin', 'module' => 'Settings - Area']);
        
        Permission::create(['name' => PermissionConstant::VIEW_CATEGORY, 'mode' => 'admin', 'module' => 'Settings - Category']);
        Permission::create(['name' => PermissionConstant::ADD_CATEGORY, 'mode' => 'admin', 'module' => 'Settings - Category']);
        Permission::create(['name' => PermissionConstant::UPDATE_CATEGORY, 'mode' => 'admin', 'module' => 'Settings - Category']);
        Permission::create(['name' => PermissionConstant::DELETE_CATEGORY, 'mode' => 'admin', 'module' => 'Settings - Category']);
        
        Permission::create(['name' => PermissionConstant::VIEW_EPF, 'mode' => 'admin', 'module' => 'Settings - EPF']);
        Permission::create(['name' => PermissionConstant::ADD_EPF, 'mode' => 'admin', 'module' => 'Settings - EPF']);
        Permission::create(['name' => PermissionConstant::UPDATE_EPF, 'mode' => 'admin', 'module' => 'Settings - EPF']);
        Permission::create(['name' => PermissionConstant::DELETE_EPF, 'mode' => 'admin', 'module' => 'Settings - EPF']);
        
        Permission::create(['name' => PermissionConstant::VIEW_EIS, 'mode' => 'admin', 'module' => 'Settings - EIS']);
        Permission::create(['name' => PermissionConstant::ADD_EIS, 'mode' => 'admin', 'module' => 'Settings - EIS']);
        Permission::create(['name' => PermissionConstant::UPDATE_EIS, 'mode' => 'admin', 'module' => 'Settings - EIS']);
        Permission::create(['name' => PermissionConstant::DELETE_EIS, 'mode' => 'admin', 'module' => 'Settings - EIS']);
        
        Permission::create(['name' => PermissionConstant::VIEW_SOCSO, 'mode' => 'admin', 'module' => 'Settings - SOCSO']);
        Permission::create(['name' => PermissionConstant::ADD_SOCSO, 'mode' => 'admin', 'module' => 'Settings - SOCSO']);
        Permission::create(['name' => PermissionConstant::UPDATE_SOCSO, 'mode' => 'admin', 'module' => 'Settings - SOCSO']);
        Permission::create(['name' => PermissionConstant::DELETE_SOCSO, 'mode' => 'admin', 'module' => 'Settings - SOCSO']);
        
        Permission::create(['name' => PermissionConstant::VIEW_PCB, 'mode' => 'admin', 'module' => 'Settings - PCB']);
        Permission::create(['name' => PermissionConstant::ADD_PCB, 'mode' => 'admin', 'module' => 'Settings - PCB']);
        Permission::create(['name' => PermissionConstant::UPDATE_PCB, 'mode' => 'admin', 'module' => 'Settings - PCB']);
        Permission::create(['name' => PermissionConstant::DELETE_PCB, 'mode' => 'admin', 'module' => 'Settings - PCB']);
        
        //Employee mode
        Permission::create(['name' => PermissionConstant::VIEW_EMPLOYEE_DASHBOARD, 'mode' => 'employee', 'module' => 'Employee Dashboard']);
        
        $role = Role::where('name', 'Super Admin')->first();
        $role->givePermissionTo(Permission::all());
    }
}
