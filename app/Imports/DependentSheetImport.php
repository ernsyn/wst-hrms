<?php

namespace App\Imports;

use App\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\EmployeeDependent;

class DependentSheetImport implements WithHeadingRow, ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        Log::debug('Dependent Sheet');
        
        foreach ($collection as $row)
        {
            Log::debug($row);
            
            if($row['employee_id'] != null) {
                $employee = Employee::with('user')->where('code',$row['employee_id'])->first();
                Log::debug($employee);
                
                if(isset($employee)) {
                    EmployeeDependent::create([
                        'emp_id' => $employee->id,
                        'name' => $row['name'],
                        'ic_no' => $row['ic_no'],
                        'occupation' => $row['occupation'],
                        'relationship' => $row['relationship'],
                        'dob' => $row['date_of_birth']
                    ]);
                }
            }
        }
    }
}
