<?php
namespace App\Repositories\Employee;

use App\EmployeeReportTo;

class EloquentEmployeeReportTo implements EmployeeReportToRepository
{
    protected $employeeReportTo;
    
    public function __construct(EmployeeReportTo $employeeReportTo)
    {
        $this->employeeReportTo = $employeeReportTo;
    }
    
    public function isKpiProposer($employeeId, $currentUser)
    {
        return $this->employeeReportTo->where([
            ['emp_id', $employeeId],
            ['report_to_emp_id', $currentUser],
            ['kpi_proposer', 1]
        ])->exists();
    }

}

