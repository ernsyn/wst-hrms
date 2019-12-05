<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Permission;
use App\Role;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Super Admin|HR Admin']);
    }

    public function index()
    {
        $roles = Role::all();
        
        return view('pages.admin.role-permission.index', [
            'roles' => $roles
        ]);
    }
    
    public function create() 
    {
        $adminPermissions = Permission::where('mode', 'admin')->get();
        $employeePermissions = Permission::where('mode', 'employee')->get();
        
        return view('pages.admin.role-permission.create', [
            'adminPermissions' => $adminPermissions,
            'employeePermissions' => $employeePermissions
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles|max:255',
        ]);
        
        $name = $request['name'];
        $description = $request['description'];
        $permissions = $request['permissions'];
        
        DB::beginTransaction();
        $role = new Role();
        $role->name = $name;
        $role->description = $description;
        $role->guard_name = 'web';
        $role->save();
        
        Log::debug("Role: ".$role);
        Log::debug("Permissions: ");
        Log::debug($permissions);
        
        if (!empty($permissions)) {
            foreach ($permissions as $permissionId) {
                $permission = Permission::find($permissionId);
                $role->givePermissionTo($permission);
            }
        }
        DB::commit();
        
        return redirect()->route('admin.role-permission')->with('success', 'Role '.$name.' added!');
    }
    
    public function show($id)
    {
        $adminPermissions = Permission::where('mode', 'admin')->get();
        $employeePermissions = Permission::where('mode', 'employee')->get();
        $role = Role::findById($id);
        $role->load('permissions')->pluck('id');
        $permissions = array();
        
        foreach($role->permissions as $permission) {
            array_push($permissions, $permission->id);
        }

        return view('pages.admin.role-permission.show', [
            'role' => $role,
            'permissions' => $permissions,
            'adminPermissions' => $adminPermissions,
            'employeePermissions' => $employeePermissions
        ]);
    }
    
    public function edit($id)
    {
        $adminPermissions = Permission::where('mode', 'admin')->get();
        $employeePermissions = Permission::where('mode', 'employee')->get();
        $role = Role::findById($id);
        $role->load('permissions')->pluck('id');
        $permissions = array();
        
        foreach($role->permissions as $permission) {
            array_push($permissions, $permission->id);
        }
        
        return view('pages.admin.role-permission.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'adminPermissions' => $adminPermissions,
            'employeePermissions' => $employeePermissions
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:roles,name,'.$id,
        ]);

        $name = $request['name'];
        $description = $request['description'];
        $permissions = $request['permissions'];
        
        DB::beginTransaction();
        $role = Role::findById($id);
        $role->name = $name;
        $role->description = $description;
        $role->guard_name = 'web';
        $role->save();
        
        $role->load('permissions')->pluck('id');
        $storedPermissions = array();
        
        // remove permission from role
        foreach($role->permissions as $permission) {
            array_push($storedPermissions, $permission->id);
            
            if(!in_array($permission->id, $permissions)) {
                $permission = Permission::find($permission->id);
                $role->revokePermissionTo($permission);
            } 
        }
        
        Log::debug("Update Role: ".$role);
        Log::debug("Permissions: ");
        Log::debug($permissions);
        
        // add permission to role
        if(!empty($permissions)) {
            foreach ($permissions as $permissionId) {
                if(!in_array($permissionId, $storedPermissions)) {
                    $permission = Permission::find($permissionId);
                    $role->givePermissionTo($permission);
                } 
            }
        }
        
        DB::commit();
        
        return redirect()->route('admin.role-permission')->with('success', 'Role '.$name.' has been updated!');
    }
    
    public function destroy($id)
    {
        $role = Role::findById($id);
        $role->delete();
        
        return redirect()->route('admin.role-permission')->with('success', 'Role '.$role->name.' has been deleted!');
    }
}
