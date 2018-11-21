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
use App\Http\Controllers\Popo\governmentreport\LhdnCP21Bean;
use App\Http\Controllers\Popo\governmentreport\LhdnCP22Bean;
use App\Http\Controllers\Popo\governmentreport\LhdnCP22aBean;
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
/*                    'employerName' => !empty($company) ? $company->name : '',
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
                    'officerPosition' => 'HUMAN RESOURCES OFFICER'*/
                    'employerName' => 'OPPO ELECTRONICS SDN BHD',
                    'employerNoE' => 'E9119707907',
                    'employerStatus' => 2,
                    'businessStatus' => 1,
                    'incomeTaxNo' => 'SG10234567090',
                    'icNo' => 'B3200090304M',
                    'passportNo' => 'A320000304',
                    'ssmNo' => 'B32000304M',
                    'address1' => 'LEVEL 15, TOWER 1, PJ 33,',
                    'address2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                    'address3' => 'SELANGOR.',
                    'postcode' => 46200,
                    'telNo' => '03-7931 3550',
                    'mobileNo' => '013-7931 3550',
                    'email' => 'oppo.amandachong@gmail.com',
                    'CP8D' => 1,
                    'totalEmployee' => 9,
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
                    //set pojo
                    $data = array();
                    for($count=0;$count < 5; $count++) {
                        $obj = new LhdnCP21Bean([
                            'employerName' => 'OPPO ELECTRONICS SDN BHD',
                            'employerNoE' => 'E9119707907',
                            'employerAddress1' => 'LEVEL 15, TOWER 1, PJ 33,',
                            'employerAddress2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                            'employerAddress3' => 'SELANGOR.',
                            'employerPostcode' => 46200,
                            'employerNoTel' => '03-19220112',
                            'name_A' => 'Shahril Abu Bakar',
                            'dateOfCommencement_A' => '190993',
                            'address1_A' => 'No 7 ,Simpang Empat',
                            'address2_A' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                            'address3_A' => 'SELANGOR.',
                            'postcode_A' => 46200,
                            'expectedDatetoLeaveMalaysia_A' => '',
                            'xAddressBelongsToTaxAgent_A' => '',
                            'ic_A' => '860110781723',
                            'incomeTaxNo_A' => 'OG12345678910',
                            'reasonLeaveMalaysia_A' => 'hueheue hueue ehuehue',
                            'citizenship_A' => 'Malaysian',
                            'dateOfBirth_A' => '010412',
                            'placeOfBirth_A' => 'Kuala Lumpur',
                            'addressOutMalaysia1_A' => 'No 7 ,Simpang Empat',
                            'addressOutMalaysia2_A' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                            'addressOutMalaysia3_A' => 'SELANGOR.',
                            'postcodeOutMalaysia_A' => 46200,
                            'natureOfEmployment_A' => 'CONCEPT STORE SALES REPRESENTATIVE',
                            'telno_A' => '03-19220112',
                            'stateProbableDateofReturn_A' => '01/05/2017',

                            'salaryFrom_B' => '01/01/2018',
                            'salaryUntil_B' => '01/04/1212',
                            'salaryAmount_B' => 9774.19,
                            'leavePayFrom_B' => '01/01/2018',
                            'leavePayUntil_B' => '01/04/1212',
                            'leavePayAmount_B' => 74.19,
                            'commissionFrom_B' => '01/01/2018',
                            'commissionUntil_B' => '01/04/1212',
                            'commissionAmount_B' => 4.19,
                            'gratuityFrom_B' => '01/01/2018',
                            'gratuityUntil_B' => '01/04/1212',
                            'gratuityAmount_B' => 74.19,
                            'compensationFrom_B' => '01/01/2018',
                            'compensationUntil_B' => '01/04/1212',
                            'compensationAmount_B' => 4.19,
                            'cashAllowanceFrom_B' => '01/01/2018',
                            'cashAllowanceUntil_B' => '01/04/1212',
                            'cashAllowanceAmount_B' => 74.19,
                            'pensionFrom_B' => '01/01/2018',
                            'pensionUntil_B' => '01/04/1212',
                            'pensionAmount_B' => 4.19,
                            'benefitSubjectToTaxFrom_B' => '01/01/2018',
                            'benefitSubjectToTaxUntil_B' => '01/04/1212',
                            'benefitSubjectToTaxAmount_B' => 74.19,
                            'livingAccommodationFrom_B' => '01/01/2018',
                            'livingAccommodationUntil_B' => '01/04/1212',
                            'livingAccommodationAmount_B' => 4.19,
                            'otherAllowanceFrom_B' => '01/01/2018',
                            'otherAllowanceUntil_B' => '01/04/1212',
                            'otherAllowanceAmount_B' => 74.19,
                            'otherPaymentsFrom_B' => '01/01/2018',
                            'otherPaymentsUntil_B' => '01/04/1212',
                            'otherPaymentsAmount_B' => 4.19,
                            'total_B' => 0,

                            'typeOfIncome1_C' => 'Online Business',
                            'typeOfIncome2_C' => 'Online Business',
                            'typeOfIncome3_C' => 'Online Business',
                            'yearForWhichPaid1_C' => '01/01/2018',
                            'yearForWhichPaid2_C' => '01/04/1212',
                            'yearForWhichPaid3_C' => '01/04/1212',
                            'totalIncome1_C' => 74.19,
                            'totalIncome2_C' => 74.19,
                            'totalIncome3_C' => 74.19,
                            'pensionFund1_C' => 4.19,
                            'pensionFund2_C' => 4.19,
                            'pensionFund3_C' => 4.19,

                            'moneyWithheldByEmployer_D' => 74.19,
                            'monthlyTaxDeductions_D' => 1501.00,
                            'amountOfZakatPaid_D' => 74.19,
                            'contributionsToEmployeeProvidentFund_D' => 1501.00,

                            'officerName_E' => 'CHONG HWEE MIN',
                            'officerDesignation_E' => 'HUMAN RESOURCES OFFICER',
                            'officerSignature_E' => '',
                            'date_E' => '011018'

                        ]);
                        $data[] = $obj;
                    }
                    $arr = array("data"=>$data);
                    return $arr;
                break;

            case "LHDN_cp22":
                //set pojo
                $data = array();
                for($count=0;$count < 5; $count++) {
                    $obj = new LhdnCP22Bean([
                        'companyName' => 'OPPO ELECTRONICS SDN BHD',
                        'companyNoE' => 'E9119707907',
                        'companyNoTel' => '03-19220112',
                        'addressTo1' => 'LEVEL 15, TOWER 1, PJ 33,',
                        'addressTo2' => 'JALAN SEMANGAT, PETALING JAYA,',
                        'addressTo3' => 'SELANGOR.',
                        'postcodeTo' => 46200,
                        'addressFrom1' => 'LEVEL 15, TOWER 1, PJ 33,',
                        'addressFrom2' => 'JALAN SEMANGAT, PETALING JAYA,',
                        'addressFrom3' => 'SELANGOR.',
                        'postcodeFrom' => 46200,

                        'name_A' => 'Shahril Abu Bakar',
                        'incomeTaxNo_A' => 'A565655',
                        'jobRole_A' => 'CONCEPT STORE SALES REPRESENTATIVE',
                        'noIc_A' => '876756543213',
                        'employmentStartDate_A' => '05/03/2018',
                        'employmentExpectedDate_A' => '05/03/2018',
                        'immigrationNo_A' => '131233132H',
                        'address1_A' => 'No 7 ,Simpang Empat',
                        'address2_A' => 'JALAN SEMANGAT, PETALING JAYA,',
                        'address3_A' => 'SELANGOR.',
                        'postcode_A' => 46200,
                        'birthDate_A' => '190993',
                        'maritalStatus_A' => 'SINGLE',
                        'childrenUnder18No_A' => '2',
                        'addressNow1_A' => 'No 7 ,Simpang Empat',
                        'addressNow2_A' => 'JALAN SEMANGAT, PETALING JAYA,',
                        'addressNow3_A' => 'SELANGOR.',
                        'postcodeNow_A' => '676177',
                        'incomeTaxNo_A' => 'OG12345678910',
                        'signX_A' => '',
                        'spouseName_A' => 'SUZANNAH IBRAHIM',
                        'spouseIC_A' => '871898176765',
                        'spouseIncomeTax_A' => 'OG12345678910',

                        'fixedMontlyRemunerationRate_B' => 565.00,
                        'rateCashAllowance_B' => 'Huehuehue',
                        'emolumentNotFixed_B' => '',
                        'employerName_B' => 'JOSE WENGER',
                        'employerAddress1_B' => 'No 7 ,Simpang Empat',
                        'employerAddress2_B' => 'JALAN SEMANGAT, PETALING JAYA,',
                        'employerAddress3_B' => 'SELANGOR.',

                        'officerSignature_C' => '',
                        'officerName_C' => 'CHONG HWEE MIN',
                        'officerRole_C' => 'HUMAN RESOURCES OFFICER',
                        'date_C' => '01/10/2018'
                    ]);
                    $data[] = $obj;
                }
                $arr = array("data"=>$data);
                return $arr;
                break;

            case "LHDN_cp22a":
                //set pojo
                $data = array();
                for($count=0;$count < 5; $count++) {
                    $obj = new LhdnCP22aBean([
                        'employerName' => 'OPPO ELECTRONICS SDN BHD',
                        'employerNoE' => 'E9119707907',
                        'employerAddress1' => 'LEVEL 15, TOWER 1, PJ 33,',
                        'employerAddress2' => 'JALAN SEMANGAT, PETALING JAYA,',
                        'employerAddress3' => 'SELANGOR.',
                        'employerPostcode' => 46200,
                        'employerNoTel' => '03-19220112',

                        'name_A' => 'Shahril Abu Bakar',
                        'telNo_A' => '0345674734',
                        'commencementDate_A' => '190993',
                        'address1_A' => 'No 7 ,Simpang Empat',
                        'address2_A' => 'JALAN SEMANGAT, PETALING JAYA,',
                        'address3_A' => 'SELANGOR.',
                        'postcode_A' => 46200,
                        'resignDate_A' => '190993',
                        'birthDate_A' => '190993',
                        'resignType_A' => 'X',
                        'signX' => '',
                        'icNo_A' => '860110781723',
                        'legalRepresentativeName_A' => 'SHAHRIL ABU BAKAR',
                        'legalRepresentativeIc_A' => '871898176765',
                        'legalRepresentativeAddress1_A' => 'No 7 ,Simpang Empat',
                        'legalRepresentativeAddress2_A' => 'JALAN SEMANGAT, PETALING JAYA,',
                        'legalRepresentativeAddress3_A' => 'SELANGOR.',
                        'legalRepresentativeNoTel_A' => '0345467453',
                        'incomeTaxNo_A' => 'OG12345678910',
                        'marriedStatus_A' => 'SINGLE',
                        'childrenNo_A' => '01',
                        'totalIncomeTaxChild_A' => '12300',
                        'spouseName_A' => 'SUZANNAH IBRAHIM',
                        'spouseIc_A' => '871898176765',
                        'spouseIncomeTax_A' => 'OG12345678910',

                        'salaryFrom_B' => '01/01/2018',
                        'salaryUntil_B' => '01/04/1212',
                        'salaryAmount_B' => 9774.19,
                        'leavePayFrom_B' => '01/01/2018',
                        'leavePayUntil_B' => '01/04/1212',
                        'leavePayAmount_B' => 74.19,
                        'commissionFrom_B' => '01/01/2018',
                        'commissionUntil_B' => '01/04/1212',
                        'commissionAmount_B' => 4.19,
                        'gratuityFrom_B' => '01/01/2018',
                        'gratuityUntil_B' => '01/04/1212',
                        'gratuityAmount_B' => 74.19,
                        'compensationFrom_B' => '01/01/2018',
                        'compensationUntil_B' => '01/04/1212',
                        'compensationAmount_B' => 4.19,
                        'cashAllowanceFrom_B' => '01/01/2018',
                        'cashAllowanceUntil_B' => '01/04/1212',
                        'cashAllowanceAmount_B' => 74.19,
                        'pensionFrom_B' => '01/01/2018',
                        'pensionUntil_B' => '01/04/1212',
                        'pensionAmount_B' => 4.19,
                        'benefitSubjectToTaxFrom_B' => '01/01/2018',
                        'benefitSubjectToTaxUntil_B' => '01/04/1212',
                        'benefitSubjectToTaxAmount_B' => 74.19,
                        'transportFrom_B' => '01/01/2018',
                        'transportUntil_B' => '01/04/1212',
                        'transportAmount_B' => 4.29,
                        'otherAllowanceFrom_B' => '01/01/2018',
                        'otherAllowanceUntil_B' => '01/04/1212',
                        'otherAllowanceAmount_B' => 74.19,
                        'otherPaymentsFrom_B' => '01/01/2018',
                        'otherPaymentsUntil_B' => '01/04/1212',
                        'otherPaymentsAmount_B' => 4.19,
                        'dateOptionGranted_B' => '010118',
                        'dateExistingOptionCanExecuted_B' => '010118',
                        'dateOptionExecuted_B' => '010118',
                        'totalBenefit' => 12.00,
                        'total_B' => 0,

                        'typeOfIncome1_C' => 'Online Business',
                        'typeOfIncome2_C' => 'Online Business',
                        'typeOfIncome3_C' => 'Online Business',
                        'yearForWhichPaid1_C' => '01/01/2018',
                        'yearForWhichPaid2_C' => '01/04/1212',
                        'yearForWhichPaid3_C' => '01/04/1212',
                        'totalIncome1_C' => 74.19,
                        'totalIncome2_C' => 74.19,
                        'totalIncome3_C' => 74.19,
                        'pensionFund1_C' => 4.19,
                        'pensionFund2_C' => 4.19,
                        'pensionFund3_C' => 4.19,

                        'moneyWithheldByEmployer_D' => 74.19,
                        'monthlyTaxDeductions_D' => 1501.00,
                        'amountOfZakatPaid_D' => 74.19,
                        'contributionsToEmployeeProvidentFund_D' => 1501.00,

                        'officerName_E' => 'CHONG HWEE MIN',
                        'officerDesignation_E' => 'HUMAN RESOURCES OFFICER',
                        'officerSignature_E' => '',
                        'date_E' => '011018'

                    ]);
                    $data[] = $obj;
                }
                $arr = array("data"=>$data);
                return $arr;
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
