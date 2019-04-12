<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/15/18
 * Time: 5:53 PM
 */

namespace App\Helpers;

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
use App\Http\Controllers\Popo\governmentreport\SocsoBorang8ABean;
use App\Http\Controllers\Popo\governmentreport\PtptnP04Bean;
use App\Http\Controllers\Popo\governmentreport\ZakatBean;
use App\Http\Controllers\Popo\governmentreport\EISLampiranBean;
use App\Http\Controllers\Popo\governmentreport\EmployeeBean;

use App\Enums\PayrollPeriodEnum;
use App\Services\GovernmentReportService;
use App\Repositories\Payroll\GovernmentReportRepositoryImpl;

use Illuminate\Support\Facades\Auth;
use App\Branch;
use App\CostCentre;
use App\Department;
use App\EmployeePosition;
use App\User;
use App\Company;
use App\PayrollSetup;


use \DB;

class GenerateReportsHelper
{

    protected static $governmentReportService;
    private static $count_per_page = 15;

    public function __construct(){
        self::$governmentReportService = new GovernmentReportRepositoryImpl();
    }


    public static function generateBean($reportName,$periods,$year,$officerId,$filter,$search){
        switch ($reportName) {
            case "LHDN_borangE":

                //set pojo
                $data = array();
                $companyInformation = self::getUserLogonCompanyInformation();
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,null,null,$year);
                $totalEmployeeActiveAndResign = self::getEmployeeTotalActiveAndResigned($companyInformation->id,$filter,$search,null,$year); //TODO check need to filter with user id
                $payrollSetup = self::getPayrollSetupValue('LHDN_CHILD_DEPARTURE_AMOUNT',$companyInformation->id);

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else {
                    $data = new LhdnBorangEBean([
                        'employerName' => $companyInformation->name,
                        'employerNoE' => $companyInformation->tax_no,
                        //'employerStatus' => 2,
                        'businessStatus' => 1,
                        //'incomeTaxNo' => $companyInformation->tax_no,  //'SG10234567090',
                        //'icNo' => 'B3200090304M',
                        //'passportNo' => 'A320000304',
                        'ssmNo' => $companyInformation->registration_no,
                        'address1' => $companyInformation->address,   //'LEVEL 15, TOWER 1, PJ 33,',
                        'address2' => $companyInformation->address2,  //'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                        'address3' => $companyInformation->address3,  //'SELANGOR.',
                        'postcode' => $companyInformation->postcode,  //46200,
                        'phoneNo' => $companyInformation->phone,
                        //'mobileNo' => '013-7931 3550',
                        //'email' => 'oppo.amandachong@gmail.com',
                        //'CP8D' => 1,
                        'year' => $year,
                        'totalEmployee' => $totalEmployeeActiveAndResign->total_employee,
                        'totalEmployeeWithPCB' => $totalEmployeeActiveAndResign->total_employee_have_pcb,
                        'totalNewEmployee' => $totalEmployeeActiveAndResign->total_new_employee,
                        'totalEmployeeResigned' => $totalEmployeeActiveAndResign->total_employee_resigned,
                        //'totalEmployeeResignedLeaveMalaysia' => 1,
                        //'reportLHDNM' => 1,
                        'officerName' => $officerInformation->name,
                        'officerIC' => $officerInformation->ic_no,
                        'officerPosition' => $officerInformation->position,
                        'email' => $officerInformation->email
                    ]);

                    //example
                    $empData = array();
                    //example
                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $emp = new LhdnCP8EmployeeDetail([
                            'employeeName' => $userPayroll->name,
                            'incomeTaxNo' => $userPayroll->tax_no,
                            'icNo' => $userPayroll->ic_no,
                            'employeeCategory' => self::getMaritalCategory($userPayroll->marital_status),
                            'taxPayByEmployer' => 'Tidak',
                            'totalChildren' => $userPayroll->total_children,
                            'amountOfDeparture' => $userPayroll->total_children * $payrollSetup->value,
                            'totalGrossRemuneration' => $userPayroll->B1a,
                            'benefitsOfGoods' => $userPayroll->B3,
                            'valuePlaceOfResidence' => $userPayroll->B4,
                            'benefitsOfESOS' => $userPayroll->B1e,
                            //'taxExemptPerquisites' => $userPayroll->name,
                            //'TP1Departure' => $userPayroll->name,
                            //'TP1Zakat' => $userPayroll->name,
                            'employeeEPFContributions' => $userPayroll->total_epf,
                            //'zakatDeductions' => $userPayroll->name,
                            'taxDeductionOfPCB' => $userPayroll->total_pcb
                            //'taxDeductionOfCP38' => $userPayroll->name
                        ]);
                        $empData[] = $emp;
                    }

                    $arr = array("data" => $data, "empData" => $empData);
                    return $arr;
                }
            break;

