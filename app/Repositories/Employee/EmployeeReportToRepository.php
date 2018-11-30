<?php
namespace App\Repositories\Employee;

interface EmployeeReportToRepository
{
    public function isKpiProposer($employeeId, $currentUser);
}

