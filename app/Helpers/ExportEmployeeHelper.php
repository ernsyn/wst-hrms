<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExportEmployeeHelper
{
    CONST ROW = 20;
    
    public static function generateProfileSheet($spreadsheet)
    {
        $profiles = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Profile');
        $spreadsheet->addSheet($profiles);
        
        $profiles->getCell('A1')->setValue('Name*');
        $profiles->getCell('B1')->setValue('Email*');
        $profiles->getCell('C1')->setValue('Personal Email*');
        $profiles->getCell('D1')->setValue('Contact No*');
        $profiles->getCell('E1')->setValue('Address Line 1*');
        $profiles->getCell('F1')->setValue('Address Line 2');
        $profiles->getCell('G1')->setValue('Address Line 3');
        $profiles->getCell('H1')->setValue('Postcode*');
        $profiles->getCell('I1')->setValue('IC No*');
        $profiles->getCell('J1')->setValue('Gender*');
        $profiles->getCell('K1')->setValue('Date of Birth*');
        $profiles->getCell('L1')->setValue('Race*');
        $profiles->getCell('M1')->setValue('Nationality*');
        $profiles->getCell('N1')->setValue('Marital Status*');
        $profiles->getCell('O1')->setValue('Spouse Name');
        $profiles->getCell('P1')->setValue('Spouse IC No');
        $profiles->getCell('Q1')->setValue('Spouse Tax No');
        $profiles->getCell('R1')->setValue('No Of Children*');
        $profiles->getCell('S1')->setValue('Driver License No');
        $profiles->getCell('T1')->setValue('License Expiry Date');
        $profiles->getCell('U1')->setValue('Payment Via*');
        $profiles->getCell('V1')->setValue('Payment Rate*');
        $profiles->getCell('W1')->setValue('Category');
        $profiles->getCell('X1')->setValue('Tax No');
        $profiles->getCell('Y1')->setValue('PCB Group');
        $profiles->getCell('Z1')->setValue('EPF No');
        $profiles->getCell('AA1')->setValue('EPF Category');
        $profiles->getCell('AB1')->setValue('EIS No');
        $profiles->getCell('AC1')->setValue('SOCSO No*');
        $profiles->getCell('AD1')->setValue('SOCSO Category*');
        $profiles->getCell('AE1')->setValue('Employee ID*');
        $profiles->getCell('AF1')->setValue('Security Group*');
        $profiles->getCell('AG1')->setValue('Role*');
        
        //$i=2;
        for($i = 2;$i<=self::ROW;$i++)
        {
            self::profilesDataValidation($profiles, $i);
        }
        
        return $profiles;
    }
    
    public static function generateDisciplinaryIssueSheet($spreadsheet)
    {
        $disciplines = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Disciplinary Issue');
        $spreadsheet->addSheet($disciplines);
        
        $disciplines->getCell('A1')->setValue('Employee ID*');
        $disciplines->getCell('B1')->setValue('Date*');
        $disciplines->getCell('C1')->setValue('Title*');
        $disciplines->getCell('D1')->setValue('Description*');
        
        //$i=2;
        for($i = 2;$i<=self::ROW;$i++)
        {
            self::disciplinaryIssueDataValidation($disciplines, $i);
        }
        
        return $disciplines;
    }
    
    public static function generateEmergencySheet($spreadsheet)
    {
        $emergencies = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Emergency');
        $spreadsheet->addSheet($emergencies);
        
        $emergencies->getCell('A1')->setValue('Employee ID*');
        $emergencies->getCell('B1')->setValue('Name*');
        $emergencies->getCell('C1')->setValue('Relationship*');
        $emergencies->getCell('D1')->setValue('Contact No*');
        
        return $emergencies;
    }
    
    public static function generateDependentSheet($spreadsheet)
    {
        $dependents = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Dependent');
        $spreadsheet->addSheet($dependents);
        
        $dependents->getCell('A1')->setValue('Employee ID*');
        $dependents->getCell('B1')->setValue('Name*');
        $dependents->getCell('C1')->setValue('IC No');
        $dependents->getCell('D1')->setValue('Occupation');
        $dependents->getCell('E1')->setValue('Relationship*');
        $dependents->getCell('F1')->setValue('Date Of Birth*');
        
        //$i=2;
        for($i = 2;$i<=self::ROW;$i++)
        {
            $dependents->getStyle('C'.$i)
                ->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
            $dependents->getCell('F'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Invalid Format.')
                ->setPromptTitle('Format:yyyy-mm-dd')
                ->setPrompt('Example:2020-01-19');
        }
        
        return $dependents;
    }
    
    public static function generateImmigrationSheet($spreadsheet)
    {
        $immigrations = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Immigration');
        $spreadsheet->addSheet($immigrations);
        
        $immigrations->getCell('A1')->setValue('Employee ID*');
        $immigrations->getCell('B1')->setValue('Passport No*');
        $immigrations->getCell('C1')->setValue('Issued By*');
        $immigrations->getCell('D1')->setValue('Issued Date*');
        $immigrations->getCell('E1')->setValue('Expiry Date*');
        
        //$i=2;
        for($i = 2;$i<=self::ROW;$i++)
        {
            $immigrations->getCell('D'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Invalid Format.')
                ->setPromptTitle('Format:yyyy-mm-dd')
                ->setPrompt('Example:2020-01-19');
            $immigrations->getCell('E'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Invalid Format.')
                ->setPromptTitle('Format:yyyy-mm-dd')
                ->setPrompt('Example:2020-01-19');
        }
        
        return $immigrations;
    }
    
    public static function generateVisaSheet($spreadsheet)
    {
        $visas = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Visa');
        $spreadsheet->addSheet($visas);
        
        $visas->getCell('A1')->setValue('Employee ID*');
        $visas->getCell('B1')->setValue('Type*');
        $visas->getCell('C1')->setValue('Visa Number*');
        $visas->getCell('D1')->setValue('Issued By*');
        $visas->getCell('E1')->setValue('Issued Date*');
        $visas->getCell('F1')->setValue('Expiry Date*');
        $visas->getCell('G1')->setValue('Relationship*');
        
        //$i=2;
        for($i = 2;$i<=self::ROW;$i++)
        {
            $visas->getCell('E'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Invalid Format.')
                ->setPromptTitle('Format:yyyy-mm-dd')
                ->setPrompt('Example:2020-01-19');
            $visas->getCell('F'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Invalid Format.')
                ->setPromptTitle('Format:yyyy-mm-dd')
                ->setPrompt('Example:2020-01-19');
        }
        
        return $visas;
    }
    
    public static function generateJobSheet($spreadsheet)
    {
        $jobs = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Job');
        $spreadsheet->addSheet($jobs);
        
        $jobs->getCell('A1')->setValue('Employee ID*');
        $jobs->getCell('B1')->setValue('Cost Centre');
        $jobs->getCell('C1')->setValue('Department');
        $jobs->getCell('D1')->setValue('Team*');
        $jobs->getCell('E1')->setValue('Position');
        $jobs->getCell('F1')->setValue('Grade*');
        $jobs->getCell('G1')->setValue('Section');
        $jobs->getCell('H1')->setValue('Company*');
        $jobs->getCell('I1')->setValue('Branch*');
        $jobs->getCell('J1')->setValue('New Basic Salary*');
        $jobs->getCell('K1')->setValue('Date*');
        $jobs->getCell('L1')->setValue('Employment Status*');
        $jobs->getCell('M1')->setValue('Remarks');
        
        //$i=2;
        for($i = 2;$i<=self::ROW;$i++)
        {
            $jobs->getCell('K'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Invalid Format.')
                ->setPromptTitle('Format:yyyy-mm-dd')
                ->setPrompt('Example:2020-01-19');
            
            $jobs->getCell('B'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('costcentre!$A:$A');
            
            $jobs->getCell('C'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('department!$A:$A');
            
            $jobs->getCell('D'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('team!$A:$A');
            
            $jobs->getCell('E'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('position!$A:$A');
            
            $jobs->getCell('F'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('grade!$A:$A');
            
            $jobs->getCell('G'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('section!$A:$A');
            
            $jobs->getCell('H'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('company!$A:$A');
            
            $jobs->getCell('I'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('branch!$A:$A');
            
            $jobs->getCell('J'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('status!$A:$A');
        }
        
        return $jobs;
    }
    
    public static function generateBankSheet($spreadsheet)
    {
        $banks = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Bank');
        $spreadsheet->addSheet($banks);
        
        $banks->getCell('A1')->setValue('Employee ID*');
        $banks->getCell('B1')->setValue('Bank Name*');
        $banks->getCell('C1')->setValue('Account Number*');
        
        //$i=2;
        for($i = 2;$i<=self::ROW;$i++)
        {
            $banks->getCell('B'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('banklist!$A:$A');
        }
        
        return $banks;
    }
    
    public static function generateQualificationSheet($spreadsheet)
    {
        $qualifications = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Qualification');
        $spreadsheet->addSheet($qualifications);
        
        $qualifications->getCell('A1')->setValue('Employee ID*');
        $qualifications->getCell('B1')->setValue('Company*');
        $qualifications->getCell('C1')->setValue('Industry*');
        $qualifications->getCell('D1')->setValue('Contact Person/ Tel*');
        $qualifications->getCell('E1')->setValue('Position*');
        $qualifications->getCell('F1')->setValue('Start Date*');
        $qualifications->getCell('G1')->setValue('End Date*');
        $qualifications->getCell('H1')->setValue('Notes');
        
        //$i=2;
        for($i = 2;$i<=self::ROW;$i++)
        {
            $qualifications->getCell('F'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Invalid Format.')
                ->setPromptTitle('Format:yyyy-mm-dd')
                ->setPrompt('Example:2020-01-19');
            $qualifications->getCell('G'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Invalid Format.')
                ->setPromptTitle('Format:yyyy-mm-dd')
                ->setPrompt('Example:2020-01-19');
        }
        
        return $qualifications;
    }
    
    public static function generateReportToSheet($spreadsheet)
    {
        $reportTo = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'ReportTo');
        $spreadsheet->addSheet($reportTo);
        
        $reportTo->getCell('A1')->setValue('Employee ID*');
        $reportTo->getCell('B1')->setValue('Report To*');
        $reportTo->getCell('C1')->setValue('Type*');
        $reportTo->getCell('D1')->setValue('Report To Level*');
        $reportTo->getCell('E1')->setValue('KPI Proposer*');
        $reportTo->getCell('F1')->setValue('Payroll Period');
        $reportTo->getCell('G1')->setValue('Note');
        
        //$i=2;
        for($i = 2;$i<=self::ROW;$i++)
        {
            $reportTo->getCell('B'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('employee!$A:$A');
            
            $reportTo->getCell('C'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('"Direct,Indirect"');
            
            $reportTo->getCell('D'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('"1,2,3,4,5,6,7,8"');
            
            $reportTo->getCell('E'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('"Yes,No"');
            $reportTo->getCell('F'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('payroll!$A:$A');
        }
        
        return $reportTo;
    }
    
    public static function generateSecurityGroupSheet($spreadsheet)
    {
        $securityGroup = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'SecurityGroup');
        $spreadsheet->addSheet($securityGroup);
        
        $securityGroup->getCell('A1')->setValue('Employee ID*');
        $securityGroup->getCell('B1')->setValue('Name*');
        
        //$i=2;
        for($i = 2;$i<=self::ROW;$i++)
        {
            $securityGroup->getCell('B'.$i)->getDataValidation()
                ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
                ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('Input error')
                ->setError('Value is not in list.')
                ->setPromptTitle('Pick from list')
                ->setPrompt('Please pick a value from the drop-down list.')
                ->setFormula1('security!$A:$A');
        }
        
        return $securityGroup;
    }
    
    public static function generateCountrySheet($spreadsheet)
    {
        $country = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'country');
        $spreadsheet->addSheet($country);
        
        $countryName = DB::table('countries')->select('name')->get();
        
        $i=1;
        foreach($countryName as $countryNa)
        {
            $country->setCellValue('A'.$i,$countryNa->name);
            $i++;
        }
    }
    
    public static function generateCategorySheet($spreadsheet)
    {
        $category = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'category');
        $spreadsheet->addSheet($category);
        
        $categoryName = DB::table('categories')->select('name')->get();
        $i=1;
        foreach($categoryName as $categoryNa)
        {
            $category->setCellValue('A'.$i,$categoryNa->name);
            $i++;
        }
    }
    
    public static function generateSecuritySheet($spreadsheet)
    {
        $security = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'security');
        $spreadsheet->addSheet($security);
        
        $securityName = DB::table('security_groups')->select('name')->get();
        $i=1;
        foreach($securityName as $securityNa)
        {
            $security->setCellValue('A'.$i,$securityNa->name);
            $i++;
        }
    }
    
    public static function generateCostCentreSheet($spreadsheet)
    {
        $cost_centre = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'costcentre');
        $spreadsheet->addSheet($cost_centre);
        
        $costCentreName = DB::table('cost_centres')->select('name')->get();
        $i=1;
        foreach($costCentreName as $costCentreNa)
        {
            $cost_centre->setCellValue('A'.$i,$costCentreNa->name);
            $i++;
        }
    }
    
    public static function generateDepartmentSheet($spreadsheet)
    {
        $department = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'department');
        $spreadsheet->addSheet($department);
        
        $departmentName = DB::table('departments')->select('name')->get();
        $i=1;
        foreach($departmentName as $departmentNa)
        {
            $department->setCellValue('A'.$i,$departmentNa->name);
            $i++;
        }
    }
    
    public static function generateTeamSheet($spreadsheet)
    {
        $team = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'team');
        $spreadsheet->addSheet($team);
        
        $teamName = DB::table('teams')->select('name')->get();
        $i=1;
        foreach($teamName as $teamNa)
        {
            $team->setCellValue('A'.$i,$teamNa->name);
            $i++;
        }
    }
    
    public static function generatePositionSheet($spreadsheet)
    {
        $position = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'position');
        $spreadsheet->addSheet($position);
        
        $positionName = DB::table('employee_positions')->select('name')->get();
        $i=1;
        foreach($positionName as $positionNa)
        {
            $position->setCellValue('A'.$i,$positionNa->name);
            $i++;
        }
    }
    
    public static function generateGradeSheet($spreadsheet)
    {
        $grade = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'grade');
        $spreadsheet->addSheet($grade);
        
        $gradeName = DB::table('employee_grades')->select('name')->get();
        $i=1;
        foreach($gradeName as $gradeNa)
        {
            $grade->setCellValue('A'.$i,$gradeNa->name);
            $i++;
        }
    }
    
    public static function generatSectionSheet($spreadsheet)
    {
        $section = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'section');
        $spreadsheet->addSheet($section);
        
        $sectionName = DB::table('sections')->select('name')->get();
        $i=1;
        foreach($sectionName as $sectionNa)
        {
            $section->setCellValue('A'.$i,$sectionNa->name);
            $i++;
        }
        
    }
    
    public static function generateCompanySheet($spreadsheet)
    {
        $company = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'company');
        $spreadsheet->addSheet($company);
        
        $companyName = DB::table('job_companies')->select('company_name')->get();
        $i=1;
        foreach($companyName as $companyNa)
        {
            $company->setCellValue('A'.$i,$companyNa->company_name);
            $i++;
        }
    }
    
    public static function generateBranchSheet($spreadsheet)
    {
        $branch = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'branch');
        $spreadsheet->addSheet($branch);
        
        $branchName = DB::table('branches')->select('name')->get();
        $i=1;
        foreach($branchName as $branchNa)
        {
            $branch->setCellValue('A'.$i,$branchNa->name);
            $i++;
        }
    }
    
    public static function generateStatusSheet($spreadsheet)
    {
        $status = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'status');
        $spreadsheet->addSheet($status);
        
        $statusName = DB::table('employment_statuses')->select('name')->get();
        $i=1;
        foreach($statusName as $statusNa)
        {
            $status->setCellValue('A'.$i,$statusNa->name);
            $i++;
        }
    }
    
    public static function generateRoleSheet($spreadsheet)
    {
        $role = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'role');
        $spreadsheet->addSheet($role);
        
        $roleName = DB::table('roles')->select('name')->where('name', '!=', 'Super Admin')->get();
        $i=1;
        foreach($roleName as $roleNa)
        {
            $role->setCellValue('A'.$i,$roleNa->name);
            $i++;
        }
    }
    
    public static function generateBankListSheet($spreadsheet)
    {
        $bankList = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'banklist');
        $spreadsheet->addSheet($bankList);
        
        $bankName = DB::table('bank_code')->select('name')->get();
        $i=1;
        foreach($bankName as $bankNa)
        {
            $bankList->setCellValue('A'.$i,$bankNa->name);
            $i++;
        }
    }
    
    public static function generateEmployeeSheet($spreadsheet)
    {
        $employee = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'employee');
        $spreadsheet->addSheet($employee);
        
        $employeeName = DB::table('users')->select('name')->get();
        $i=1;
        foreach($employeeName as $employeeNa)
        {
            $employee->setCellValue('A'.$i,$employeeNa->name);
            $i++;
        }
        
    }
    
    public static function generatePayrollSheet($spreadsheet)
    {
        $payroll = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'payroll');
        $spreadsheet->addSheet($payroll);
        
        $payrollPeriodName = DB::table('payroll_period')->select('name')->get();
        $i=1;
        foreach($payrollPeriodName as $payrollPeriodNa)
        {
            $payroll->setCellValue('A'.$i,$payrollPeriodNa->name);
            $i++;
        }
    }
    
    public static function hideSheets($spreadsheet)
    {
        $spreadsheet->getSheetByName('Worksheet')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('country')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('category')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('security')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('costcentre')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('department')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('team')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('position')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('grade')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('section')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('company')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('branch')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('status')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('role')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('banklist')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('employee')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
        $spreadsheet->getSheetByName('payroll')
        ->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);
    }
    
    protected static function buildColumnRange(string $lower, string $upper)
    {
        $upper++;
        for ($i = $lower; $i !== $upper; $i++) {
            yield $i;
        }
    }
    
    public static function generateProfilesData($profiles)
    {
        $profileData = DB::table('employees')
            ->select('users.name', 'users.email','employees.personal_email','employees.contact_no','employees.address','employees.address2','employees.address3','employees.postcode','employees.ic_no','employees.gender','employees.dob','employees.race','countries.name as nationality','employees.marital_status','employees.spouse_name','employees.spouse_ic','employees.spouse_tax_no','employees.total_children','employees.driver_license_no','employees.driver_license_expiry_date','employees.payment_via','employees.payment_rate','categories.name as cateogry','employees.tax_no','employees.pcb_group','employees.epf_no','employees.epf_category','employees.eis_no','employees.socso_no','employees.socso_category','employees.code','security_groups.name as security_group','roles.name as role')
            ->leftjoin('users','employees.user_id','=','users.id')
            ->leftjoin('countries','employees.nationality','=','countries.id')
            ->leftjoin('categories','employees.category_id','=','categories.id')
            ->leftjoin('security_groups','employees.main_security_group_id','=','security_groups.id')
            ->leftjoin('model_has_roles','employees.user_id','=','model_has_roles.model_id')
            ->leftjoin('roles','model_has_roles.role_id','=','roles.id')
            ->get();
        
        $i=2;
        
        foreach($profileData as $profileDa)
        {
            $profiles->setCellValue('A'.$i,$profileDa->name)->getColumnDimension('A')
            ->setAutoSize(true);
            $profiles->setCellValue('B'.$i,$profileDa->email)->getColumnDimension('B')
            ->setAutoSize(true);
            $profiles->setCellValue('C'.$i,$profileDa->personal_email)->getColumnDimension('C')
            ->setAutoSize(true);
            $profiles->setCellValue('D'.$i,$profileDa->contact_no)->getColumnDimension('D')
            ->setAutoSize(true);
            $profiles->setCellValue('E'.$i,$profileDa->address)->getColumnDimension('E')
            ->setAutoSize(true);
            $profiles->setCellValue('F'.$i,$profileDa->address2)->getColumnDimension('F')
            ->setAutoSize(true);
            $profiles->setCellValue('G'.$i,$profileDa->address3)->getColumnDimension('G')
            ->setAutoSize(true);
            $profiles->setCellValue('H'.$i,$profileDa->postcode)->getColumnDimension('H')
            ->setAutoSize(true);
            $profiles->setCellValue('I'.$i,$profileDa->ic_no)->getColumnDimension('I')
            ->setAutoSize(true);
            $profiles->setCellValue('J'.$i,$profileDa->gender)->getColumnDimension('J')
            ->setAutoSize(true);
            $profiles->setCellValue('K'.$i,$profileDa->dob)->getColumnDimension('K')
            ->setAutoSize(true);
            $profiles->setCellValue('L'.$i,$profileDa->race)->getColumnDimension('L')
            ->setAutoSize(true);
            $profiles->setCellValue('M'.$i,$profileDa->nationality)->getColumnDimension('M')
            ->setAutoSize(true);
            $profiles->setCellValue('N'.$i,$profileDa->marital_status)->getColumnDimension('N')
            ->setAutoSize(true);
            $profiles->setCellValue('O'.$i,$profileDa->spouse_name)->getColumnDimension('O')
            ->setAutoSize(true);
            $profiles->setCellValue('P'.$i,$profileDa->spouse_ic)->getColumnDimension('P')
            ->setAutoSize(true);
            $profiles->setCellValue('Q'.$i,$profileDa->spouse_tax_no)->getColumnDimension('Q')
            ->setAutoSize(true);
            $profiles->setCellValue('R'.$i,$profileDa->total_children)->getColumnDimension('R')
            ->setAutoSize(true);
            $profiles->setCellValue('S'.$i,$profileDa->driver_license_no)->getColumnDimension('S')
            ->setAutoSize(true);
            $profiles->setCellValue('T'.$i,$profileDa->driver_license_expiry_date)->getColumnDimension('T')
            ->setAutoSize(true);
            
            if($profileDa->payment_via==1){
                $profiles->setCellValue('U'.$i,'Cash')->getColumnDimension('U')
                ->setAutoSize(true);
            } else if($profileDa->payment_via==2){
                $profiles->setCellValue('U'.$i,'Bank')->getColumnDimension('U')
                ->setAutoSize(true);
            } else if($profileDa->payment_via==3){
                $profiles->setCellValue('U'.$i,'Cheque')->getColumnDimension('U')
                ->setAutoSize(true);
            } else if($profileDa->payment_via==4){
                $profiles->setCellValue('U'.$i,'Withheld')->getColumnDimension('U')
                ->setAutoSize(true);
            } else{
                $profiles->setCellValue('U'.$i,'Credit Note')->getColumnDimension('U')
                ->setAutoSize(true);
            }
            
            if($profileDa->payment_via==1){
                $profiles->setCellValue('V'.$i,'Daily')->getColumnDimension('V')
                ->setAutoSize(true);
            } else if($profileDa->payment_via==2){
                $profiles->setCellValue('V'.$i,'Weekly')->getColumnDimension('V')
                ->setAutoSize(true);
            } else{
                $profiles->setCellValue('V'.$i,'Monthly')->getColumnDimension('V')
                ->setAutoSize(true);
            }
            
            $profiles->setCellValue('W'.$i,$profileDa->cateogry)->getColumnDimension('W')
            ->setAutoSize(true);
            $profiles->setCellValue('X'.$i,$profileDa->tax_no)->getColumnDimension('X')
            ->setAutoSize(true);
            
            if($profileDa->pcb_group==1){
                $profiles->setCellValue('Y'.$i,'Single Person')->getColumnDimension('Y')
                ->setAutoSize(true);
            } else if($profileDa->pcb_group==2){
                $profiles->setCellValue('Y'.$i,'Spouse not working')->getColumnDimension('Y')
                ->setAutoSize(true);
            } else{
                $profiles->setCellValue('Y'.$i,'Spouse working')->getColumnDimension('Y')
                ->setAutoSize(true);
            }
            
            $profiles->setCellValue('Z'.$i,$profileDa->epf_no)->getColumnDimension('Z')
            ->setAutoSize(true);
            if($profileDa->epf_category==1){
                $profiles->setCellValue('AA'.$i,'Category A')->getColumnDimension('AA')
                ->setAutoSize(true);
            } else if($profileDa->epf_category==2){
                $profiles->setCellValue('AA'.$i,'Category B')->getColumnDimension('AA')
                ->setAutoSize(true);
            } else if($profileDa->epf_category==3){
                $profiles->setCellValue('AA'.$i,'Category C')->getColumnDimension('AA')
                ->setAutoSize(true);
            } else if($profileDa->epf_category==4){
                $profiles->setCellValue('AA'.$i,'Category D')->getColumnDimension('AA')
                ->setAutoSize(true);
            } else{
                $profiles->setCellValue('AA'.$i,'Category E')->getColumnDimension('AA')
                ->setAutoSize(true);
            }
            
            $profiles->setCellValue('AB'.$i,$profileDa->eis_no)->getColumnDimension('AB')
            ->setAutoSize(true);
            $profiles->setCellValue('AC'.$i,$profileDa->socso_no)->getColumnDimension('AC')
            ->setAutoSize(true);
            
            if($profileDa->socso_category==1){
                $profiles->setCellValue('AD'.$i,'First Category')->getColumnDimension('AD')
                ->setAutoSize(true);
            } else{
                $profiles->setCellValue('AD'.$i,'Second Category')->getColumnDimension('AD')
                ->setAutoSize(true);
            }
            
            $profiles->setCellValue('AE'.$i,$profileDa->code)->getColumnDimension('AE')
            ->setAutoSize(true);
            $profiles->setCellValue('AF'.$i,$profileDa->security_group)->getColumnDimension('AF')
            ->setAutoSize(true);
            $profiles->setCellValue('AG'.$i,$profileDa->role)->getColumnDimension('AG')
            ->setAutoSize(true);;
            
            self::profilesDataValidation($profiles, $i);
            
            $i++;
        }
    }
    
    public static function generateDisciplinaryIssuesData($disciplines)
    {
        $disciplineData = DB::table('employee_disciplines')
            ->join('employees', 'employees.id', 'employee_disciplines.emp_id')
            ->select('discipline_date','discipline_title','discipline_desc','employees.code')
            ->get();
        
        $i=2;
        foreach($disciplineData as $disciplineDa)
        {
            $disciplines->setCellValue('A'.$i,$disciplineDa->code)
            ->getColumnDimension('A')
            ->setAutoSize(true);
            $disciplines->setCellValue('B'.$i,$disciplineDa->discipline_date)
            ->getColumnDimension('B')
            ->setAutoSize(true);
            $disciplines->setCellValue('C'.$i,$disciplineDa->discipline_title)
            ->getColumnDimension('C')
            ->setAutoSize(true);
            $disciplines->setCellValue('D'.$i,$disciplineDa->discipline_desc)
            ->getColumnDimension('D')
            ->setAutoSize(true);
            
            self::disciplinaryIssueDataValidation($disciplines, $i);
            
            $i++;
        }
    }
    
    public static function generateEmergencyData($emergencies)
    {
        $emergencyData = DB::table('employee_emergency_contacts')
            ->join('employees', 'employees.id', 'employee_emergency_contacts.emp_id')
            ->select('employee_emergency_contacts.name','employee_emergency_contacts.relationship','employee_emergency_contacts.contact_no','employees.code')
            ->get();
        $i=2;
        foreach($emergencyData as $emergencyDa)
        {
            $emergencies->setCellValue('A'.$i,$emergencyDa->code)
            ->getColumnDimension('A')
            ->setAutoSize(true);
            $emergencies->setCellValue('B'.$i,$emergencyDa->name)
            ->getColumnDimension('B')
            ->setAutoSize(true);
            $emergencies->setCellValue('C'.$i,$emergencyDa->relationship)
            ->getColumnDimension('C')
            ->setAutoSize(true);
            $emergencies->setCellValue('D'.$i,$emergencyDa->contact_no)
            ->getColumnDimension('D')
            ->setAutoSize(true);
            $i++;
        }
    }
    
    public static function generateDependentData($dependents)
    {
        $dependentData = DB::table('employee_dependents')
        ->join('employees', 'employees.id', 'employee_dependents.emp_id')
        ->select('employee_dependents.name','employee_dependents.ic_no','employee_dependents.occupation','employee_dependents.relationship','employee_dependents.dob','employees.code')
        ->get();
        $i=2;
        foreach($dependentData as $dependentDa)
        {
            $dependents->setCellValue('A'.$i,$dependentDa->code)
            ->getColumnDimension('A')
            ->setAutoSize(true);
            $dependents->setCellValue('B'.$i,$dependentDa->name)
            ->getColumnDimension('B')
            ->setAutoSize(true);
            $dependents->setCellValue('C'.$i,$dependentDa->ic_no)
            ->getColumnDimension('C')
            ->setAutoSize(true);
            $dependents->setCellValue('D'.$i,$dependentDa->occupation)
            ->getColumnDimension('D')
            ->setAutoSize(true);
            $dependents->setCellValue('E'.$i,$dependentDa->relationship)
            ->getColumnDimension('E')
            ->setAutoSize(true);
            $dependents->setCellValue('F'.$i,$dependentDa->dob)
            ->getColumnDimension('F')
            ->setAutoSize(true);
            
            $dependents->getStyle('C'.$i)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
            $i++;
        }
    }
    
    public static function generateImmigrationData($immigrations)
    {
        $immigrationData = DB::table('employee_immigrations')
        ->join('employees', 'employees.id', 'employee_immigrations.emp_id')
        ->select('passport_no','issued_by','issued_date','expiry_date','employees.code')
        ->get();
        $i=2;
        foreach($immigrationData as $immigrationDa)
        {
            $immigrations->setCellValue('A'.$i,$immigrationDa->code)
            ->getColumnDimension('A')
            ->setAutoSize(true);
            $immigrations->setCellValue('B'.$i,$immigrationDa->passport_no)
            ->getColumnDimension('B')
            ->setAutoSize(true);
            $immigrations->setCellValue('C'.$i,$immigrationDa->issued_by)
            ->getColumnDimension('C')
            ->setAutoSize(true);
            $immigrations->setCellValue('D'.$i,$immigrationDa->issued_date)
            ->getColumnDimension('D')
            ->setAutoSize(true);
            $immigrations->setCellValue('E'.$i,$immigrationDa->expiry_date)
            ->getColumnDimension('E')
            ->setAutoSize(true);
            $i++;
        }
    }
    
    public static function generateVisaData($visas)
    {
        $visaData = DB::table('employee_visas')
        ->join('employees', 'employees.id', 'employee_visas.emp_id')
        ->select('type','visa_number','issued_by','issued_date','expiry_date','family_members','employees.code')
        ->get();
        $i=2;
        foreach($visaData as $visaDa)
        {
            $visas->setCellValue('A'.$i,$visaDa->code)
            ->getColumnDimension('A')
            ->setAutoSize(true);
            $visas->setCellValue('B'.$i,$visaDa->type)
            ->getColumnDimension('B')
            ->setAutoSize(true);
            $visas->setCellValue('C'.$i,$visaDa->visa_number)
            ->getColumnDimension('C')
            ->setAutoSize(true);
            $visas->setCellValue('D'.$i,$visaDa->issued_by)
            ->getColumnDimension('D')
            ->setAutoSize(true);
            $visas->setCellValue('E'.$i,$visaDa->issued_date)
            ->getColumnDimension('E')
            ->setAutoSize(true);
            $visas->setCellValue('F'.$i,$visaDa->expiry_date)
            ->getColumnDimension('F')
            ->setAutoSize(true);
            $visas->setCellValue('G'.$i,$visaDa->family_members)
            ->getColumnDimension('G')
            ->setAutoSize(true);
            $i++;
        }
    }
    
    public static function generateJobData($jobs)
    {
        $jobData = DB::table('employee_jobs')
        ->select('cost_centres.name as cost_centre','departments.name as department','teams.name as team','employee_positions.name as position','employee_grades.name as grade','sections.name as section','job_companies.company_name as company','branches.name as branch','employee_jobs.basic_salary','start_date','remarks','employment_statuses.name as status','employees.code')
        ->leftjoin('cost_centres','employee_jobs.cost_centre_id','=','cost_centres.id')
        ->leftjoin('departments','employee_jobs.department_id','=','departments.id')
        ->leftjoin('teams','employee_jobs.team_id','=','teams.id')
        ->leftjoin('employee_positions','employee_jobs.emp_mainposition_id','=','employee_positions.id')
        ->leftjoin('employee_grades','employee_jobs.emp_grade_id','=','employee_grades.id')
        ->leftjoin('sections','employee_jobs.section_id','=','sections.id')
        ->leftjoin('job_companies','employee_jobs.job_comp_id','=','job_companies.id')
        ->leftjoin('branches','employee_jobs.branch_id','=','branches.id')
        ->leftjoin('employee_job_status','employee_jobs.id','=','employee_job_status.emp_job_id')
        ->leftjoin('employment_statuses','employee_job_status.status_id','=','employment_statuses.id')
        ->join('employees', 'employees.id', 'employee_jobs.emp_id')
        ->get();
        $i=2;
        foreach($jobData as $jobDa)
        {
            $jobs->setCellValue('A'.$i,$jobDa->code)
            ->getColumnDimension('A')
            ->setAutoSize(true);
            $jobs->setCellValue('B'.$i,$jobDa->cost_centre)
            ->getColumnDimension('B')
            ->setAutoSize(true);
            $jobs->setCellValue('C'.$i,$jobDa->department)
            ->getColumnDimension('C')
            ->setAutoSize(true);
            $jobs->setCellValue('D'.$i,$jobDa->team)
            ->getColumnDimension('D')
            ->setAutoSize(true);
            $jobs->setCellValue('E'.$i,$jobDa->position)
            ->getColumnDimension('E')
            ->setAutoSize(true);
            $jobs->setCellValue('F'.$i,$jobDa->grade)
            ->getColumnDimension('F')
            ->setAutoSize(true);
            $jobs->setCellValue('G'.$i,$jobDa->section)
            ->getColumnDimension('G')
            ->setAutoSize(true);
            $jobs->setCellValue('H'.$i,$jobDa->company)
            ->getColumnDimension('H')
            ->setAutoSize(true);
            $jobs->setCellValue('I'.$i,$jobDa->branch)
            ->getColumnDimension('I')
            ->setAutoSize(true);
            $jobs->setCellValue('J'.$i,$jobDa->basic_salary)
            ->getColumnDimension('J')
            ->setAutoSize(true);
            $jobs->setCellValue('K'.$i,$jobDa->start_date)
            ->getColumnDimension('K')
            ->setAutoSize(true);
            $jobs->setCellValue('L'.$i,$jobDa->status)
            ->getColumnDimension('L')
            ->setAutoSize(true);
            $jobs->setCellValue('M'.$i,$jobDa->remarks)
            ->getColumnDimension('M')
            ->setAutoSize(true);
            $i++;
        }
    }
    
    public static function generateBankData($banks)
    {
        $bankData = DB::table('employee_bank_accounts')
        ->join('employees', 'employees.id', 'employee_bank_accounts.emp_id')
        ->select('bank_code','acc_no','employees.code')
        ->get();
        $i=2;
        foreach($bankData as $bankDa)
        {
            $banks->setCellValue('A'.$i,$bankDa->code)
            ->getColumnDimension('A')
            ->setAutoSize(true);
            $banks->setCellValue('B'.$i,$bankDa->bank_code)
            ->getColumnDimension('B')
            ->setAutoSize(true);
            $banks->setCellValue('C'.$i,$bankDa->acc_no)
            ->getColumnDimension('C')
            ->setAutoSize(true);
            $i++;
        }
    }
    
    public static function generateQualificationData($qualifications)
    {
        $qualificationData = DB::table('employee_experiences')
        ->join('employees', 'employees.id', 'employee_experiences.emp_id')
        ->select('company','position','industry','contact','start_date','end_date','notes','employees.code')
        ->get();
        $i=2;
        foreach($qualificationData as $qualificationDa)
        {
            $qualifications->setCellValue('A'.$i,$qualificationDa->code)
            ->getColumnDimension('A')
            ->setAutoSize(true);
            $qualifications->setCellValue('B'.$i,$qualificationDa->company)
            ->getColumnDimension('B')
            ->setAutoSize(true);
            $qualifications->setCellValue('C'.$i,$qualificationDa->industry)
            ->getColumnDimension('C')
            ->setAutoSize(true);
            $qualifications->setCellValue('D'.$i,$qualificationDa->contact)
            ->getColumnDimension('D')
            ->setAutoSize(true);
            $qualifications->setCellValue('E'.$i,$qualificationDa->position)
            ->getColumnDimension('E')
            ->setAutoSize(true);
            $qualifications->setCellValue('F'.$i,$qualificationDa->start_date)
            ->getColumnDimension('F')
            ->setAutoSize(true);
            $qualifications->setCellValue('G'.$i,$qualificationDa->end_date)
            ->getColumnDimension('G')
            ->setAutoSize(true);
            $qualifications->setCellValue('H'.$i,$qualificationDa->notes)
            ->getColumnDimension('H')
            ->setAutoSize(true);
            
            $i++;
        }
    }
    
    public static function generateReportToData($reportTo)
    {
        $reportToData = DB::table('employee_report_to')
        ->select('users.name','type','kpi_proposer','report_to_level','notes','payroll_period.name as payroll','code')
        ->leftjoin('employees','employee_report_to.emp_id','=','employees.id')
        ->leftjoin('users','employees.user_id','=','users.id')
        ->leftjoin('emp_report_to_pp','employee_report_to.id','=','emp_report_to_pp.emp_report_to_id')
        ->leftjoin('payroll_period','emp_report_to_pp.payroll_period_id','=','payroll_period.id')
        ->get();
        $i=2;
        foreach($reportToData as $reportToDa)
        {
            $reportTo->setCellValue('A'.$i,$reportToDa->code)
            ->getColumnDimension('A')
            ->setAutoSize(true);
            $reportTo->setCellValue('B'.$i,$reportToDa->name)
            ->getColumnDimension('B')
            ->setAutoSize(true);
            $reportTo->setCellValue('C'.$i,$reportToDa->type)
            ->getColumnDimension('C')
            ->setAutoSize(true);
            $reportTo->setCellValue('D'.$i,$reportToDa->report_to_level)
            ->getColumnDimension('D')
            ->setAutoSize(true);
            
            if($reportToDa->kpi_proposer==0){
                $reportTo->setCellValue('E'.$i,'No')->getColumnDimension('E')
                ->setAutoSize(true);
            }
            else{
                $reportTo->setCellValue('E'.$i,'Yes')->getColumnDimension('E')
                ->setAutoSize(true);
            }
            
            $reportTo->setCellValue('F'.$i,$reportToDa->payroll)
            ->getColumnDimension('F')
            ->setAutoSize(true);
            $reportTo->setCellValue('G'.$i,$reportToDa->notes)
            ->getColumnDimension('G')
            ->setAutoSize(true);
            $i++;
        }
    }
    
    public static function generateSecurityGroupData($securityGroup)
    {
        $securityGroupData = DB::table('employee_security_groups')
        ->select('security_groups.name as name','employees.code')
        ->leftjoin('security_groups','employee_security_groups.security_group_id','=','security_groups.id')
        ->join('employees', 'employees.id', 'employee_security_groups.emp_id')
        ->get();
        $i=2;
        foreach($securityGroupData as $securityGroupDa)
        {
            $securityGroup->setCellValue('A'.$i,$securityGroupDa->code)
            ->getColumnDimension('A')
            ->setAutoSize(true);
            $securityGroup->setCellValue('B'.$i,$securityGroupDa->name)
            ->getColumnDimension('B')
            ->setAutoSize(true);
            
            $i++;
        }
    }
    
    public static function profilesDataValidation($profiles, $i)
    {
        $profiles->getCell('J'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Value is not in list.')
        ->setPromptTitle('Pick from list')
        ->setPrompt('Please pick a value from the drop-down list.')
        ->setFormula1('"Female,Male"');
        
        $profiles->getCell('N'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Value is not in list.')
        ->setPromptTitle('Pick from list')
        ->setPrompt('Please pick a value from the drop-down list.')
        ->setFormula1('"Single,Married"');
        
        $profiles->getCell('M'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Value is not in list.')
        ->setPromptTitle('Pick from list')
        ->setPrompt('Please pick a value from the drop-down list.')
        ->setFormula1('country!$A:$A');
        
        $profiles->getCell('U'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Value is not in list.')
        ->setPromptTitle('Pick from list')
        ->setPrompt('Please pick a value from the drop-down list.')
        ->setFormula1('"Cash,Bank,Cheque,Withheld,Credit Note"');
        
        $profiles->getCell('V'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Value is not in list.')
        ->setPromptTitle('Pick from list')
        ->setPrompt('Please pick a value from the drop-down list.')
        ->setFormula1('"Daily,Weekly,Monthly"');
        
        $profiles->getCell('W'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Value is not in list.')
        ->setPromptTitle('Pick from list')
        ->setPrompt('Please pick a value from the drop-down list.')
        ->setFormula1('category!$A:$A');
        
        $profiles->getCell('Y'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Value is not in list.')
        ->setPromptTitle('Pick from list')
        ->setPrompt('Please pick a value from the drop-down list.')
        ->setFormula1('"Single Person,Spouse Not Working,Spouse Working"');
        
        $profiles->getCell('AA'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Value is not in list.')
        ->setPromptTitle('Pick from list')
        ->setPrompt('Please pick a value from the drop-down list.')
        ->setFormula1('"Category A,Category B,Category C,Category D,Category E"');
        
        $profiles->getCell('AD'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Value is not in list.')
        ->setPromptTitle('Pick from list')
        ->setPrompt('Please pick a value from the drop-down list.')
        ->setFormula1('"First Category,Second Category"');
        
        $profiles->getCell('AG'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Value is not in list.')
        ->setPromptTitle('Pick from list')
        ->setPrompt('Please pick a value from the drop-down list.')
        ->setFormula1('role!$A:$A');
        
        $profiles->getCell('AF'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Value is not in list.')
        ->setPromptTitle('Pick from list')
        ->setPrompt('Please pick a value from the drop-down list.')
        ->setFormula1('security!$A:$A');
        
        $profiles->getCell('K'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Invalid Format.')
        ->setPromptTitle('Format:yyyy-mm-dd')
        ->setPrompt('Example:2020-01-19');
        
        $profiles->getCell('T'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Invalid Format.')
        ->setPromptTitle('Format:yyyy-mm-dd')
        ->setPrompt('Example:2020-01-19');
        
        $profiles->getStyle('C'.$i)
        ->getNumberFormat()
        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
        
        $profiles->getStyle('I'.$i)
        ->getNumberFormat()
        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        
        $profiles->getStyle('P'.$i)
        ->getNumberFormat()
        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        
        $profiles->getStyle('AB'.$i)
        ->getNumberFormat()
        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        
        $profiles->getStyle('AC'.$i)
        ->getNumberFormat()
        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        
        $profiles->getStyle('H'.$i)
        ->getNumberFormat()
        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
        
        $profiles->getStyle('AE'.$i)
        ->getNumberFormat()
        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
        
    }
    
    public static function disciplinaryIssueDataValidation($disciplines, $i)
    {
        $disciplines->getCell('B'.$i)->getDataValidation()
        ->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE )
        ->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION )
        ->setAllowBlank(false)
        ->setShowInputMessage(true)
        ->setShowErrorMessage(true)
        ->setShowDropDown(true)
        ->setErrorTitle('Input error')
        ->setError('Invalid Format.')
        ->setPromptTitle('Format:yyyy-mm-dd')
        ->setPrompt('Example:2020-01-19');
    }
    
}

