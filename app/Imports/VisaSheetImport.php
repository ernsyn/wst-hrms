<?php

namespace App\Imports;

use App\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\EmployeeVisa;

class VisaSheetImport implements WithHeadingRow, ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        Log::debug('Visa Sheet');
        
        foreach ($collection as $row)
        {
            Log::debug($row);
            
            if($row['employee_id'] != null) {
                $employee = Employee::with('user')->where('code',$row['employee_id'])->first();
                Log::debug($employee);
                
                if(isset($employee)) {
                    EmployeeVisa::create([
                        'type' => $row['type'],
                        'visa_number' => $row['visa_number'],
                        'expiry_date' => $row['expiry_date'],
                        'issued_by' => $row['issued_by'],
                        'issued_date' => $row['issued_date'],
                        'family_members' => $row['relationship'],
                        'emp_id' => $employee->id,
                    ]);
                }
            }
        }
    }
}