            case "LHDN_cp21":
                    //set pojo
                    $data = array();
                    $companyInformation = self::getUserLogonCompanyInformation();
                    $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);
                    $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,null,null,$year);
                    $yearlyPeriod = self::getPeriodFromAndUntil($year);

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else {
                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $obj = new LhdnCP21Bean([
                            'employerName' => $companyInformation->name,
                            'employerNoE' => $companyInformation->tax_no,        //'E9119707907',
                            'employerAddress1' => $companyInformation->address,  //'LEVEL 15, TOWER 1, PJ 33,',
                            'employerAddress2' => $companyInformation->address2, //'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                            'employerAddress3' => $companyInformation->address3, //'SELANGOR.',
                            'employerPostcode' => $companyInformation->postcode, //46200,
                            'employerNoTel' => $companyInformation->phone,
                            'name_A' => $userPayroll->name,
                            'dateOfCommencement_A' => self::changeTwoDigitDate($userPayroll->job_start_date),
                            'address1_A' => $userPayroll->address,   //'No 7 ,Simpang Empat',
                            'address2_A' => $userPayroll->address2,  //'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                            'address3_A' => $userPayroll->address3,  //'SELANGOR.',
                            'postcode_A' => $userPayroll->postcode,  //46200,
                            'expectedDatetoLeaveMalaysia_A' => '',
                            'xAddressBelongsToTaxAgent_A' => '',
                            'ic_A' => $userPayroll->ic_no,
                            'incomeTaxNo_A' => $userPayroll->tax_no,
                            'citizenship_A' => $userPayroll->citizenship,
                            'dateOfBirth_A' => self::changeTwoDigitDate($userPayroll->dob),
                            'natureOfEmployment_A' => $userPayroll->position,
                            'telno_A' => $userPayroll->contact_no,

                            'salaryFrom_B' => self::changeMalaysianDate($userPayroll->remuneration_start_date), //TODO : remuneration date wrong
                            'salaryUntil_B' => self::changeMalaysianDate($userPayroll->remuneration_end_date),
                            'salaryAmount_B' => $userPayroll->total_gross_salary, //TODO : is it included leave pay?

                            'leavePayFrom_B' => $yearlyPeriod['period_from'],
                            'leavePayUntil_B' => $yearlyPeriod['period_util'],
                            'leavePayAmount_B' => $userPayroll->ALP + $userPayroll->CFLP,

                            'commissionFrom_B' => $yearlyPeriod['period_from'],
                            'commissionUntil_B' => $yearlyPeriod['period_util'],
                            'commissionAmount_B' => $userPayroll->B1b,

                            'gratuityFrom_B' => $yearlyPeriod['period_from'],
                            'gratuityUntil_B' => $yearlyPeriod['period_util'],
                            'gratuityAmount_B' => $userPayroll->B1f,

                            'compensationFrom_B' => $yearlyPeriod['period_from'],
                            'compensationUntil_B' => $yearlyPeriod['period_util'],
                            'compensationAmount_B' => $userPayroll->B6,

                            'cashAllowanceFrom_B' => $yearlyPeriod['period_from'],
                            'cashAllowanceUntil_B' => $yearlyPeriod['period_util'],
                            'cashAllowanceAmount_B' => $userPayroll->B1d,

                            'pensionFrom_B' => $yearlyPeriod['period_from'],
                            'pensionUntil_B' => $yearlyPeriod['period_util'],
                            'pensionAmount_B' => $userPayroll->C1,

                            'benefitSubjectToTaxFrom_B' => $yearlyPeriod['period_from'],
                            'benefitSubjectToTaxUntil_B' => $yearlyPeriod['period_util'],
                            'benefitSubjectToTaxAmount_B' => $userPayroll->B3,

                            'livingAccommodationFrom_B' => $yearlyPeriod['period_from'],
                            'livingAccommodationUntil_B' => $yearlyPeriod['period_util'],
                            'livingAccommodationAmount_B' => $userPayroll->B4,

                            //'otherAllowanceFrom_B' => $this->otherAllowanceFrom_B,
                            //'otherAllowanceUntil_B' => $this->otherAllowanceUntil_B,
                            //'otherAllowanceAmount_B' => $this->otherAllowanceAmount_B,

                            //'otherPaymentsFrom_B' => $this->otherPaymentsFrom_B,
                            //'otherPaymentsUntil_B' => $this->otherPaymentsUntil_B,
                            //'otherPaymentsAmount_B' => $this->otherPaymentsAmount_B,

                            //TODO : need sum of total of B section
                            'total_B' => $userPayroll->total_basic_salary +
                                         $userPayroll->ALP + $userPayroll->CFLP +
                                         $userPayroll->B1b +
                                         $userPayroll->B1f +
                                         $userPayroll->B6 +
                                         $userPayroll->B1d +
                                         $userPayroll->C1 +
                                         $userPayroll->B3 +
                                         $userPayroll->B4,

                            //SECTION D
                            'contributionsToEmployeeProvidentFund_D' => $userPayroll->total_epf,

                            'officerName_E' => $officerInformation->name,
                            'officerDesignation_E' => $officerInformation->position,
                            'officerSignature_E' => '',
                            'date_E' => self::getCurrentTwoDigitDate()

                        ]);
                        $data[] = $obj;
                    }
                    $arr = array("data" => $data);
                    return $arr;
                }
            break;

            case "LHDN_cp22":
                //set pojo
                $data = array();
                $companyInformation = self::getUserLogonCompanyInformation();
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);

                //Generate for new staff
                $date = self::getPayrollYearMonth($periods,$companyInformation->id);
                $extraFilter = 'year(`employee_jobs`.`start_date`) = '.$date->year.' and month(`employee_jobs`.`start_date`) = '.$date->month;
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,$extraFilter,$periods,null);

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else {
                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $obj = new LhdnCP22Bean([
                            'companyName' => $companyInformation->name,
                            'companyNoE' => 'E9119707907',
                            'companyNoTel' => $companyInformation->phone,
                            'addressTo1' => $companyInformation->address,     //'LEVEL 15, TOWER 1, PJ 33,',
                            'addressTo2' => $companyInformation->address2,    //'JALAN SEMANGAT, PETALING JAYA,',
                            'addressTo3' => $companyInformation->address3,    //'SELANGOR.',
                            'postcodeTo' => $companyInformation->postcode,    //46200,
                            'addressFrom1' => $companyInformation->address,   //'LEVEL 15, TOWER 1, PJ 33,',
                            'addressFrom2' => $companyInformation->address2,  //'JALAN SEMANGAT, PETALING JAYA,',
                            'addressFrom3' => $companyInformation->address3,  //'SELANGOR.',
                            'postcodeFrom' => $companyInformation->postcode,  //46200,

                            'name_A' => $userPayroll->name,
                            'incomeTaxNo_A' => $userPayroll->tax_no,
                            'jobRole_A' => $userPayroll->position,
                            'noIc_A' => $userPayroll->ic_no,
                            'employmentStartDate_A' => self::changeMalaysianDate($userPayroll->job_start_date),
                            'employmentExpectedDate_A' => '05/03/2018',
                            'immigrationNo_A' => $userPayroll->immigration_passport_no,
                            'address1_A' => $userPayroll->address,            //'No 7 ,Simpang Empat',
                            'address2_A' => $userPayroll->address2,           //'JALAN SEMANGAT, PETALING JAYA,',
                            'address3_A' => $userPayroll->address3,           //'SELANGOR.',
                            'postcode_A' => $userPayroll->postcode,            //46200,
                            'birthDate_A' => self::changeMalaysianDate($userPayroll->dob),
                            'maritalStatus_A' => $userPayroll->marital_status,
                            'signX_A' => '',

                            'fixedMontlyRemunerationRate_B' => $userPayroll->total_gross_salary,

                            'officerSignature_C' => '',
                            'officerName_C' => $officerInformation->name,
                            'officerRole_C' => $officerInformation->position,
                            'date_C' => self::getCurrentDate()
                        ]);
                        $data[] = $obj;
                    }
                    $arr = array("data" => $data);
                    return $arr;
                }
            break;

            case "LHDN_cp22a":
                //set pojo
                $data = array();
                $companyInformation = self::getUserLogonCompanyInformation();
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);

                //generate for resigned staff
                $extraFilter = 'employee_jobs.end_date IS NOT NULL';
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,$extraFilter,$periods,null);

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else {
                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $obj = new LhdnCP22aBean([
                            'employerName' => $companyInformation->name,
                            'employerNoE' => 'E9119707907',
                            'employerAddress1' => $companyInformation->address,     //'LEVEL 15, TOWER 1, PJ 33,',
                            'employerAddress2' => $companyInformation->address2,    //'JALAN SEMANGAT, PETALING JAYA,',
                            'employerAddress3' => $companyInformation->address3,    //'SELANGOR.',
                            'employerPostcode' => $companyInformation->postcode,    //46200,
                            'employerNoTel' => $companyInformation->phone,

                            'name_A' => $userPayroll->name,
                            'telNo_A' => $userPayroll->contact_no,
                            'commencementDate_A' => self::changeTwoDigitDate($userPayroll->job_start_date),
                            'address1_A' => $userPayroll->address,                  //'No 7 ,Simpang Empat',
                            'address2_A' => $userPayroll->address2,                 //'JALAN SEMANGAT, PETALING JAYA,',
                            'address3_A' => $userPayroll->address3,                 //'SELANGOR.',
                            'postcode_A' => $userPayroll->postcode,                 //46200,
                            'resignDate_A' => self::changeTwoDigitDate($userPayroll->job_end_date),
                            'birthDate_A' => self::changeTwoDigitDate($userPayroll->dob),
                            //'resignType_A' => 'X',
                            //'signX' => '',
                            'icNo_A' => $userPayroll->ic_no,

                            'incomeTaxNo_A' => $userPayroll->tax_no,
                            'marriedStatus_A' => $userPayroll->marital_status,
                            'childrenNo_A' => $userPayroll->total_children,
                            'totalIncomeTaxChild_A' => '0.00',
                            //'spouseName_A' => 'SUZANNAH IBRAHIM',
                            //'spouseIc_A' => '871898176765',
                            //'spouseIncomeTax_A' => 'OG12345678910',

                            'salaryFrom_B' => self::changeMalaysianDate($userPayroll->remuneration_start_date),
                            'salaryUntil_B' => self::changeMalaysianDate($userPayroll->remuneration_end_date),
                            'salaryAmount_B' => $userPayroll->total_gross_salary,
                            /*                        'leavePayFrom_B' => '01/01/2018',
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
                                                    'totalBenefit' => 12.00,*/
                            //TODO calculate sum of
                            'total_B' => $userPayroll->total_gross_salary,

                            //'moneyWithheldByEmployer_D' => 74.19,
                            'monthlyTaxDeductions_D' => $userPayroll->total_pcb,
                            //'amountOfZakatPaid_D' => 74.19,
                            'contributionsToEmployeeProvidentFund_D' => $userPayroll->total_epf,

                            'officerName_E' => $officerInformation->name,
                            'officerDesignation_E' => $officerInformation->position,
                            'officerSignature_E' => '',
                            'date_E' => self::getCurrentTwoDigitDate()
                        ]);
                        $data[] = $obj;
                    }
                    $arr = array("data" => $data);
                    return $arr;
                }
            break;

            case "LHDN_cp22b":
                //set pojo
                $data = array();
                $companyInformation = self::getUserLogonCompanyInformation();
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);

                //generate for resigned staff
                $extraFilter = 'employee_jobs.end_date IS NOT NULL';
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,$extraFilter,$periods,null);

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else {
                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $obj = new LhdnCP22bBean([
                            'employerName' => $companyInformation->name,
                            'employerNoE' => 'E9119707907',
                            'employerAddress1' => $companyInformation->address,     //'LEVEL 15, TOWER 1, PJ 33,',
                            'employerAddress2' => $companyInformation->address2,    //'JALAN SEMANGAT, PETALING JAYA,',
                            'employerAddress3' => $companyInformation->address3,    //'SELANGOR.',
                            'employerPostcode' => $companyInformation->postcode,    //46200,
                            'employerNoTel' => $companyInformation->phone,

                            'name_A' => $userPayroll->name,
                            'telNo_A' => $userPayroll->contact_no,
                            'commencementDate_A' => self::changeTwoDigitDate($userPayroll->job_start_date),
                            'address1_A' => $userPayroll->address,                  //'No 7 ,Simpang Empat',
                            'address2_A' => $userPayroll->address2,                 //'JALAN SEMANGAT, PETALING JAYA,',
                            'address3_A' => $userPayroll->address3,                 //'SELANGOR.',
                            'postcode_A' => $userPayroll->postcode,                 //46200,
                            'resignDate_A' => self::changeTwoDigitDate($userPayroll->job_end_date),
                            'birthDate_A' => self::changeTwoDigitDate($userPayroll->dob),
                            /*                        'resignType_A' => 'X',
                                                    'signX' => '',*/
                            'icNo_A' => $userPayroll->ic_no,
                            /*                        'legalRepresentativeName_A' => 'SHAHRIL ABU BAKAR',
                                                    'legalRepresentativeIc_A' => '871898176765',
                                                    'legalRepresentativeAddress1_A' => 'No 7 ,Simpang Empat',
                                                    'legalRepresentativeAddress2_A' => 'JALAN SEMANGAT, PETALING JAYA,',
                                                    'legalRepresentativeAddress3_A' => 'SELANGOR.',
                                                    'legalRepresentativeNoTel_A' => '0345467453',*/
                            'incomeTaxNo_A' => $userPayroll->tax_no,
                            'marriedStatus_A' => $userPayroll->marital_status,
                            'childrenNo_A' => $userPayroll->total_children,
                            'totalIncomeTaxChild_A' => '0.00',
                            /*                        'spouseName_A' => 'SUZANNAH IBRAHIM',
                                                    'spouseIc_A' => '871898176765',
                                                    'spouseIncomeTax_A' => 'OG12345678910',*/

                            'salaryFrom_B' => self::changeMalaysianDate($userPayroll->remuneration_start_date),
                            'salaryUntil_B' => self::changeMalaysianDate($userPayroll->remuneration_end_date),
                            'salaryAmount_B' => $userPayroll->total_gross_salary,
                            /*                        'leavePayFrom_B' => '01/01/2018',
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
                                                    'otherPaymentsAmount_B' => 4.19,*/
                            //TODO calculate sum of
                            'total_B' => $userPayroll->total_gross_salary,

                            /*                        'typeOfIncome1_C' => 'Online Business',
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
                                                    'pensionFund3_C' => 4.19,*/

                            //'moneyWithheldByEmployer_D' => 74.19,
                            'monthlyTaxDeductions_D' => $userPayroll->total_pcb,
                            //'amountOfZakatPaid_D' => 74.19,
                            'contributionsToEmployeeProvidentFund_D' => $userPayroll->total_epf,

                            'officerName_E' => $officerInformation->name,
                            'officerDesignation_E' => $officerInformation->position,
                            'officerSignature_E' => '',
                            'date_E' => self::getCurrentTwoDigitDate()

                        ]);
                        $data[] = $obj;
                    }
                    $arr = array("data" => $data);
                    return $arr;
                }
            break;

            case "LHDN_cp39":
                //set popo
                $companyInformation = self::getUserLogonCompanyInformation();
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,null,$periods,null);

                $empData = array();
                $totalPcb = 0;
                $totalcp38 = 0;
                $totalAmountofPCBAndCP8 = 0;

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else {
                    //example
                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $emp = new LhdnCP39Bean([
                            'incomeTaxNo' => $userPayroll->tax_no,
                            'name' => $userPayroll->name,
                            'oldIcNo' => '',
                            'newIcNo' => $userPayroll->ic_no,
                            'staffNo' => $userPayroll->id,
                            'foreignerPassportNo' => $userPayroll->immigration_passport_no,
                            'foreignerCountry' => '',
                            'pcbAmount' => $userPayroll->total_pcb,
                            'cp38Amount' => 0.00
                        ]);
                        //sum of pcb/cp8
                        $totalPcb += $emp->getPcbAmount();
                        $totalcp38 += $emp->getCp38Amount();

                        //sum of total pcb/cp8
                        $totalAmountofPCBAndCP8 = ($totalPcb + $totalcp38);

                        $empData[] = $emp;
                    }

                    $data = new LhdnCP39Bean([
                        'companyName' => $companyInformation->name,
                        'companyRegistrationNo' => $companyInformation->registration_no,
                        'companyAddress1' => $companyInformation->address,          //'LEVEL 15, TOWER 1, PJ 33,',
                        'companyAddress2' => $companyInformation->address2,         //'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                        'companyAddress3' => $companyInformation->address3,         //'SELANGOR.',
                        'companyPostcode' => $companyInformation->postcode,         //46200,

                        'employerNoE' => 'E9119707907',
                        'pcbTotalCut' => $totalPcb,
                        'pcbTotalWorker' => count($userInfoAndPayrollList),
                        'pcbTotalAmount' => $totalPcb,
                        'pcbBranchNo' => '',
                        'cp38TotalCut' => '',
                        'cp38TotalWorker' => 0,

                        'officerSignature' => '',
                        'officerName' => $officerInformation->name,
                        'officerIcNo' => $officerInformation->ic_no,
                        'officerPosition' => $officerInformation->position,
                        'officerNoTel' => $officerInformation->contact_no
                    ]);

                    $arr = array(
                        "data" => $data,
                        "empData" => $empData,
                        "totalPcb" => $totalPcb,
                        "totalcp38" => $totalcp38,
                        "totalAmountofPCBAndCP8" => $totalAmountofPCBAndCP8
                    );
                    return $arr;
                }
            break;

            case "LHDN_cp39lieu":
                //set pojo
                $data = array();
                $companyInformation = self::getUserLogonCompanyInformation();
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,null,$periods,null);

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else {
                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $obj = new LhdnCP39LieuBean([
                            'employerName' => $companyInformation->name,
                            'employerNoE' => 'E9119707907',
                            'name' => $userPayroll->name,
                            'salaryNo' => 13113,
                            //'icOldNo' => '18281A811',
                            'icNewNo' => $userPayroll->ic_no,
                            'referenceTaxRevenueNo' => $userPayroll->tax_no,
                            'marriageStatus' => $userPayroll->marital_status,
                            //'marriageDate' => '19/09/1993',
                            'gender' => $userPayroll->gender,
                            //'pcbMadeYears' => '1922',
                            'workStartedDate' => self::changeMalaysianDate($userPayroll->job_start_date),
                            'monthlySalary' => $userPayroll->total_gross_salary,
                            'address1' => $userPayroll->address,        //'No 7 ,Simpang Empat',
                            'address2' => $userPayroll->address2,       //'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                            'address3' => $userPayroll->address3,       //'SELANGOR.',
                            'postcode' => $userPayroll->postcode,       //46200,
                        /*  'foreignerBirthDate' => '01/05/2017',
                            'foreignerPassportNo' => '71817111A',
                            'spouseName' => 'KIMBERLY SWAZER',
                            'spouseIcOldNo' => '78711818918',
                            'spouseIcNewNo' => '931212818119',
                            'spouseReferenceTaxRevenueNo' => '8171811',
                            'foreignerSpouseBirthDate' => '01/04/1212',
                            'foreignerSpousePassportNo' => '1212221'*/
                        ]);
                        $data[] = $obj;
                    }
                    $arr = array("data" => $data);
                    return $arr;
                }
            break;

            case "LHDN_eaform":
                //set pojo
                $data = array();
                $companyInformation = self::getUserLogonCompanyInformation();
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,null,null,$year);

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else{
                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $obj = new LhdnEAFormBean([
                            'year' => $year,
                            'serialNo' => 'A000755',
                            'incomeTaxNo' => $userPayroll->tax_no,
                            'employerNoE' => 'E9119707907',
                            'lhdnmBranch' => 'PORT KLANG',
                            'name' => $userPayroll->name,
                            'jobPosition' => $userPayroll->position,
                            'salaryNo' => $userPayroll->id,
                            'icNo' => $userPayroll->ic_no,
                            //'passportNo' => 'M81292123',
                            'kwspNo' => $userPayroll->epf_no,
                            'perkesoNo' => $userPayroll->socso_no,
                            //'childNoforTax' => 3,
                            //'startDateLessOneYear' => '20/01/1997',
                            //'endDateLessOneYear' => '20/01/1997',

                            'netSalary' => $userPayroll->total_gross_salary,
                            'commission' => $userPayroll->B1b,
                            'tip' => $userPayroll->B1c,
                            'employerIncomeTax' => $userPayroll->B1d,
                            'esos' => $userPayroll->B1e,
                            'reward' => $userPayroll->B1f,
                            'outstandingPayment' => $userPayroll->B2,
                            'benefitsOfMerchandise' => $userPayroll->B3,
                            'residenceValue' => $userPayroll->B4,
                            'failedRefund' => $userPayroll->B5,
                            'lostJobReparation' => $userPayroll->B6,
                            'pension' => $userPayroll->C1,
                            'annuity' => $userPayroll->C2,

                            'total' => $userPayroll->total_gross_salary +
                                       $userPayroll->B1b +
                                       $userPayroll->B1c +
                                       $userPayroll->B1d +
                                       $userPayroll->B1e +
                                       $userPayroll->B1f +
                                       $userPayroll->B2 +
                                       $userPayroll->B3 +
                                       $userPayroll->B4 +
                                       $userPayroll->B5 +
                                       $userPayroll->B6 +
                                       $userPayroll->C1 +
                                       $userPayroll->C2 ,

                            'pcb' => $userPayroll->total_pcb,
                            //'deductionsInstructionsCP38' => 340,
                            //'zakatPaidThroughSalaryDeductions' => 12000,
                            //'tp1Release' => 1000,
                            //'tp1Zakat' => 40000,
                            //'totalDisbursementForEligibleChildren' => 40000,

                            'nameOfFund' => 'KUMPULAN SIMPANAN WANG MALAYSIA',
                            'amountOfContribution' => $userPayroll->total_epf,
                            'amountOfContributionPerkeso' => $userPayroll->total_socso,
                            //'totalAllowance' => 1000,

                            'date' => self::getCurrentDate(),
                            'officerName' => $officerInformation->name,
                            'officerPosition' => $officerInformation->position,
                            'companyName' => $companyInformation->name,
                            'companyAddress1' => $companyInformation->address,      //'No 7 ,Simpang Empat',
                            'companyAddress2' => $companyInformation->address2,     //'JALAN SEMANGAT, PETALING JAYA,',
                            'companyAddress3' => $companyInformation->address3,     //'SELANGOR.',
                            'companyPostcode' => $companyInformation->postcode,     //46200,
                            'companyNoTel' => $companyInformation->phone
                        ]);
                        $data[] = $obj;
                    }
                    $arr = array("data" => $data);
                    return $arr;
                }
            break;

            case "Tabung_Haji_caruman":
                //set popo
                $companyInformation = self::getUserLogonCompanyInformation();
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,null,$periods,null);

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else {
                    $data = new TabungHajiCarumanBean([
                        'companyName' => $companyInformation->name,
                        'employerCode' => 'AX2019211',
                        'address1' => $companyInformation->address,         //'LEVEL 15, TOWER 1, PJ 33,',
                        'address2' => $companyInformation->address2,        //'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                        'address3' => $companyInformation->address3,        //'SELANGOR.',
                        'postcode' => $companyInformation->postcode,        //46200,
                    ]);

                    $empData = array();
                    //example
                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $emp = new TabungHajiCarumanBean([
                            'employeeNoAccount' => 'E9119707907',
                            'employeeNo' => 'A5645',
                            'employeeIcNo' => '876756453421',
                            'employeeName' => 'Shahril Abu Bakar',
                            'employeeContribution' => 234.89,
                        ]);
                        $empData[] = $emp;
                    }
                    $arr = array("data" => $data, "empData" => $empData);
                    return $arr;
                }
            break;

            case "Tabung_Haji_df":
                break;

            case "EPF_bbcd":
                //set popo
                $companyInformation = self::getUserLogonCompanyInformation();
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,null,$periods,null);
                //TODO: NOT COMPLETE
                $data = new EpfBBCDBean([
                    //'employerReferenceNo' => '018884828',
                    'contributionAmount' => 5902.00,

                    'paymentCheck' => 'X',

                    'companyName' => 'OPPO ELECTRONICS SDN  BHD',
                    'companyRegistrationNo' => '1075187-D',
                    'companyAddress1' => 'LEVEL 15, TOWER 1, PJ 33,',
                    'companyAddress2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                    'companyAddress3' => 'SELANGOR.',
                    'companyPostcode' => 46200,

                    'officerName' => $officerInformation->name,
                    'officerICNo' => $officerInformation->ic_no,
                    'officerPosition' => $officerInformation->position,
                    'officerTelNo' => $officerInformation->contact_no,
                ]);
                $arr = array("data"=>$data);
                return $arr;
            break;

            case "EPF_borangA":
                //set popo
                $companyInformation = self::getUserLogonCompanyInformation();
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,null,$periods,null);

                $empData = array();
                $totalEmployerContribution = 0;
                $totalEmployeeContribution = 0;
                $totalOverallContributionEmp = 0;

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else {
                    //example
                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $emp = new EpfBorangABean([
                            'employeeKwspNo' => $userPayroll->epf_no,
                            'employeeIcNo' => $userPayroll->ic_no,
                            'employeeName' => $userPayroll->name,
                            'employeeWages' => $userPayroll->total_gross_salary,
                            'employerContribution' => $userPayroll->employer_epf_contribution,
                            'employeeContribution' => $userPayroll->total_epf
                        ]);
                        //sum of contribution
                        $totalEmployerContribution += $emp->getEmployerContribution();
                        $totalEmployeeContribution += $emp->getEmployeeContribution();

                        //sum of total contribution
                        $totalOverallContributionEmp = ($totalEmployerContribution + $totalEmployeeContribution);

                        $empData[] = $emp;
                    }

                    $data = new EpfBorangABean([
                        'employerReferenceNo' => '018884828',
                        'contributionAmount' => $totalOverallContributionEmp,
                        //'referenceNo' => '1234',
                        'paymentCheck' => 'X',

                        'companyName' => $companyInformation->name,
                        'companyRegNo' => $companyInformation->registration_no,
                        'companyAddress1' => $companyInformation->address,          //'LEVEL 15, TOWER 1, PJ 33,',
                        'companyAddress2' => $companyInformation->address2,         //'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                        'companyAddress3' => $companyInformation->address3,         //'SELANGOR.',
                        'companyPostcode' => $companyInformation->postcode,         //46200,
                        'employeeTotal' => count($userInfoAndPayrollList),

                        'officerName' => $officerInformation->name,
                        'officerIC' => $officerInformation->ic_no,
                        'officerPosition' => $officerInformation->position,
                        'officerTelNo' => $officerInformation->contact_no,
                        'officerEmail' => $officerInformation->email,
                    ]);

                    $arr = array("data" => $data, "empData" => $empData, "totalOverallContributionEmp" => $totalOverallContributionEmp);
                    return $arr;
                }
            break;

            case "SOSCO_lampiranA":
                //set popo
                $companyInformation = self::getUserLogonCompanyInformation();
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,null,$periods,null);
                $month = self::getPayrollMonth($periods,$companyInformation->id);

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else {
                    $totalSocso = 0;
                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $totalSocso += $userPayroll->total_socso;
                    }

                    $data = new SoscoLampiranABean([

                        'fromMonth' => self::malaysianMonth($month),
                        'toMonth' => self::malaysianMonth($month),
                        'employeeTotalNumber' => count($userInfoAndPayrollList),
                        'noCheck' => '',
                        'amount' => $totalSocso,
                        'employerCode' => 'B3200090304M',
                        'companyName' => $companyInformation->name,
                        'companyRegistrationNo' => $companyInformation->registration_no,
                        'address1' => $companyInformation->address,             //'LEVEL 15, TOWER 1, PJ 33,',
                        'address2' => $companyInformation->address2,            //'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                        'address3' => $companyInformation->address3,            //'SELANGOR.',
                        'postcode' => $companyInformation->postcode,            //46200,
                        'officerName' => $officerInformation->name,
                        'officerTelNo' => $officerInformation->contact_no
                    ]);
                    $arr = array("data" => $data);
                    return $arr;
                }
            break;

            case "SOSCO_borang8A":
                //set popo
                $companyInformation = self::getUserLogonCompanyInformation();
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);
                $active = self::getSocsoEmployeeActiveList($companyInformation->id,$periods,$search);
                $nonActive = self::getSocsoEmployeeResignList($companyInformation->id,$periods,$search);

                if(count($active) == 0 && count($nonActive) ==0) {
                    return;
                }else {
                    $empData = array();
                    $totalContribution = 0;
                    //TODO : Need rework
                    foreach ($active as $obj) {
                        $emp = new SocsoBorang8ABean([
                            'jobDate' => $obj->job_start_date,
                            'status' => 'B',
                            'employeeIcNo' => $obj->ic_no,
                            'employeeName' => $obj->name,
                            'employeeContribution' => $obj->total_socso,
                        ]);

                        $totalContribution += $emp->getEmployeeContribution();
                        $empData[] = $emp;
                    }

                    foreach ($nonActive as $obj) {
                        $emp = new SocsoBorang8ABean([
                            'jobDate' => $obj->job_end_date,
                            'status' => 'H',
                            'employeeIcNo' => $obj->ic_no,
                            'employeeName' => $obj->name,
                            'employeeContribution' => $obj->total_socso,
                        ]);

                        $totalContribution += $emp->getEmployeeContribution();
                        $empData[] = $emp;
                    }

                    $data = new SocsoBorang8ABean([
                        'month' => '11',
                        'year' => '2018',
                        'companyReferenceNo' => 'B3200090304M',
                        'companyBusinessRegistrationNo' => $companyInformation->registration_no,
                        'totalContribution' => $totalContribution,
                        //'payNotBeforeDate' => '',
                        'companyName' => $companyInformation->name,
                        'companyAddress1' => $companyInformation->address,          //'LEVEL 15, TOWER 1, PJ 33,',
                        'companyAddress2' => $companyInformation->address2,         //'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                        'companyAddress3' => $companyInformation->address3,         //'SELANGOR.',
                        'companyPostcode' => $companyInformation->postcode,         //46200,
                        'totalEmployee' => count($empData),
                        'officerName' => $companyInformation->name,
                        'officerTelNo' => $officerInformation->contact_no,
                    ]);

                    $arr = array("data" => $data, "empData" => $empData, "totalContribution" => $totalContribution);
                    return $arr;
                }
            break;

            case "PTPTN_monthly":
                //TODO :PTPTN currently not in used.
                //set popo
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);
                
                $data = new PtptnP04Bean([
                    'employerReferenceNo' => '',
                    'companyName' => 'OPPO ELECTRONICS SDN BHD',
                    'companyAddress1' => 'LEVEL 15, TOWER 1, PJ 33,',
                    'companyAddress2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                    'companyAddress3' => 'SELANGOR.',
                    'companyPostcode' => 46200,
                    'companyBusinessRegistrationNo' => '1075187-D',

                    'officerName' => $officerInformation->name,
                    'officerIC' => $officerInformation->ic_no,
                    'officerPosition' => $officerInformation->position,
                    'officerEmail' => $officerInformation->email,
                    'officerNoTel' => $officerInformation->contact_no,

                    'transferDate' => '',
                    'transferReferenceNo' => '',
                    'transferAmount' => '',
                    'checkNo' => '',
                    'bankProduceCheck' => '',
                    'checkAmount' => '124.60',
                    'checkPostDateToPTPTN' => '',
                    'checkDepositDate' => ''
                ]);

                $empData = array();
                $totalCheckAmount = 0;
                //example
                for($count=0;$count < 55; $count++){
                    $emp = new PtptnP04Bean([
                        'staffIcNo' => '881876876767',
                        'staffName' => 'MUHAMMAD SHAHRIL B. ABU BAKAR',
                        'amount' => 124.60,
                        'staffNo' => 12345
                    ]);
                    //sum of total check
                    $totalCheckAmount += $emp->getAmount();

                    $empData[] = $emp;
                }

                $arr = array("data" => $data, "empData" => $empData, "totalCheckAmount" => $totalCheckAmount);
                return $arr;
            break;

            case "ZAKAT_monthly":
                //TODO :ZAKAT currently not in used.
                //set popo
                $officerInformation = self::getEmployeeInformation($officerId,$companyInformation->id);
                $empData = array();
                $totalAmount = 0;
                //example
                for($count=0;$count < 55; $count++){
                    $emp = new ZakatBean([
                        'employeeOldIcNo' => '',
                        'employeeNewIcNo' => '881012345657',
                        'employeeName' => 'MUHAMMAD SHAHRIL B. ABU BAKAR',
                        'employeeAmount' => 23.40,
                        'zakatType' => '',
                    ]);
                    //sum of total amount
                    $totalAmount += $emp->getEmployeeAmount();
                    $empData[] = $emp;
                }

                $data = new ZakatBean([
                    'companyName' => 'OPPO ELECTRONICS SDN BHD',
                    'companyAddress1' => 'LEVEL 15, TOWER 1, PJ 33,',
                    'companyAddress2' => 'JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,',
                    'companyAddress3' => 'SELANGOR.',
                    'companyPostcode' => 46200,
                    'companyBusinessRegistrationNo' => '1075187-D',

                    'employerCodeNo' => '',
                    'month' => 'OGOS 2018',
                    'bankName' => '',
                    'checkNo' => '',
                    'totalAmount' => $totalAmount,

                    'officerName' => $officerInformation->name,
                    'officerIcNo' => $officerInformation->ic_no,
                    'officerPosition' => $officerInformation->position,
                    'officerEmail' => $officerInformation->email,
                    'officerNoTel' => $officerInformation->contact_no,
                ]);

                $arr = array("data" => $data, "empData" => $empData);
                return $arr;
            break;

            case "ASBN_monthly":
                //TODO :ASBN currently not in used.
            break;

            case "EIS_lampiran1":
                //set popo
                $companyInformation = self::getUserLogonCompanyInformation();
                $userInfoAndPayrollList = self::getListUserInformationAndPayroll($companyInformation->id,$filter,$search,null,$periods,null);
                $date = self::getPayrollYearMonth($periods,$companyInformation->id);

                if(count($userInfoAndPayrollList) == 0) {
                    return;
                }else {
                    $totalContributionAmount = 0;
                    $dataArr = array();

                    $data = new EISLampiranBean([
                        'companyName' => $companyInformation->name,
                        'companyNoCode' => 'B3200090304M',
                    ]);

                    foreach ($userInfoAndPayrollList as $userPayroll) {
                        $obj = new EISLampiranBean([
                            'companyName' => $companyInformation->name,
                            'companyNoCode' => 'B3200090304M',
                            'employeeIcNo' => $userPayroll->ic_no,
                            'employeeName' => $userPayroll->name,
                            'contributionMonth' => $date->month . $date->year,
                            'contributionAmount' => $userPayroll->total_eis,
                        ]);
                        //sum of total amount
                        $totalContributionAmount += $userPayroll->total_eis;
                        $dataArr[] = $obj;
                    }

                    $arr = array("data" => $data, "dataArr" => $dataArr, "totalContributionAmount" => $totalContributionAmount);
                    return $arr;
                }
            break;

            case "test":
                 //$companyInformation = self::getUserLogonCompanyInfomation();
                 //self::getEmployeeInformation($officerId,$companyInformation->id);
                 //echo "huheue";
                //echo self::getPeriod(1);

                break;

            default:
                echo "None";
        }
    }


    public static function generateEmployeeList($reportName,$periods,$year,$officerId,$filter,$search,$page)
    {
        $companyInformation = self::getUserLogonCompanyInformation();
        
        switch ($reportName) {
            case "LHDN_borangE":
                $companyInformation = self::getUserLogonCompanyInformation();
                return self::getEmployeeListInformation($companyInformation->id, $filter,$search, null, null, $year,$page);
            break;
            case "LHDN_cp21":
                $companyInformation = self::getUserLogonCompanyInformation();
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,null,null,$year,$page);
            break;
            case "LHDN_cp22":
                $companyInformation = self::getUserLogonCompanyInformation();
                $date = self::getPayrollYearMonth($periods,$companyInformation->id);
                $extraFilter = 'year(`employee_jobs`.`start_date`) = '.$date->year.' and month(`employee_jobs`.`start_date`) = '.$date->month;
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,$extraFilter,$periods,null,$page);
            break;
            case "LHDN_cp22a":
                $companyInformation = self::getUserLogonCompanyInformation();
                $extraFilter = 'employee_jobs.end_date IS NOT NULL';
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,$extraFilter,$periods,null,$page);
            break;
            case "LHDN_cp22b":
                $companyInformation = self::getUserLogonCompanyInformation();
                $extraFilter = 'employee_jobs.end_date IS NOT NULL';
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,$extraFilter,$periods,null,$page);
            break;
            case "LHDN_cp39":
                $companyInformation = self::getUserLogonCompanyInformation();
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,null,$periods,null,$page);
            break;
            case "LHDN_cp39lieu":
                $companyInformation = self::getUserLogonCompanyInformation();
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,null,$periods,null,$page);
            break;
            case "LHDN_eaform":
                $companyInformation = self::getUserLogonCompanyInformation();
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,null,null,$year,$page);
            break;
            case "Tabung_Haji_caruman":
                $companyInformation = self::getUserLogonCompanyInformation();
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,null,$periods,null,$page);
            break;
            case "Tabung_Haji_df":
                return collect([]);
            break;
            case "EPF_bbcd":
                return collect([]);
            break;
            case "EPF_borangA":
                $companyInformation = self::getUserLogonCompanyInformation();
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,null,$periods,null,$page);
            break;
            case "SOSCO_lampiranA":
                $companyInformation = self::getUserLogonCompanyInformation();
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,null,$periods,null,$page);
            break;
            case "SOSCO_borang8A":
                $companyInformation = self::getUserLogonCompanyInformation();
                return self::getEmployeeListInformationSocsoActiveAndResigned($companyInformation->id,$periods,$page);
            break;
            case "PTPTN_monthly":
                return collect([]);
            break;
            case "ZAKAT_monthly":
                return collect([]);
            break;
            case "ASBN_monthly":
                return collect([]);
            break;
            case "EIS_lampiran1":
                $companyInformation = self::getUserLogonCompanyInformation();
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,null,$periods,null,$page);
            break;
            //payroll reports
            case "1":
            case "2":
            case "3":
            case "4":
            case "5":
            case "6":
            case "7":
            case "8":
                return self::getEmployeeListInformation($companyInformation->id,$filter,$search,null,$periods,null,$page);
            break;
            default:
                return collect([]);
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

    public static function getPeriod($company_id){
        $period = self::getPeriodList($company_id);
        $data = array();
        foreach($period as $val){
            $period_desc = PayrollPeriodEnum::getDescription($val->period);
            array_push($data,[
                'id' => $val->id,
                'yearmonth' => $val->yearmonth,
                'period_id' => $val->period,
                'period_desc' => $period_desc
            ]);
        }
        return $data;
    }

    public static function getYear($company_id){
        return self::getListPayrollYear($company_id);
    }

    public static function getPeriodList($company_id){;
        //  sample query : ->toSql()
        return DB::table('payroll_master')
            ->select(DB::raw('id, EXTRACT( YEAR_MONTH FROM `year_month` ) as yearmonth, period'))
            ->where([['company_id', $company_id],['status',1]])->get();

    }

    public static function getEmployeeInformation($emp_id,$company_id){;
     //  sample query : ->toSql()
        return DB::table('employees')
            ->select(DB::raw('users.id,users.name,employees.ic_no,employees.contact_no,employee_positions.name as position,users.email'))
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->join('employee_jobs','employees.id','employee_jobs.emp_id')
            ->join('employee_positions','employee_jobs.emp_mainposition_id','employee_positions.id')
            ->where('employees.id',$emp_id)
            ->where('users.status','Active')
            ->where('employees.company_id', $company_id)->first();

    }

    public static function getListOfficerInformation($companyId){
        //  sample query : ->toSql()

        return DB::table('model_has_roles')
            ->select(DB::raw('employees.id,users.name,employees.ic_no,employees.contact_no,employee_positions.name as position'))
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('users', 'model_has_roles.model_id', '=', 'users.id')
            ->join('employees','users.id','employees.user_id')
            ->join('employee_jobs','employees.id','employee_jobs.emp_id')
            ->join('employee_positions','employee_jobs.emp_mainposition_id','employee_positions.id')
            ->where('roles.name','hr-exec')
            ->where('users.status','Active')
            ->where('employees.company_id', $companyId)
            ->get();

    }

    public static function getListUserInformationAndPayroll($companyId,$filter,$search,$extraFilter,$periods,$year){

        $query = DB::table('payroll_master')
            ->select(
                DB::raw('employees.id,payroll_trx.id as trx_id,users.name, employees.contact_no, employees.address,
                employees.address2,employees.address3,employees.postcode, employees.dob, employees.gender, employees.race'),
                DB::raw('countries.citizenship, employees.marital_status, employees.total_children, employees.ic_no, employees.tax_no'),
                DB::raw('employees.epf_no, employees.socso_no, employees.insurance_no, employees.pcb_group, employees.driver_license_no'),
                DB::raw('employees.driver_license_expiry_date, employees.confirmed_date, users.email, employee_positions.name as position'),
                DB::raw('employee_jobs.start_date as job_start_date, employee_jobs.end_date as job_end_date'),
                DB::raw('employee_immigrations.passport_no as immigration_passport_no'),

                DB::raw('max(employees.total_children) as total_children'),
                DB::raw('sum(payroll_trx.gross_pay) as total_gross_salary '),
                DB::raw('sum(payroll_trx.basic_salary) as total_basic_salary'),
                DB::raw('sum(payroll_trx.employee_epf) as total_epf'),
                DB::raw('sum(payroll_trx.employee_eis) as total_eis'),
                DB::raw('sum(payroll_trx.employee_socso) as total_socso'),
                DB::raw('sum(payroll_trx.employee_pcb) as total_pcb'),
                DB::raw('sum(payroll_trx.employer_epf) as employer_epf_contribution'),
                DB::raw('sum(payroll_trx.employer_eis) as employer_eis_contribution'),
                DB::raw('sum(payroll_trx.employer_socso) as employer_socso_contribution'),
                DB::raw('min(payroll_master.start_date) as remuneration_start_date'),
                DB::raw('max(payroll_master.end_date) as remuneration_end_date'),

                DB::raw('sum( if( additions.ea_form_id = 1, payroll_trx_addition.amount, 0 ) ) AS B1a'),
                DB::raw('sum( if( additions.ea_form_id = 2, payroll_trx_addition.amount, 0 ) ) AS B1b'),
                DB::raw('sum( if( additions.ea_form_id = 3, payroll_trx_addition.amount, 0 ) ) AS B1c'),
                DB::raw('sum( if( additions.ea_form_id = 4, payroll_trx_addition.amount, 0 ) ) AS B1d'),
                DB::raw('sum( if( additions.ea_form_id = 5, payroll_trx_addition.amount, 0 ) ) AS B1e'),
                DB::raw('sum( if( additions.ea_form_id = 6, payroll_trx_addition.amount, 0 ) ) AS B1f'),
                DB::raw('sum( if( additions.ea_form_id = 7, payroll_trx_addition.amount, 0 ) ) AS B2'),
                DB::raw('sum( if( additions.ea_form_id = 8, payroll_trx_addition.amount, 0 ) ) AS B3'),
                DB::raw('sum( if( additions.ea_form_id = 9, payroll_trx_addition.amount, 0 ) ) AS B4'),
                DB::raw('sum( if( additions.ea_form_id = 10, payroll_trx_addition.amount, 0 ) ) AS B5'),
                DB::raw('sum( if( additions.ea_form_id = 11, payroll_trx_addition.amount, 0 ) ) AS B6'),
                DB::raw('sum( if( additions.ea_form_id = 12, payroll_trx_addition.amount, 0 ) ) AS C1'),
                DB::raw('sum( if( additions.ea_form_id = 13, payroll_trx_addition.amount, 0 ) ) AS C2'),

                DB::raw('sum( if( payroll_trx_addition.additions_id = 1, payroll_trx_addition.amount, 0 ) ) AS OT'),
                DB::raw('sum( if( payroll_trx_addition.additions_id = 2, payroll_trx_addition.amount, 0 ) ) AS ALP'),
                DB::raw('sum( if( payroll_trx_addition.additions_id = 3, payroll_trx_addition.amount, 0 ) ) AS CFLP'),
                DB::raw('sum( if( payroll_trx_addition.additions_id = 4, payroll_trx_addition.amount, 0 ) ) AS PH'),
                DB::raw('sum( if( payroll_trx_addition.additions_id = 5, payroll_trx_addition.amount, 0 ) ) AS RD'),
                DB::raw('sum( if( payroll_trx_addition.additions_id = 6, payroll_trx_addition.amount, 0 ) ) AS MC')

            )
            ->join('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
            ->join('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
            ->join('employees', 'payroll_trx.employee_id', 'employees.id')
            ->join('countries', 'employees.nationality', 'countries.id')
            ->join('employee_positions', 'employee_jobs.emp_mainposition_id', 'employee_positions.id')
            ->join('users', 'employees.user_id', 'users.id')
            ->leftjoin('employee_immigrations', 'employees.id', 'employee_immigrations.emp_id')
            ->leftjoin('payroll_trx_addition', 'payroll_trx.id', 'payroll_trx_addition.payroll_trx_id')
            ->leftjoin('additions', 'payroll_trx_addition.additions_id', 'additions.id');


            //filter
            if(count($filter) > 0){
                foreach($filter as $key => $value){
                    $query->where($key, $value);
                }
            }

            //search
            if(count($search) > 0){
                foreach($search as $key => $value){
                    $query->whereIn($key, $value);
                }
            }


            if(!empty($year)){
                $query->whereYear('payroll_master.year_month', $year);
            }

            if(!empty($periods) && $periods != 0){
                $query->where('payroll_master.id', $periods);
            }

            //extra filter
            if(!empty($extraFilter)){
                $query->whereRaw($extraFilter);
            }

        $query->where('payroll_master.company_id', $companyId)
//             ->groupBy(DB::raw("payroll_trx.employee_id,payroll_trx_addition.payroll_trx_id,additions.ea_form_id"));
        ->groupBy(DB::raw("payroll_trx.employee_id"));

        $result= $query->get();

        return $result;
    }

    public static function getEmployeeListInformation($companyId,$filter,$search,$extraFilter,$periods,$year,$page){

        $query = DB::table('payroll_master')
            ->select(
                DB::raw('users.id,users.name, employees.ic_no')
            )
            ->join('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
            ->join('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
            ->join('employees', 'payroll_trx.employee_id', 'employees.id')
            ->join('employee_positions', 'employee_jobs.emp_mainposition_id', 'employee_positions.id')
            ->join('users', 'employees.user_id', 'users.id')
            ->leftjoin('employee_immigrations', 'employees.id', 'employee_immigrations.emp_id');

        //filter
        if(count($filter) > 0){
            foreach($filter as $key => $value){
                $query->where($key, $value);
            }
        }

        //search
        if(count($search) > 0){
            foreach($search as $key => $value){
                $query->where($key,'LIKE', "%$value%");
            }
        }

        if(!empty($year)){
            $query->whereYear('payroll_master.year_month', $year);
        }

        if(!empty($periods) && $periods != 0){
            $query->where('payroll_master.id', $periods);
        }

        //extra filter
        if(!empty($extraFilter)){
            $query->whereRaw($extraFilter);
        }

        $query->where('payroll_master.company_id', $companyId)
            ->groupBy(DB::raw("payroll_trx.employee_id"));

        $query->orderBy('users.name','ASC')
              ->skip($page * self::$count_per_page)
              ->take(self::$count_per_page);

        $result= $query->get();

        echo $result;
    }

    public static function getEmployeeListInformationSocsoActiveAndResigned($companyId,$periods,$page){

        //active list
        $queryActive = DB::table('payroll_master')
                ->select(
                    DB::raw('users.id,users.name,employees.ic_no')
                )
                ->leftjoin('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
                ->leftjoin('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
                ->leftjoin('employees', 'employee_jobs.emp_id', 'employees.id')
                ->leftjoin('users', 'employees.user_id', 'users.id')
                ->leftjoin('employee_immigrations', 'employees.id', 'employee_immigrations.emp_id')
                ->whereRaw('employee_jobs.end_date IS NULL')
                ->whereRaw('`payroll_master`.`id` =  '.$periods)
                ->whereRaw('`payroll_master`.`company_id` =  '.$companyId)
                ->groupBy(DB::raw("payroll_trx.employee_id"))
                ->orderBy(DB::raw("employee_jobs.start_date"))->get()->toArray();

        //resign list

        $queryResign = DB::table('payroll_master')
                ->select(
                    DB::raw('users.id,users.name,employees.ic_no')
                )
                ->leftjoin('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
                ->leftjoin('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
                ->leftjoin('employees', 'employee_jobs.emp_id', 'employees.id')
                ->leftjoin('users', 'employees.user_id', 'users.id')
                ->leftjoin('employee_immigrations', 'employees.id', 'employee_immigrations.emp_id')
                ->whereRaw('employee_jobs.end_date IS NOT NULL')
                ->whereRaw('`payroll_master`.`id` =  '.$periods)
                ->whereRaw('`payroll_master`.`company_id` =  '.$companyId)
                ->groupBy(DB::raw("payroll_trx.employee_id"))
                ->orderBy(DB::raw("employee_jobs.start_date"))->get()->toArray();

         return json_encode(array_unique(array_merge($queryActive,$queryResign), SORT_REGULAR));
    }

    public static function getSocsoEmployeeActiveList($companyId,$period,$search){
        $query = DB::table('payroll_master')
            ->select(
                DB::raw('users.id,users.name,employees.ic_no,employee_jobs.start_date as job_start_date'),
                DB::raw('employee_jobs.end_date as job_end_date'),
                DB::raw('sum(payroll_trx.employee_socso) as total_socso')
            )
            ->leftjoin('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
            ->leftjoin('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
            ->leftjoin('employees', 'employee_jobs.emp_id', 'employees.id')
            ->leftjoin('users', 'employees.user_id', 'users.id')
            ->leftjoin('employee_immigrations', 'employees.id', 'employee_immigrations.emp_id')
            ->whereRaw('employee_jobs.end_date IS NULL');

            //search
            if(count($search) > 0){
                foreach($search as $key => $value){
                    $query->whereIn($key, $value);
                }
            }

        $query->whereRaw('`payroll_master`.`id` =  '.$period)
              ->whereRaw('`payroll_master`.`company_id` =  '.$companyId)
              ->groupBy(DB::raw("payroll_trx.employee_id"))
              ->orderBy(DB::raw("employee_jobs.start_date"));

        $result= $query->get();
        return $result;
    }

    public static function getSocsoEmployeeResignList($companyId,$period,$search){
        $query = DB::table('payroll_master')
            ->select(
                DB::raw('users.id,users.name,employees.ic_no,employee_jobs.start_date as job_start_date'),
                DB::raw('employee_jobs.end_date as job_end_date'),
                DB::raw('sum(payroll_trx.employee_socso) as total_socso')
            )
            ->leftjoin('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
            ->leftjoin('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
            ->leftjoin('employees', 'employee_jobs.emp_id', 'employees.id')
            ->leftjoin('users', 'employees.user_id', 'users.id')
            ->leftjoin('employee_immigrations', 'employees.id', 'employee_immigrations.emp_id')
            ->whereRaw('employee_jobs.end_date IS NOT NULL');

            //search
            if(count($search) > 0){
                foreach($search as $key => $value){
                    $query->whereIn($key, $value);
                }
            }

        $query->whereRaw('`payroll_master`.`id` =  '.$period)
              ->whereRaw('`payroll_master`.`company_id` =  '.$companyId)
              ->groupBy(DB::raw("payroll_trx.employee_id"))
              ->orderBy(DB::raw("employee_jobs.start_date"));

        $result= $query->get();
        return $result;
    }

    public static function getEmployeeTotalActiveAndResigned($companyId,$filter,$search,$periods,$year){
        $query = DB::table('payroll_master')
            ->select(
                DB::raw('count(DISTINCT payroll_trx.employee_id) as total_employee'),
                DB::raw('(select count(DISTINCT(emp_id)) from employee_jobs where YEAR(employee_jobs.start_date) = '.$year.') AS total_new_employee'),
                DB::raw('(select count(DISTINCT(emp_id)) from employee_jobs where (employee_jobs.end_date IS NOT NULL OR employee_jobs.end_date != "") and YEAR(employee_jobs.end_date) = '.$year.') AS total_employee_resigned'),
                DB::raw('(select count(DISTINCT(employees.id)) from employees, employee_jobs where employees.id=employee_jobs.emp_id and employees.pcb_group IS NOT NULL) AS total_employee_have_pcb')
            )
            ->leftjoin('payroll_trx', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
            ->leftjoin('employee_jobs', 'payroll_trx.employee_id', '=', 'employee_jobs.emp_id')
            ->leftjoin('employees', 'employee_jobs.emp_id', 'employees.id')
            ->leftjoin('users', 'employees.user_id', 'users.id');

            //filter
            if(!empty($filter)){
                $query->where(array_keys($filter)[0], array_values($filter)[0]);
            }

            //search
            if(count($search) > 0){
                foreach($search as $key => $value){
                    $query->whereIn($key, $value);
                }
            }

            if(!empty($year)){
                $query->whereYear('payroll_master.year_month', $year);
            }

            if(!empty($periods) && $periods != 0){
                $query->where('payroll_master.id', $periods);
            }

        $query->where('payroll_master.company_id', $companyId);

        $result= $query->first(['total_employee,total_new_employee,total_employee_resigned,total_employee_have_pcb']);
       
        return $result;
    }

    public static function getListPayrollYear($companyId){
        return DB::table('payroll_master')
            ->select(
                DB::raw('EXTRACT( YEAR FROM `year_month` ) as year')
            )
            ->where('company_id',$companyId)
            ->groupBy(DB::raw("year"))->get();
    }

    public static function getPayrollMonth($id,$companyId){
        return DB::table('payroll_master')
            ->select(
                DB::raw('EXTRACT( MONTH FROM `year_month` ) as month')
            )
            ->where('id',$id)
            ->where('company_id',$companyId)->value('month');
    }

    public static function getPayrollYearMonth($period,$companyId){
        return DB::table('payroll_master')
            ->select(
                DB::raw('EXTRACT( MONTH FROM `year_month` ) as month'),
                DB::raw('EXTRACT( YEAR FROM `year_month` ) as year')
            )
            ->where('id',$period)
            ->where('company_id',$companyId)->first();
    }


    /**
     * Helper
     */
    public static function getCurrentTwoDigitDate(){
        return date("dmy");
    }

    public static function getCurrentDate(){
        return date("d/m/Y");
    }

    public static function changeTwoDigitDate($date){
        return date_format(date_create($date),"dmy");
    }

    public static function changeMalaysianDate($date){
        return date_format(date_create($date),"d/m/Y");
    }

    private static function malaysianMonth($month){
        switch ($month) {
            case "01":
                return "Januari";
            break;
            case "02":
                return "Februari";
            break;
            case "03":
                return "Mac";
            break;
            case "04":
                return "April";
            break;
            case "05":
                return "Mei";
            break;
            case "06":
                return "Jun";
            break;
            case "07":
                return "Julai";
            break;
            case "08":
                return "Ogos";
            break;
            case "09":
                return "September";
            break;
            case "10":
                return "Oktober";
            break;
            case "11":
                return "November";
            break;
            case "12":
                return "Disember";
            break;
            default:
                return "";
        }
    }

    public static function getMaritalCategory($status){
        if($status == "single"){
            return 1;
        }else{
            return 2;
        }
    }

    public static function getPeriodFromAndUntil($year){
        $data = array();
        if(date("Y") == $year){
            $data['period_from']  = '01/01/2018';
            $data['period_util']  = self::getCurrentDate();
        }else{
            $data['period_from']  = '01/01/'.$year;
            $data['period_util']  = '31/12/'.$year;
        }
        return $data;
    }

    public static function getFilterKey($filter){
        $arr = array();
        if(count($filter) > 0){
            if(array_key_exists('costcentres',$filter)){
                $arr['cost_centre_id'] = $filter['costcentres'];
            }
            if(array_key_exists('departments',$filter)){
                $arr['department_id'] = $filter['departments'];
            }
            if(array_key_exists('branches',$filter)){
                $arr['branch_id'] = $filter['branches'];
            }
            if(array_key_exists('positions',$filter)){
                $arr['emp_mainposition_id'] = $filter['positions'];
            }
        }
        return $arr;
    }

    public static function getSearchKey($search){
        $arr = array();
        if(count($search) > 0){
            if(array_key_exists('searchEmployee',$search)){
                $arr['users.name'] = $search['searchEmployee'];
            }
            if(array_key_exists('employeeList',$search)){
                $arr['users.id'] = $search['employeeList'];
            }
        }
        return $arr;
    }



    /**
     * @return Company Information Object
     * Get company information based on current user logon
     */
    public static function getUserLogonCompanyInformation(){
        $id = Auth::id();
        return User::find($id)->employee->company->where('status', 'Active')->first();
    }

    /**
     * @param $companyId
     * @return Company Information Object
     * Get company information based on given company id or current user logon
     */
    public static function getCompanyInformation($companyId){
        if(empty($companyId)){
            $id = Auth::id();
            //echo $id;
            return User::find($id)->employee->company->where('status', 'Active')->first();
        }else{
            return Company::find($companyId)->where('status', 'Active')->first();
        }
    }


    /**
     * @param $key
     * @param $companyId
     * @return Get Payroll setup value
     * Get payroll setup value based on key
     */
    public static function getPayrollSetupValue($key,$companyId){
        return PayrollSetup::where([
            'key'=>$key,
            'company_id'=>$companyId,
            'status'=>1
        ])->first();
    }
}
