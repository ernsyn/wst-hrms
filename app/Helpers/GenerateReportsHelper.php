<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/15/18
 * Time: 5:53 PM
 */

namespace App\Helpers;

use App\Http\Controllers\Popo\governmentreport\GovernmentReport;
use App\Http\Controllers\Popo\governmentreport\LhdnBorangEBean;
use App\Http\Controllers\Popo\governmentreport\LhdnCP8EmployeeDetail;
use App\Company;
use App\Employee;

class GenerateReportsHelper
{

    public static function generateBean($reportName,$option){
        switch ($reportName) {
            case "LHDN_borangE":

                //query from table company
                $company = Company::where('status', 1)->first();
                $totalEmployee = Employee::count();

                //set popo
                $data = new LhdnBorangEBean([
                    'employerName' => !empty($company) ? $company->name : '',
                    'employerNoE' => !empty($company) ? $company->code : '',
                    'businessStatus' => 1,
                    'ssmNo' => !empty($company) ? $company->registration_no : '',
                    'address1' => 'LEVEL 15, TOWER 1, PJ 33,',
                    'address2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                    'address3' => 'SELANGOR.',
                    'postcode' => 46200,
                    'telNo' => !empty($company) ? $company->phone : '',
                    'email' => 'oppo.amandachong@gmail.com',
                    'totalEmployee' => !empty($totalEmployee) ? $totalEmployee : '',
                    'totalEmployeeWithPCB' => 7,
                    'totalNewEmployee' => 9,
                    'totalEmployeeResigned' => 15,
                    'totalEmployeeResignedLeaveMalaysia' => 1,
                    'reportLHDNM' => 1,
                    'officerName' => 'CHONG HWEE MIN',
                    'officerIC' => '861819891291',
                    'officerPosition' => 'HUMAN RESOURCES OFFICER'
                ]);

                $data1 = array();
                //example
                for($count=0;$count < 55; $count++){
                    $emp = new LhdnCP8EmployeeDetail();
                    $emp->setIncomeTaxNo("JAZLI AMIRUL BIN RAMLI");
                    $emp->setIcNo("981101121221");
                    $emp->setEmployeeCategory(1);
                    $emp->setTaxPayByEmployer("Tidak");
                    $emp->setTotalChildren(0);
                    $emp->setAmountOfDeparture(0.00);
                    $emp->setTotalGrossRemuneration(16951.54);
                    $emp->setBenefitsOfGoods(0.00);
                    $emp->setValuePlaceOfResidence(0.00);
                    $emp->setBenefitsOfESOS(0.00);
                    $emp->setTaxExemptPerquisites(0.00);
                    $emp->setTP1Departure(0.00);
                    $emp->setTP1Zakat(0.00);
                    $emp->setEmployeeEPFContributions(1631.00);
                    $emp->setZakatDeductions(0.00);
                    $emp->setTaxDeductionOfPCB(143.60);
                    $emp->setTaxDeductionOfCP38(0.00);
                    $data1[] = $emp;
                }
                $arr = array("data"=>$data, "data1"=>$data1);
                return $arr;
                break;
            case "LHDN_cp21":
                echo "portrait";
                break;
            case "LHDN_cp22":
                echo "portrait";
                break;
            case "LHDN_cp22a":
                echo "portrait";
                break;
            case "LHDN_cp22b":
                echo "portrait";
                break;
            case "LHDN_cp39":
                echo "portrait";
                break;
            case "LHDN_cp39lieu":
                echo "portrait";
                break;
            case "LHDN_eaform":
                echo "portrait";
                break;
            default:
                echo "None";
        }
    }

}
