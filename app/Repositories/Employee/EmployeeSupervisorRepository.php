<?php
namespace App\Repositories\Employee;

interface EmployeeSupervisorRepository
{
    public function isKpiProposer($employeeId, $currentUser);
}

