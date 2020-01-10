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
        
        Permission::create(['name' => PermissionConstant::VIEW_EMPLOYEE, 'mode' => 'admin', 'module' => 'Employees']);
        Permission::create(['name' => PermissionConstant::ADD_EMPLOYEE, 'mode' => 'admin', 'module' => 'Employees']);
        Permission::create(['name' => PermissionConstant::RESET_PASSWORD, 'mode' => 'admin', 'module' => 'Employees']);
        Permission::create(['name' => PermissionConstant::EDIT_PROFILE, 'mode' => 'admin', 'module' => 'Employees']);
        Permission::create(['name' => PermissionConstant::ASSIGN_ROLE, 'mode' => 'admin', 'module' => 'Employees']);
        
        Permission::create(['name' => PermissionConstant::VIEW_EMERGENCY_CONTACT, 'mode' => 'admin', 'module' => 'Employees - Emergency Contact']);
        Permission::create(['name' => PermissionConstant::ADD_EMERGENCY_CONTACT, 'mode' => 'admin', 'module' => 'Employees - Emergency Contact']);
        Permission::create(['name' => PermissionConstant::UPDATE_EMERGENCY_CONTACT, 'mode' => 'admin', 'module' => 'Employees - Emergency Contact']);
        Permission::create(['name' => PermissionConstant::DELETE_EMERGENCY_CONTACT, 'mode' => 'admin', 'module' => 'Employees - Emergency Contact']);
        
        Permission::create(['name' => PermissionConstant::VIEW_DEPENDENT, 'mode' => 'admin', 'module' => 'Employees - Dependent']);
        Permission::create(['name' => PermissionConstant::ADD_DEPENDENT, 'mode' => 'admin', 'module' => 'Employees - Dependent']);
        Permission::create(['name' => PermissionConstant::UPDATE_DEPENDENT, 'mode' => 'admin', 'module' => 'Employees - Dependent']);
        Permission::create(['name' => PermissionConstant::DELETE_DEPENDENT, 'mode' => 'admin', 'module' => 'Employees - Dependent']);
        
        Permission::create(['name' => PermissionConstant::VIEW_IMMIGRATION, 'mode' => 'admin', 'module' => 'Employees - Immigration']);
        Permission::create(['name' => PermissionConstant::ADD_IMMIGRATION, 'mode' => 'admin', 'module' => 'Employees - Immigration']);
        Permission::create(['name' => PermissionConstant::UPDATE_IMMIGRATION, 'mode' => 'admin', 'module' => 'Employees - Immigration']);
        Permission::create(['name' => PermissionConstant::DELETE_IMMIGRATION, 'mode' => 'admin', 'module' => 'Employees - Immigration']);
        
        Permission::create(['name' => PermissionConstant::VIEW_VISA, 'mode' => 'admin', 'module' => 'Employees - Visa']);
        Permission::create(['name' => PermissionConstant::ADD_VISA, 'mode' => 'admin', 'module' => 'Employees - Visa']);
        Permission::create(['name' => PermissionConstant::UPDATE_VISA, 'mode' => 'admin', 'module' => 'Employees - Visa']);
        Permission::create(['name' => PermissionConstant::DELETE_VISA, 'mode' => 'admin', 'module' => 'Employees - Visa']);
        
        Permission::create(['name' => PermissionConstant::VIEW_JOB, 'mode' => 'admin', 'module' => 'Employees - Job']);
        Permission::create(['name' => PermissionConstant::ADD_JOB, 'mode' => 'admin', 'module' => 'Employees - Job']);
        Permission::create(['name' => PermissionConstant::UPDATE_JOB, 'mode' => 'admin', 'module' => 'Employees - Job']);
        Permission::create(['name' => PermissionConstant::DELETE_JOB, 'mode' => 'admin', 'module' => 'Employees - Job']);
        Permission::create(['name' => PermissionConstant::RESIGN, 'mode' => 'admin', 'module' => 'Employees - Job']);
        
        Permission::create(['name' => PermissionConstant::VIEW_BANK, 'mode' => 'admin', 'module' => 'Employees - Bank']);
        Permission::create(['name' => PermissionConstant::ADD_BANK, 'mode' => 'admin', 'module' => 'Employees - Bank']);
        Permission::create(['name' => PermissionConstant::UPDATE_BANK, 'mode' => 'admin', 'module' => 'Employees - Bank']);
        Permission::create(['name' => PermissionConstant::DELETE_BANK, 'mode' => 'admin', 'module' => 'Employees - Bank']);
        
        Permission::create(['name' => PermissionConstant::VIEW_EXPERIENCE, 'mode' => 'admin', 'module' => 'Employees - Qualification - Experience']);
        Permission::create(['name' => PermissionConstant::ADD_EXPERIENCE, 'mode' => 'admin', 'module' => 'Employees - Qualification - Experience']);
        Permission::create(['name' => PermissionConstant::UPDATE_EXPERIENCE, 'mode' => 'admin', 'module' => 'Employees - Qualification - Experience']);
        Permission::create(['name' => PermissionConstant::DELETE_EXPERIENCE, 'mode' => 'admin', 'module' => 'Employees - Qualification - Experience']);
        
        Permission::create(['name' => PermissionConstant::VIEW_EDUCATION, 'mode' => 'admin', 'module' => 'Employees - Qualification - Education']);
        Permission::create(['name' => PermissionConstant::ADD_EDUCATION, 'mode' => 'admin', 'module' => 'Employees - Qualification - Education']);
        Permission::create(['name' => PermissionConstant::UPDATE_EDUCATION, 'mode' => 'admin', 'module' => 'Employees - Qualification - Education']);
        Permission::create(['name' => PermissionConstant::DELETE_EDUCATION, 'mode' => 'admin', 'module' => 'Employees - Qualification - Education']);
        
        Permission::create(['name' => PermissionConstant::VIEW_SKILL, 'mode' => 'admin', 'module' => 'Employees - Qualification - Skill']);
        Permission::create(['name' => PermissionConstant::ADD_SKILL, 'mode' => 'admin', 'module' => 'Employees - Qualification - Skill']);
        Permission::create(['name' => PermissionConstant::UPDATE_SKILL, 'mode' => 'admin', 'module' => 'Employees - Qualification - Skill']);
        Permission::create(['name' => PermissionConstant::DELETE_SKILL, 'mode' => 'admin', 'module' => 'Employees - Qualification - Skill']);
        
        Permission::create(['name' => PermissionConstant::VIEW_ATTACHMENT, 'mode' => 'admin', 'module' => 'Employees - Attachment']);
        Permission::create(['name' => PermissionConstant::ADD_ATTACHMENT, 'mode' => 'admin', 'module' => 'Employees - Attachment']);
        Permission::create(['name' => PermissionConstant::DELETE_ATTACHMENT, 'mode' => 'admin', 'module' => 'Employees - Attachment']);
        Permission::create(['name' => PermissionConstant::DOWNLOAD_ATTACHMENT, 'mode' => 'admin', 'module' => 'Employees - Attachment']);
        
        Permission::create(['name' => PermissionConstant::VIEW_WORK_DAYS, 'mode' => 'admin', 'module' => 'Employees - Work Days']);
        
        Permission::create(['name' => PermissionConstant::VIEW_REPORT_TO, 'mode' => 'admin', 'module' => 'Employees - Report To']);
        Permission::create(['name' => PermissionConstant::ADD_REPORT_TO, 'mode' => 'admin', 'module' => 'Employees - Report To']);
        Permission::create(['name' => PermissionConstant::UPDATE_REPORT_TO, 'mode' => 'admin', 'module' => 'Employees - Report To']);
        Permission::create(['name' => PermissionConstant::DELETE_REPORT_TO, 'mode' => 'admin', 'module' => 'Employees - Report To']);
        
        Permission::create(['name' => PermissionConstant::VIEW_HISTORY, 'mode' => 'admin', 'module' => 'Employees - History']);
        
        Permission::create(['name' => PermissionConstant::VIEW_EMP_SECURITY_GROUP, 'mode' => 'admin', 'module' => 'Employees - Security Group']);
        Permission::create(['name' => PermissionConstant::ADD_EMP_SECURITY_GROUP, 'mode' => 'admin', 'module' => 'Employees - Security Group']);
        Permission::create(['name' => PermissionConstant::DELETE_EMP_SECURITY_GROUP, 'mode' => 'admin', 'module' => 'Employees - Security Group']);
        
        Permission::create(['name' => PermissionConstant::VIEW_ATTENDANCE, 'mode' => 'admin', 'module' => 'Employees - Attendance']);
        
        Permission::create(['name' => PermissionConstant::VIEW_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company']);
        Permission::create(['name' => PermissionConstant::ADD_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company', 'superadmin' => 1]);
        Permission::create(['name' => PermissionConstant::UPDATE_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company']);
        Permission::create(['name' => PermissionConstant::DELETE_COMPANY, 'mode' => 'admin', 'module' => 'Settings - Company', 'superadmin' => 1]);
        
        Permission::create(['name' => PermissionConstant::VIEW_COST_CENTRE, 'mode' => 'admin', 'module' => 'Settings - Cost Centre']);
        Permission::create(['name' => PermissionConstant::ADD_COST_CENTRE, 'mode' => 'admin', 'module' => 'Settings - Cost Centre']);
        Permission::create(['name' => PermissionConstant::UPDATE_COST_CENTRE, 'mode' => 'admin', 'module' => 'Settings - Cost Centre']);
        Permission::create(['name' => PermissionConstant::DELETE_COST_CENTRE, 'mode' => 'admin', 'module' => 'Settings - Cost Centre']);
        
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
        
        Permission::create(['name' => PermissionConstant::VIEW_TEAM, 'mode' => 'admin', 'module' => 'Settings - Team']);
        Permission::create(['name' => PermissionConstant::ADD_TEAM, 'mode' => 'admin', 'module' => 'Settings - Team']);
        Permission::create(['name' => PermissionConstant::UPDATE_TEAM, 'mode' => 'admin', 'module' => 'Settings - Team']);
        Permission::create(['name' => PermissionConstant::DELETE_TEAM, 'mode' => 'admin', 'module' => 'Settings - Team']);
        
        Permission::create(['name' => PermissionConstant::VIEW_POSITION, 'mode' => 'admin', 'module' => 'Settings - Position']);
        Permission::create(['name' => PermissionConstant::ADD_POSITION, 'mode' => 'admin', 'module' => 'Settings - Position']);
        Permission::create(['name' => PermissionConstant::UPDATE_POSITION, 'mode' => 'admin', 'module' => 'Settings - Position']);
        Permission::create(['name' => PermissionConstant::DELETE_POSITION, 'mode' => 'admin', 'module' => 'Settings - Position']);
        
        Permission::create(['name' => PermissionConstant::VIEW_GRADE, 'mode' => 'admin', 'module' => 'Settings - Grade']);
        Permission::create(['name' => PermissionConstant::ADD_GRADE, 'mode' => 'admin', 'module' => 'Settings - Grade']);
        Permission::create(['name' => PermissionConstant::UPDATE_GRADE, 'mode' => 'admin', 'module' => 'Settings - Grade']);
        Permission::create(['name' => PermissionConstant::DELETE_GRADE, 'mode' => 'admin', 'module' => 'Settings - Grade']);
        
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
        
        Permission::create(['name' => PermissionConstant::VIEW_EMPLOYMENT_STATUS, 'mode' => 'admin', 'module' => 'Settings - Employment Status']);
        Permission::create(['name' => PermissionConstant::ADD_EMPLOYMENT_STATUS, 'mode' => 'admin', 'module' => 'Settings - Employment Status']);
        Permission::create(['name' => PermissionConstant::UPDATE_EMPLOYMENT_STATUS, 'mode' => 'admin', 'module' => 'Settings - Employment Status']);
        Permission::create(['name' => PermissionConstant::DELETE_EMPLOYMENT_STATUS, 'mode' => 'admin', 'module' => 'Settings - Employment Status']);
        
        Permission::create(['name' => PermissionConstant::VIEW_COMPANY_ASSET, 'mode' => 'admin', 'module' => 'Settings - Company Asset']);
        Permission::create(['name' => PermissionConstant::ADD_COMPANY_ASSET, 'mode' => 'admin', 'module' => 'Settings - Company Asset']);
        Permission::create(['name' => PermissionConstant::UPDATE_COMPANY_ASSET, 'mode' => 'admin', 'module' => 'Settings - Company Asset']);
        Permission::create(['name' => PermissionConstant::DELETE_COMPANY_ASSET, 'mode' => 'admin', 'module' => 'Settings - Company Asset']);
        
        Permission::create(['name' => PermissionConstant::VIEW_SECURITY_GROUP, 'mode' => 'admin', 'module' => 'Settings - Security Group']);
        Permission::create(['name' => PermissionConstant::ADD_SECURITY_GROUP, 'mode' => 'admin', 'module' => 'Settings - Security Group']);
        Permission::create(['name' => PermissionConstant::UPDATE_SECURITY_GROUP, 'mode' => 'admin', 'module' => 'Settings - Security Group']);
        Permission::create(['name' => PermissionConstant::DELETE_SECURITY_GROUP, 'mode' => 'admin', 'module' => 'Settings - Security Group']);
        
        Permission::create(['name' => PermissionConstant::VIEW_BANK_CODE, 'mode' => 'admin', 'module' => 'Settings - Bank Code']);
        Permission::create(['name' => PermissionConstant::ADD_BANK_CODE, 'mode' => 'admin', 'module' => 'Settings - Bank Code']);
        Permission::create(['name' => PermissionConstant::UPDATE_BANK_CODE, 'mode' => 'admin', 'module' => 'Settings - Bank Code']);
        Permission::create(['name' => PermissionConstant::DELETE_BANK_CODE, 'mode' => 'admin', 'module' => 'Settings - Bank Code']);
        
        Permission::create(['name' => PermissionConstant::VIEW_DEPARTMENT, 'mode' => 'admin', 'module' => 'Settings - Department']);
        Permission::create(['name' => PermissionConstant::ADD_DEPARTMENT, 'mode' => 'admin', 'module' => 'Settings - Department']);
        Permission::create(['name' => PermissionConstant::UPDATE_DEPARTMENT, 'mode' => 'admin', 'module' => 'Settings - Department']);
        Permission::create(['name' => PermissionConstant::DELETE_DEPARTMENT, 'mode' => 'admin', 'module' => 'Settings - Department']);
        
        //Employee mode
        Permission::create(['name' => PermissionConstant::VIEW_EMPLOYEE_DASHBOARD, 'mode' => 'employee', 'module' => 'Employee Dashboard']);
        
        $role = Role::where('name', 'Super Admin')->first();
        $role->givePermissionTo(Permission::all());
    }
}
