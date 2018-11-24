<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/15/18
 * Time: 5:53 PM
 */

namespace App\Helpers;

use App\Branch;
use App\CostCentre;
use App\Department;
use App\EmployeePosition;
use App\Http\Controllers\Popo\governmentreport\GovernmentReport;
use App\Http\Controllers\Popo\governmentreport\LhdnBorangEBean;
use App\Http\Controllers\Popo\governmentreport\LhdnCP8EmployeeDetail;
use App\Http\Controllers\Popo\governmentreport\LhdnCP21Bean;
use App\Http\Controllers\Popo\governmentreport\LhdnCP22Bean;
use App\Http\Controllers\Popo\governmentreport\LhdnCP22aBean;
use App\Http\Controllers\Popo\governmentreport\LhdnCP22bBean;
use App\Http\Controllers\Popo\governmentreport\LhdnCP39Bean;
use App\Http\Controllers\Popo\governmentreport\LhdnCP39LieuBean;
use App\Http\Controllers\Popo\governmentreport\LhdnEAFormBean;
use App\Http\Controllers\Popo\governmentreport\TabungHajiCarumanBean;
use App\Http\Controllers\Popo\governmentreport\EpfBBCDBean;
use App\Http\Controllers\Popo\governmentreport\EpfBorangABean;
use App\Http\Controllers\Popo\governmentreport\SoscoLampiranABean;

use App\PayrollMaster;
use App\User;
use App\Company;
use App\Employee;
use Illuminate\Support\Facades\Auth;
use \DB;
use \Carbon;

class GenerateReportsHelper
{

