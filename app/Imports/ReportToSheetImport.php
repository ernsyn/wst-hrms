<?php

namespace App\Imports;

use App\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\EmployeeReportTo;

class ReportToSheetImport implements WithHeadingRow, ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        Log::debug('Report To Sheet');
        
        foreach ($collection as $row)
        {
            Log::debug($row);
            
            if($row['employee_id'] != null) {
                $employee = Employee::with('user')->where('code',$row['employee_id'])->first();
                Log::debug($employee);
                
                if(isset($employee)) {
                    EmployeeReportTo::create([
                        'report_to_emp_id' => $row['security_group'],
                        'emp_id' => $employee->id,
                        'type' => $row['security_group'],
                        'kpi_proposer' => $row['security_group'],
                        'notes' => $row['security_group'],
                        'report_to_level' => $row['security_group'],
                    ]);
                }
            }
        }
    }
}
