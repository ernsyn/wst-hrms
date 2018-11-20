<?php
namespace App\Repositories\Employee;

use App\EmployeeSupervisor;

class EloquentEmployeeSupervisor implements EmployeeSupervisorRepository
{
    protected $employeeSupervisor;
    
    public function __construct(EmployeeSupervisor $employeeSupervisor)
    {
        $this->employeeSupervisor = $employeeSupervisor;
    }
    
    public function isKpiProposer($employeeId, $currentUser)
    {
        return $this->employeeSupervisor->where([
            ['emp_id', $employeeId],
            ['supervisor_emp_id', $currentUser],
            ['kpi_proposer', 1]
        ])->exists();
    }

}

