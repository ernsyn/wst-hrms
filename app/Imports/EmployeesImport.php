<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EmployeesImport implements WithMultipleSheets 
{
    public function sheets(): array
    {
        return [
            1 => new ProfileSheetImport(),
            2 => new DisciplinaryIssueSheetImport(),
            3 => new EmergencySheetImport(),
            4 => new DependentSheetImport(),
            5 => new ImmigrationSheetImport(),
            6 => new VisaSheetImport(),
            7 => new JobSheetImport(),
            8 => new BankSheetImport(),
            9 => new QualificationSheetImport(),
            10 => new ReportToSheetImport(),
            11 => new SecurityGroupSheetImport()
        ];
    }

}
