<?php
namespace App\Repositories\Employee;

use App\Employee;

class EloquentEmployee implements EmployeeRepository
{
    protected $employee;
    
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
    
    public function find($id)
    {
        return $this->employee->where([
            ['id', $id]
        ])->get();
    }

}

