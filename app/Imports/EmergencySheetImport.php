<?php

namespace App\Imports;

use App\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\EmployeeEmergencyContact;

class EmergencySheetImport implements WithHeadingRow, ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        Log::debug('Emergency Sheet');
        
        foreach ($collection as $row)
        {
            Log::debug($row);
            
            if($row['employee_id'] != null) {
                $employee = Employee::with('user')->where('code',$row['employee_id'])->first();
                Log::debug($employee);
                
                if(isset($employee)) {
                    EmployeeEmergencyContact::create([
                        'name' => $row['name'],
                        'relationship' => $row['relationship'],
                        'contact_no' => $row['contact_no'],
                        'emp_id' => $employee->id
                    ]);
                }
            }
        }
    }
}
