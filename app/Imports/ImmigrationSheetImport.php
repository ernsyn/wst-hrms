<?php

namespace App\Imports;

use App\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\EmployeeImmigration;

class ImmigrationSheetImport implements WithHeadingRow, ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        Log::debug('Immigration Sheet');
        
        foreach ($collection as $row)
        {
            Log::debug($row);
            
            if($row['employee_id'] != null) {
                $employee = Employee::with('user')->where('code',$row['employee_id'])->first();
                Log::debug($employee);
                
                if(isset($employee)) {
                    EmployeeImmigration::create([
                        'passport_no' => $row['passport_no'],
                        'expiry_date' => $row['expiry_date'],
                        'issued_by' => $row['issued_by'],
                        'issued_date' => $row['issued_date'],
                        'emp_id' => $employee->id,
                    ]);
                }
            }
        }
    }
}
