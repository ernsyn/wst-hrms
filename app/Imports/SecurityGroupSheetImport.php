<?php

namespace App\Imports;

use App\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\EmployeeSecurityGroup;

class SecurityGroupSheetImport implements WithHeadingRow, ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        Log::debug('Security Group Sheet');
        
        foreach ($collection as $row)
        {
            Log::debug($row);
            
            if($row['employee_id'] != null) {
                $employee = Employee::with('user')->where('code',$row['employee_id'])->first();
                Log::debug($employee);
                
                if(isset($employee)) {
                    EmployeeSecurityGroup::create([
                        'security_group_id' => $row['security_group'],
                        'emp_id' => $employee->id,
                    ]);
                }
            }
        }
    }
}