    public static function generateBean($reportName,$filter){
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
                //foreach (self::getYearlyGrossPay() as )

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
                //set pojo
                $data = array();
                for($count=0;$count < 5; $count++) {
                    $obj = new LhdnCP22bBean([
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

            case "LHDN_cp39":
                //set popo
                $data = new LhdnCP39Bean([
                    'companyName' => 'OPPO ELECTRONICS SDN BHD',
                    'companyRegistrationNo' => '1075187-D',
                    'companyAddress1' => 'LEVEL 15, TOWER 1, PJ 33,',
                    'companyAddress2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                    'companyAddress3' => 'SELANGOR.',
                    'companyPostcode' => 46200,

                    'employerNoE' => 'E9119707907',
                    'pcbTotalCut' => 4581.65,
                    'pcbTotalWorker' => 23,
                    'pcbTotalAmount' => 4581.65,
                    'pcbBranchNo' => '',
                    'cp38TotalCut' => '',
                    'cp38TotalWorker' => 0,

                    'officerSignature' => '',
                    'officerName' => 'CHONG HWEE MIN',
                    'officerIcNo' => '891787654321',
                    'officerPosition' => 'HUMAN RESOURCES OFFICER',
                    'officerNoTel' => '03-7931 3550'
                ]);

                $empData = array();
                $totalPcb = 0;
                $totalcp38 = 0;
                $totalAmountofPCBAndCP8 = 0;

                //example
                for($count=0;$count < 55; $count++){
                    $emp = new LhdnCP39Bean([
                        'incomeTaxNo' => 'SG67676776767',
                        'name' => 'MUHAMMAD SHAHRIL B. ABU BAKAR',
                        'oldIcNo' => '',
                        'newIcNo' => '881876876767',
                        'staffNo' => '12473',
                        'foreignerPassportNo' => '',
                        'foreignerCountry' => '',
                        'pcbAmount' => 163.80,
                        'cp38Amount' => 0
                    ]);
                    //sum of pcb/cp8
                    $totalPcb += $emp->getPcbAmount();
                    $totalcp38 += $emp->getCp38Amount();

                    //sum of total pcb/cp8
                    $totalAmountofPCBAndCP8 = ($totalPcb + $totalcp38);

                    $empData[] = $emp;
                }

                $arr = array(
                    "data"=>$data,
                    "empData"=>$empData,
                    "totalPcb"=>$totalPcb,
                    "totalcp38"=>$totalcp38,
                    "totalAmountofPCBAndCP8"=>$totalAmountofPCBAndCP8
                );
                return $arr;
            break;

            case "LHDN_cp39lieu":
                //set pojo
                $data = array();

                for($count=0;$count < 1; $count++) {
                    $obj = new LhdnCP39LieuBean([
                        'employerName' => 'OPPO ELECTRONICS SDN BHD',
                        'employerNoE' => 'E9119707907',
                        'name' => 'SHAHRIL ABU BAKAR',
                        'salaryNo' => 13113,
                        'icOldNo' => '18281A811',
                        'icNewNo' => '781819117867',
                        'referenceTaxRevenueNo' => 'A320000304',
                        'marriageStatus' => 'MARRIED',
                        'marriageDate' => '19/09/1993',
                        'gender' => 'MALE',
                        'pcbMadeYears' => '1922',
                        'workStartedDate' => '01/05/2017',
                        'monthlySalary' => 'RM 1,500.00',
                        'address1' => 'No 7 ,Simpang Empat',
                        'address2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                        'address3' => 'SELANGOR.',
                        'postcode' => 46200,
                        'foreignerBirthDate' => '01/05/2017',
                        'foreignerPassportNo' => '71817111A',
                        'spouseName' => 'KIMBERLY SWAZER',
                        'spouseIcOldNo' => '78711818918',
                        'spouseIcNewNo' => '931212818119',
                        'spouseReferenceTaxRevenueNo' => '8171811',
                        'foreignerSpouseBirthDate' => '01/04/1212',
                        'foreignerSpousePassportNo' => '1212221'
                    ]);
                    $data[] = $obj;
                }
                $arr = array("data"=>$data);
                return $arr;
            break;

            case "LHDN_eaform":
                //set pojo
                $data = array();
                for($count=0;$count < 5; $count++) {
                    $obj = new LhdnEAFormBean([
                        'serialNo' => 'A000755',
                        'incomeTaxNo' => 'OG12345678910',
                        'employerNoE' => 'E9119707907',
                        'lhdnmBranch' => 'PORT KLANG',
                        'name' => 'SHAHRIL ABU BAKAR',
                        'jobPosition' => 'SOFTWARE ENGINEER',
                        'salaryNo' => 4003,
                        'icNo' => '891723181212',
                        'passportNo' => 'M81292123',
                        'kwspNo' => 'P91819111',
                        'perkesoNo' => '919191',
                        'childNoforTax' => 3,
                        'startDateLessOneYear' => '20/01/1997',
                        'endDateLessOneYear' => '20/01/1997',
                        'netSalary' => 5000,
                        'commission' => 20000,
                        'tip' => 1200,
                        'employerIncomeTax' => 1200,
                        'esos' => 34,
                        'reward' => 1000,
                        'benefitsOfMerchandise' => 1200,
                        'residenceValue' => 1200000,
                        'failedRefund' => 340,
                        'lostJobReparation' => 340,

                        'pension' => 12000,
                        'annuity' => 1000,
                        'total' => 40000,

                        'pcb' => 340,
                        'deductionsInstructionsCP38' => 340,
                        'zakatPaidThroughSalaryDeductions' => 12000,
                        'tp1Release' => 1000,
                        'tp1Zakat' => 40000,
                        'totalDisbursementForEligibleChildren' => 40000,

                        'nameOfFund' => 'KUMPULAN SIMPANAN WANG MALAYSIA',
                        'amountOfContribution' => 340,
                        'amountOfContributionPerkeso' => 12000,
                        'totalAllowance' => 1000,

                        'date' => '05/03/2018',
                        'officerName' => 'CHONG HWEE MIN',
                        'officerPosition' => 'HUMAN RESOURCES OFFICER',
                        'companyName' => 'OPPO ELECTRONICS SDN BHD',
                        'companyAddress1' => 'No 7 ,Simpang Empat',
                        'companyAddress2' => 'JALAN SEMANGAT, PETALING JAYA,',
                        'companyAddress3' => 'SELANGOR.',
                        'companyPostcode' => 46200,
                        'companyNoTel' => '03454332133'
                    ]);
                    $data[] = $obj;
                }
                $arr = array("data"=>$data);
                return $arr;
            break;

            case "Tabung_Haji_caruman":
                //set popo
                $data = new TabungHajiCarumanBean([
                    'companyName' => 'OPPO ELECTRONICS SDN BHD',
                    'employerCode' => 'AX2019211',
                    'address1' => 'LEVEL 15, TOWER 1, PJ 33,',
                    'address2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                    'address3' => 'SELANGOR.',
                    'postcode' => 46200,
                ]);

                $empData = array();
                //example
                for($count=0;$count < 55; $count++){
                    $emp = new TabungHajiCarumanBean([
                        'employeeNoAccount' => 'E9119707907',
                        'employeeNo' => 'A5645',
                        'employeeIcNo' => '876756453421',
                        'employeeName' => 'Shahril Abu Bakar',
                        'employeeContribution' => 234.89,
                    ]);
                    $empData[] = $emp;
                }
                $arr = array("data"=>$data, "empData"=>$empData);
                return $arr;
            break;

            case "Tabung_Haji_df":
                break;

            case "EPF_bbcd":
                //set popo
                $data = new EpfBBCDBean([
                    'employerReferenceNo' => '018884828',
                    'contributionAmount' => 5902.00,

                    'paymentCheck' => 'X',

                    'companyName' => 'OPPO ELECTRONICS SDN  BHD',
                    'companyRegistrationNo' => '1075187-D',
                    'companyAddress1' => 'LEVEL 15, TOWER 1, PJ 33,',
                    'companyAddress2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                    'companyAddress3' => 'SELANGOR.',
                    'companyPostcode' => 46200,

                    'officerName' => 'CHONG HWEE MIN',
                    'officerICNo' => '931027-14-6428',
                    'officerPosition' => 'HUMAN RESOURCES OFFICER',
                    'officerTelNo' => '03-7931 3550',
                ]);
                $arr = array("data"=>$data);
                return $arr;
            break;

            case "EPF_borangA":
                //set popo
                $data = new EpfBorangABean([
                    'employerReferenceNo' => '018884828',
                    'contributionAmount' => 4356.78,
                    'referenceNo' => '1234',
                    'paymentCheck' => 'X',

                    'companyName' => 'OPPO ELECTRONICS SDN BHD',
                    'companyRegNo' => '1075187-D',
                    'companyAddress1' => 'LEVEL 15, TOWER 1, PJ 33,',
                    'companyAddress2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                    'companyAddress3' => 'SELANGOR.',
                    'companyPostcode' => 46200,
                    'employeeTotal' => 204,

                    'officerName' => 'CHONG HWEE MIN',
                    'officerIC' => '	897865765645',
                    'officerPosition' => 'HUMAN RESOURCES OFFICER',
                    'officerTelNo' => '03-7931 3550',
                    'officerEmail' => 'oppo.amandachong@gmail.com',
                ]);

                $empData = array();
                $totalEmployerContribution = 0;
                $totalEmployeeContribution = 0;
                $totalOverallContributionEmp = 0;

                //example
                for($count=0;$count < 55; $count++){
                    $emp = new EpfBorangABean([
                        'employeeKwspNo' => 220610,
                        'employeeIcNo' => '881876876767',
                        'employeeName' => 'MUHAMMAD SHAHRIL B. ABU BAKAR',
                        'employeeWages' => 2631.31,
                        'employerContribution' => 344,
                        'employeeContribution' => 291
                    ]);
                    //sum of contribution
                    $totalEmployerContribution += $emp->getEmployerContribution();
                    $totalEmployeeContribution += $emp->getEmployeeContribution();

                    //sum of total contribution
                    $totalOverallContributionEmp = ($totalEmployerContribution + $totalEmployeeContribution);

                    $empData[] = $emp;
                }
                $arr = array("data"=>$data, "empData"=>$empData, "totalOverallContributionEmp"=>$totalOverallContributionEmp);
                return $arr;
            break;

            case "SOSCO_lampiranA":
                //set popo
                $data = new SoscoLampiranABean([
                    'fromMonth' => 'Ogos',
                    'toMonth' => 'Ogos',
                    'employeeTotalNumber' => '15',
                    'noCheck' => '888888888888888888',
                    'amount' => 576.30,
                    'employerCode' => 'B3200090304M',
                    'companyName' => 'OPPO ELECTRONICS SDN BHD',
                    'companyRegistrationNo' => '1075187-D',
                    'address1' => 'LEVEL 15, TOWER 1, PJ 33,',
                    'address2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                    'address3' => 'SELANGOR.',
                    'postcode' => 46200,
                    'officerName' => 'CHONG HWEE MIN',
                    'officerTelNo' => '03-7931 3550'
                ]);
                $arr = array("data"=>$data);
                return $arr;
            break;

            case "LHDN_eaform":
                break;

            case "LHDN_eaform":
                break;

            case "test":
                $company = self::getCompanyInfomation(null);
                //echo $company['name'];
                //$filter(""=>"")
                $list = self::getLHDNYearlyReport($company['id'],$filter);
                self::getOfficer();

                $company = self::getUserLogonCompanyInfomation();
                self::getUserInfomationAndPayrollYearly($company->id,$filter);
                //$user->compan
/*                foreach ($list as $emp){
                    echo $emp->name;
                }*/
                break;

            default:
                echo "None";
        }
    }


    private static function getUserLogonCompanyInfomation(){
        $id = Auth::id();
        return User::find($id)->employee->company->where('status', 'Active')->first();
    }

    private static function getCompanyInfomation($companyId){
        if(empty($companyId)){
            $id = Auth::id();
            //echo $id;
            return User::find($id)->employee->company->where('status', 'Active')->first();
        }else{
            return Company::find($companyId)->where('status', 'Active')->first();
        }
    }

    private static function getLHDNYearlyReport($companyId,$filter){
        if(!empty($filter)) {
           return  DB::table('payroll_master')
                ->select(DB::raw('users.name,employees.tax_no,employees.ic_no,max(employees.total_children) as total_children'),
                    DB::raw('sum(payroll_trx.gross_pay) as total_gross_salary ,sum(payroll_trx.basic_salary) as total_basic_salary'),
                    DB::raw('sum(payroll_trx.employee_epf) as total_epf,sum(payroll_trx.employee_eis) as total_eis'),
                    DB::raw('sum(payroll_trx.employee_socso) as total_socso,sum(payroll_trx.employee_pcb) as total_pcb'))
                ->whereYear('payroll_master.year_month', date('Y'))
                ->where('payroll_master.company_id', $companyId)
                ->join('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
                ->join('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
                ->join('employees','payroll_trx.employee_id','employees.id')
                ->join('users','employees.user_id','users.id')
                ->where(array_keys($filter)[0],array_values($filter)[0])
                ->groupBy(DB::raw("payroll_trx.employee_id,users.name,employees.tax_no,employees.ic_no"))
                ->get();
        }else{
            return DB::table('payroll_master')
                ->select(DB::raw('users.name,employees.tax_no,employees.ic_no,max(employees.total_children) as total_children'),
                    DB::raw('sum(payroll_trx.gross_pay) as total_gross_salary ,sum(payroll_trx.basic_salary) as total_basic_salary'),
                    DB::raw('sum(payroll_trx.employee_epf) as total_epf,sum(payroll_trx.employee_eis) as total_eis'),
                    DB::raw('sum(payroll_trx.employee_socso) as total_socso,sum(payroll_trx.employee_pcb) as total_pcb'))
                ->whereYear('payroll_master.year_month', date('Y'))
                ->where('payroll_master.company_id', $companyId)
                ->join('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
                ->join('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
                ->join('employees','payroll_trx.employee_id','employees.id')
                ->join('users','employees.user_id','users.id')
                ->groupBy(DB::raw("payroll_trx.employee_id,users.name,employees.tax_no,employees.ic_no"))
                ->get();
        }
    }

    public static function getFilterKey($filter,$value){
        if(!empty($filter)){
            if($filter == 'costcentres'){
                return $arr = array("cost_centre_id"=>$value);
            }else if($filter == 'departments'){
                return $arr = array("department_id"=>$value);
            }else if($filter == 'branches'){
                return $arr = array("branch_id"=>$value);
            }else if($filter == 'positions'){
                return $arr = array("emp_mainposition_id"=>$value);
            }else{
                return null;
            }
        }
    }


    /**
     * auto generate for government report dropdown menu (filter)
     */
    public static function getCostCentre(){
        return CostCentre::get();
    }

    public static function getDepartments(){
        return Department::get();
    }

    public static function getBranches(){
        return Branch::get();
    }

    public static function getPosition(){
        return EmployeePosition::get();
    }

    public static function getOfficer(){
/*        select users.id,users.name from model_has_roles
        inner join `roles` on `model_has_roles`.`role_id` = `roles`.`id`
        inner join `users` on `model_has_roles`.`model_id` = `users`.`id`
        inner join `employees` on `users`.`id` = `employees`.`user_id`
        where roles.name='hr-exec' and users.status='Active';*/

        return DB::table('model_has_roles')
            ->select(DB::raw('users.id,users.name'))
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('users', 'model_has_roles.model_id', '=', 'users.id')
            ->join('employees','users.id','employees.user_id')
            ->where('roles.name','hr-exec')
            ->where('users.status','Active')
            ->get();

    }

    public static function getUserInfomationAndPayrollYearly($companyId,$filter){
/*        select employees.id,users.name, employees.contact_no, employees.address, employees.dob, employees.gender, employees.race,
        countries.citizenship, employees.marital_status, employees.total_children, employees.ic_no, employees.tax_no,
        employees.epf_no, employees.socso_no, employees.insurance_no, employees.pcb_group, employees.driver_license_no,
        employees.driver_license_expiry_date, employees.confirmed_date, users.email, employee_positions.name as position,
        employee_jobs.start_date as job_start_date, employee_jobs.end_date as job_end_date,
        max(employees.total_children) as total_children,

        sum(payroll_trx.gross_pay) as total_gross_salary ,sum(payroll_trx.basic_salary) as total_basic_salary,
        sum(payroll_trx.employee_epf) as total_epf,sum(payroll_trx.employee_eis) as total_eis,
        sum(payroll_trx.employee_socso) as total_socso,sum(payroll_trx.employee_pcb) as total_pcb,
        min(payroll_master.start_date) as remuneration_start_date , max(payroll_master.end_date) as remuneration_end_date

        from `payroll_master`
        inner join `payroll_trx` on `payroll_master`.`id` = `payroll_trx`.`payroll_master_id`
        inner join `employee_jobs` on `payroll_trx`.`employee_id` = `employee_jobs`.`emp_id`
        inner join `employees` on `payroll_trx`.`employee_id` = `employees`.`id`
        inner join `countries` on `employees`.`nationality` = `countries`.`id`
        inner join `users` on `employees`.`user_id` = `users`.`id`
        inner join `employee_positions` on `employee_jobs`.`emp_mainposition_id` = `employee_positions`.`id`
        where `users`.`status` = 'Active' and  year(`year_month`) = 2018 and `payroll_master`.`company_id` = 1
        group by (employee_id);*/
        if(!empty($filter)) {
            echo DB::table('payroll_master')
                ->select(
                    DB::raw('employees.id,users.name, employees.contact_no, employees.address, employees.dob, employees.gender, employees.race'),
                    DB::raw('countries.citizenship, employees.marital_status, employees.total_children, employees.ic_no, employees.tax_no'),
                    DB::raw('employees.epf_no, employees.socso_no, employees.insurance_no, employees.pcb_group, employees.driver_license_no'),
                    DB::raw('employees.driver_license_expiry_date, employees.confirmed_date, users.email, employee_positions.name as position'),
                    DB::raw('employee_jobs.start_date as job_start_date, employee_jobs.end_date as job_end_date'),
                    DB::raw('max(employees.total_children) as total_children'),

                    DB::raw('sum(payroll_trx.gross_pay) as total_gross_salary ,sum(payroll_trx.basic_salary) as total_basic_salary'),
                    DB::raw('sum(payroll_trx.employee_epf) as total_epf,sum(payroll_trx.employee_eis) as total_eis'),
                    DB::raw('sum(payroll_trx.employee_socso) as total_socso,sum(payroll_trx.employee_pcb) as total_pcb'),
                    DB::raw('min(payroll_master.start_date) as remuneration_start_date , max(payroll_master.end_date) as remuneration_end_date')
                )
                ->join('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
                ->join('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
                ->join('employees', 'payroll_trx.employee_id', 'employees.id')
                ->join('countries', 'employees.nationality', 'countries.id')
                ->join('employee_positions', 'employee_jobs.emp_mainposition_id', 'employee_positions.id')
                ->join('users', 'employees.user_id', 'users.id')

                ->where(array_keys($filter)[0], array_values($filter)[0])
                ->whereYear('payroll_master.year_month', date('Y'))
                ->where('payroll_master.company_id', $companyId)
                ->where('users.status', 'Active')
                ->groupBy(DB::raw("payroll_trx.employee_id"))
                ->get();
        }else{
            echo DB::table('payroll_master')
                ->select(
                    DB::raw('employees.id,users.name, employees.contact_no, employees.address, employees.dob, employees.gender, employees.race'),
                    DB::raw('countries.citizenship, employees.marital_status, employees.total_children, employees.ic_no, employees.tax_no'),
                    DB::raw('employees.epf_no, employees.socso_no, employees.insurance_no, employees.pcb_group, employees.driver_license_no'),
                    DB::raw('employees.driver_license_expiry_date, employees.confirmed_date, users.email, employee_positions.name as position'),
                    DB::raw('employee_jobs.start_date as job_start_date, employee_jobs.end_date as job_end_date'),
                    DB::raw('max(employees.total_children) as total_children'),

                    DB::raw('sum(payroll_trx.gross_pay) as total_gross_salary ,sum(payroll_trx.basic_salary) as total_basic_salary'),
                    DB::raw('sum(payroll_trx.employee_epf) as total_epf,sum(payroll_trx.employee_eis) as total_eis'),
                    DB::raw('sum(payroll_trx.employee_socso) as total_socso,sum(payroll_trx.employee_pcb) as total_pcb'),
                    DB::raw('min(payroll_master.start_date) as remuneration_start_date , max(payroll_master.end_date) as remuneration_end_date')
                )
                ->join('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
                ->join('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
                ->join('employees', 'payroll_trx.employee_id', 'employees.id')
                ->join('countries', 'employees.nationality', 'countries.id')
                ->join('employee_positions', 'employee_jobs.emp_mainposition_id', 'employee_positions.id')
                ->join('users', 'employees.user_id', 'users.id')

                ->whereYear('payroll_master.year_month', date('Y'))
                ->where('payroll_master.company_id', $companyId)
                ->where('users.status', 'Active')
                ->groupBy(DB::raw("payroll_trx.employee_id"))
                ->get();
        }
    }

/*select users.name, employees.contact_no, employees.address, employees.dob, employees.gender, employees.race,
countries.citizenship, employees.marital_status, employees.total_children, employees.ic_no, employees.tax_no,
employees.epf_no, employees.socso_no, employees.insurance_no, employees.pcb_group, employees.driver_license_no,
employees.driver_license_expiry_date, employees.confirmed_date, users.email, employee_positions.name,
employee_jobs.start_date, employee_jobs.end_date
from employees
inner join `users` on `employees`.`user_id` = `users`.`id`
inner join `countries` on `employees`.`nationality` = `countries`.`id`
inner join `employee_jobs` on `employees`.`id` = `employee_jobs`.`emp_id`
inner join `employee_positions` on `employee_jobs`.`emp_mainposition_id` = `employee_positions`.`id`
where users.status='Active' and employees.company_id=1;*/
}
