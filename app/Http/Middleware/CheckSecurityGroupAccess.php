<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\AccessControllHelper;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Employee;

class CheckSecurityGroupAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::debug('>>>>>>>>>> Security Gorup middleware');
        Log::debug($request->route('id'));
        $empId = $request->route('id');
        $employee = Employee::find($empId);
        $securityGroups = AccessControllHelper::getSecurityGroupAccess();
        $permissions = array('security group');
        if (!in_array($employee->main_security_group_id, $securityGroups)) {
            throw UnauthorizedException::forPermissions($permissions);
        }
        
        return $next($request);
    }
}
