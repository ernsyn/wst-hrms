<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/11/18
 * Time: 12:24 PM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class LhdnEAFormBean
{
    private $serialNo;
    private $incomeTaxNo;
    private $employerNoE;
    private $year;
    private $lhdnmBranch;
    private $name;
    private $jobPosition;
    private $salaryNo;
    private $icNo;
    private $passportNo;
    private $kwspNo;
    private $perkesoNo;
    private $childNoforTax;
    private $startDateLessOneYear;
    private $endDateLessOneYear;
    private $netSalary;
    private $commission;
    private $tip;
    private $employerIncomeTax;
    private $esos;
    private $reward;
    private $benefitsOfMerchandise;
    private $residenceValue;
    private $failedRefund;
    private $lostJobReparation;

    private $pension;
    private $annuity;
    private $total;

    private $pcb;
    private $deductionsInstructionsCP38;
    private $zakatPaidThroughSalaryDeductions;
    private $tp1Release;
    private $tp1Zakat;
    private $totalDisbursementForEligibleChildren;

    private $nameOfFund;
    private $amountOfContribution;
    private $amountOfContributionPerkeso;
    private $totalAllowance;

    private $date;
    private $officerName;
    private $officerPosition;
    private $companyName;
    private $companyAddress1;
    private $companyAddress2;
    private $companyAddress3;
    private $companyPostcode;
    private $companyNoTel;

    public function __construct(array $array = []) {
        $this->serialNo = isset($array['serialNo']) ? $array['serialNo'] : null;
        $this->incomeTaxNo = isset($array['incomeTaxNo']) ? $array['incomeTaxNo'] : null;
        $this->employerNoE = isset($array['employerNoE']) ? $array['employerNoE'] : null;
        $this->year = isset($array['year']) ? $array['year'] : date("Y");
        $this->lhdnmBranch = isset($array['lhdnmBranch']) ? $array['lhdnmBranch'] : null;
        $this->name = isset($array['name']) ? $array['name'] : null;
        $this->jobPosition = isset($array['jobPosition']) ? $array['jobPosition'] : null;
        $this->salaryNo = isset($array['salaryNo']) ? $array['salaryNo'] : null;
        $this->icNo = isset($array['icNo']) ? $array['icNo'] : null;
        $this->passportNo = isset($array['passportNo']) ? $array['passportNo'] : null;
        $this->kwspNo = isset($array['kwspNo']) ? $array['kwspNo'] : null;
        $this->perkesoNo = isset($array['perkesoNo']) ? $array['perkesoNo'] : null;
        $this->childNoforTax = isset($array['childNoforTax']) ? $array['childNoforTax'] : null;
        $this->startDateLessOneYear = isset($array['startDateLessOneYear']) ? $array['startDateLessOneYear'] : null;
        $this->endDateLessOneYear = isset($array['endDateLessOneYear']) ? $array['endDateLessOneYear'] : null;
        $this->netSalary = isset($array['netSalary']) ? $array['netSalary'] : null;
        $this->commission = isset($array['commission']) ? $array['commission'] : null;
        $this->tip = isset($array['tip']) ? $array['tip'] : null;
        $this->employerIncomeTax = isset($array['employerIncomeTax']) ? $array['employerIncomeTax'] : null;
        $this->esos = isset($array['esos']) ? $array['esos'] : null;
        $this->reward = isset($array['reward']) ? $array['reward'] : null;
        $this->benefitsOfMerchandise = isset($array['benefitsOfMerchandise']) ? $array['benefitsOfMerchandise'] : null;
        $this->residenceValue = isset($array['residenceValue']) ? $array['residenceValue'] : null;
        $this->failedRefund = isset($array['failedRefund']) ? $array['failedRefund'] : null;
        $this->lostJobReparation = isset($array['lostJobReparation']) ? $array['lostJobReparation'] : null;

        $this->pension = isset($array['pension']) ? $array['pension'] : null;
        $this->annuity = isset($array['annuity']) ? $array['annuity'] : null;
        $this->total = isset($array['total']) ? $array['total'] : null;

        $this->pcb = isset($array['pcb']) ? $array['pcb'] : null;
        $this->deductionsInstructionsCP38 = isset($array['deductionsInstructionsCP38']) ? $array['deductionsInstructionsCP38'] : null;
        $this->zakatPaidThroughSalaryDeductions = isset($array['zakatPaidThroughSalaryDeductions']) ? $array['zakatPaidThroughSalaryDeductions'] : null;
        $this->tp1Release = isset($array['tp1Release']) ? $array['tp1Release'] : null;
        $this->tp1Zakat = isset($array['tp1Zakat']) ? $array['tp1Zakat'] : null;
        $this->totalDisbursementForEligibleChildren = isset($array['totalDisbursementForEligibleChildren']) ? $array['totalDisbursementForEligibleChildren'] : null;

        $this->nameOfFund = isset($array['nameOfFund']) ? $array['nameOfFund'] : null;
        $this->amountOfContribution = isset($array['amountOfContribution']) ? $array['amountOfContribution'] : null;
        $this->amountOfContributionPerkeso = isset($array['amountOfContributionPerkeso']) ? $array['amountOfContributionPerkeso'] : null;
        $this->totalAllowance = isset($array['totalAllowance']) ? $array['totalAllowance'] : null;

        $this->date = isset($array['date']) ? $array['date'] : null;
        $this->officerName = isset($array['officerName']) ? $array['officerName'] : null;
        $this->officerPosition = isset($array['officerPosition']) ? $array['officerPosition'] : null;
        $this->companyName = isset($array['companyName']) ? $array['companyName'] : null;
        $this->companyAddress1 = isset($array['companyAddress1']) ? $array['companyAddress1'] : null;
        $this->companyAddress2 = isset($array['companyAddress2']) ? $array['companyAddress2'] : null;
        $this->companyAddress3 = isset($array['companyAddress3']) ? $array['companyAddress3'] : null;
        $this->companyPostcode = isset($array['companyPostcode']) ? $array['companyPostcode'] : null;
        $this->companyNoTel = isset($array['companyNoTel']) ? $array['companyNoTel'] : null;
    }

    /**
     * @return mixed|null
     */
    public function getSerialNo()
    {
        return $this->serialNo;
    }

    /**
     * @param mixed|null $serialNo
     */
    public function setSerialNo( $serialNo)
    {
        $this->serialNo = $serialNo;
    }

    /**
     * @return mixed|null
     */
    public function getIncomeTaxNo()
    {
        return $this->incomeTaxNo;
    }

    /**
     * @param mixed|null $incomeTaxNo
     */
    public function setIncomeTaxNo( $incomeTaxNo)
    {
        $this->incomeTaxNo = $incomeTaxNo;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerNoE()
    {
        return $this->employerNoE;
    }

    /**
     * @param mixed|null $employerNoE
     */
    public function setEmployerNoE( $employerNoE)
    {
        $this->employerNoE = $employerNoE;
    }

    /**
     * @return false|mixed|string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param false|mixed|string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed|null
     */
    public function getLhdnmBranch()
    {
        return $this->lhdnmBranch;
    }

    /**
     * @param mixed|null $lhdnmBranch
     */
    public function setLhdnmBranch( $lhdnmBranch)
    {
        $this->lhdnmBranch = $lhdnmBranch;
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed|null $name
     */
    public function setName( $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed|null
     */
    public function getJobPosition()
    {
        return $this->jobPosition;
    }

    /**
     * @param mixed|null $jobPosition
     */
    public function setJobPosition( $jobPosition)
    {
        $this->jobPosition = $jobPosition;
    }

    /**
     * @return mixed|null
     */
    public function getSalaryNo()
    {
        return $this->salaryNo;
    }

    /**
     * @param mixed|null $salaryNo
     */
    public function setSalaryNo( $salaryNo)
    {
        $this->salaryNo = $salaryNo;
    }

    /**
     * @return mixed|null
     */
    public function getIcNo()
    {
        return $this->icNo;
    }

    /**
     * @param mixed|null $icNo
     */
    public function setIcNo( $icNo)
    {
        $this->icNo = $icNo;
    }

    /**
     * @return mixed|null
     */
    public function getPassportNo()
    {
        return $this->passportNo;
    }

    /**
     * @param mixed|null $passportNo
     */
    public function setPassportNo( $passportNo)
    {
        $this->passportNo = $passportNo;
    }

    /**
     * @return mixed|null
     */
    public function getKwspNo()
    {
        return $this->kwspNo;
    }

    /**
     * @param mixed|null $kwspNo
     */
    public function setKwspNo( $kwspNo)
    {
        $this->kwspNo = $kwspNo;
    }

    /**
     * @return mixed|null
     */
    public function getPerkesoNo()
    {
        return $this->perkesoNo;
    }

    /**
     * @param mixed|null $perkesoNo
     */
    public function setPerkesoNo( $perkesoNo)
    {
        $this->perkesoNo = $perkesoNo;
    }

    /**
     * @return mixed|null
     */
    public function getChildNoforTax()
    {
        return $this->childNoforTax;
    }

    /**
     * @param mixed|null $childNoforTax
     */
    public function setChildNoforTax( $childNoforTax)
    {
        $this->childNoforTax = $childNoforTax;
    }

    /**
     * @return mixed|null
     */
    public function getStartDateLessOneYear()
    {
        return $this->startDateLessOneYear;
    }

    /**
     * @param mixed|null $startDateLessOneYear
     */
    public function setStartDateLessOneYear( $startDateLessOneYear)
    {
        $this->startDateLessOneYear = $startDateLessOneYear;
    }

    /**
     * @return mixed|null
     */
    public function getEndDateLessOneYear()
    {
        return $this->endDateLessOneYear;
    }

    /**
     * @param mixed|null $endDateLessOneYear
     */
    public function setEndDateLessOneYear( $endDateLessOneYear)
    {
        $this->endDateLessOneYear = $endDateLessOneYear;
    }

    /**
     * @return mixed|null
     */
    public function getNetSalary()
    {
        return $this->netSalary;
    }

    /**
     * @param mixed|null $netSalary
     */
    public function setNetSalary( $netSalary)
    {
        $this->netSalary = $netSalary;
    }

    /**
     * @return mixed|null
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * @param mixed|null $commission
     */
    public function setCommission( $commission)
    {
        $this->commission = $commission;
    }

    /**
     * @return mixed|null
     */
    public function getTip()
    {
        return $this->tip;
    }

    /**
     * @param mixed|null $tip
     */
    public function setTip( $tip)
    {
        $this->tip = $tip;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerIncomeTax()
    {
        return $this->employerIncomeTax;
    }

    /**
     * @param mixed|null $employerIncomeTax
     */
    public function setEmployerIncomeTax( $employerIncomeTax)
    {
        $this->employerIncomeTax = $employerIncomeTax;
    }

    /**
     * @return mixed|null
     */
    public function getEsos()
    {
        return $this->esos;
    }

    /**
     * @param mixed|null $esos
     */
    public function setEsos( $esos)
    {
        $this->esos = $esos;
    }

    /**
     * @return mixed|null
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * @param mixed|null $reward
     */
    public function setReward( $reward)
    {
        $this->reward = $reward;
    }

    /**
     * @return mixed|null
     */
    public function getBenefitsOfMerchandise()
    {
        return $this->benefitsOfMerchandise;
    }

    /**
     * @param mixed|null $benefitsOfMerchandise
     */
    public function setBenefitsOfMerchandise( $benefitsOfMerchandise)
    {
        $this->benefitsOfMerchandise = $benefitsOfMerchandise;
    }

    /**
     * @return mixed|null
     */
    public function getResidenceValue()
    {
        return $this->residenceValue;
    }

    /**
     * @param mixed|null $residenceValue
     */
    public function setResidenceValue( $residenceValue)
    {
        $this->residenceValue = $residenceValue;
    }

    /**
     * @return mixed|null
     */
    public function getFailedRefund()
    {
        return $this->failedRefund;
    }

    /**
     * @param mixed|null $failedRefund
     */
    public function setFailedRefund( $failedRefund)
    {
        $this->failedRefund = $failedRefund;
    }

    /**
     * @return mixed|null
     */
    public function getLostJobReparation()
    {
        return $this->lostJobReparation;
    }

    /**
     * @param mixed|null $lostJobReparation
     */
    public function setLostJobReparation( $lostJobReparation)
    {
        $this->lostJobReparation = $lostJobReparation;
    }

    /**
     * @return mixed|null
     */
    public function getPension()
    {
        return $this->pension;
    }

    /**
     * @param mixed|null $pension
     */
    public function setPension( $pension)
    {
        $this->pension = $pension;
    }

    /**
     * @return mixed|null
     */
    public function getAnnuity()
    {
        return $this->annuity;
    }

    /**
     * @param mixed|null $annuity
     */
    public function setAnnuity( $annuity)
    {
        $this->annuity = $annuity;
    }

    /**
     * @return mixed|null
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed|null $total
     */
    public function setTotal( $total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed|null
     */
    public function getPcb()
    {
        return $this->pcb;
    }

    /**
     * @param mixed|null $pcb
     */
    public function setPcb( $pcb)
    {
        $this->pcb = $pcb;
    }

    /**
     * @return mixed|null
     */
    public function getDeductionsInstructionsCP38()
    {
        return $this->deductionsInstructionsCP38;
    }

    /**
     * @param mixed|null $deductionsInstructionsCP38
     */
    public function setDeductionsInstructionsCP38( $deductionsInstructionsCP38)
    {
        $this->deductionsInstructionsCP38 = $deductionsInstructionsCP38;
    }

    /**
     * @return mixed|null
     */
    public function getZakatPaidThroughSalaryDeductions()
    {
        return $this->zakatPaidThroughSalaryDeductions;
    }

    /**
     * @param mixed|null $zakatPaidThroughSalaryDeductions
     */
    public function setZakatPaidThroughSalaryDeductions( $zakatPaidThroughSalaryDeductions)
    {
        $this->zakatPaidThroughSalaryDeductions = $zakatPaidThroughSalaryDeductions;
    }

    /**
     * @return mixed|null
     */
    public function getTp1Release()
    {
        return $this->tp1Release;
    }

    /**
     * @param mixed|null $tp1Release
     */
    public function setTp1Release( $tp1Release)
    {
        $this->tp1Release = $tp1Release;
    }

    /**
     * @return mixed|null
     */
    public function getTp1Zakat()
    {
        return $this->tp1Zakat;
    }

    /**
     * @param mixed|null $tp1Zakat
     */
    public function setTp1Zakat( $tp1Zakat)
    {
        $this->tp1Zakat = $tp1Zakat;
    }

    /**
     * @return mixed|null
     */
    public function getTotalDisbursementForEligibleChildren()
    {
        return $this->totalDisbursementForEligibleChildren;
    }

    /**
     * @param mixed|null $totalDisbursementForEligibleChildren
     */
    public function setTotalDisbursementForEligibleChildren( $totalDisbursementForEligibleChildren)
    {
        $this->totalDisbursementForEligibleChildren = $totalDisbursementForEligibleChildren;
    }

    /**
     * @return mixed|null
     */
    public function getNameOfFund()
    {
        return $this->nameOfFund;
    }

    /**
     * @param mixed|null $nameOfFund
     */
    public function setNameOfFund( $nameOfFund)
    {
        $this->nameOfFund = $nameOfFund;
    }

    /**
     * @return mixed|null
     */
    public function getAmountOfContribution()
    {
        return $this->amountOfContribution;
    }

    /**
     * @param mixed|null $amountOfContribution
     */
    public function setAmountOfContribution( $amountOfContribution)
    {
        $this->amountOfContribution = $amountOfContribution;
    }

    /**
     * @return mixed|null
     */
    public function getAmountOfContributionPerkeso()
    {
        return $this->amountOfContributionPerkeso;
    }

    /**
     * @param mixed|null $amountOfContributionPerkeso
     */
    public function setAmountOfContributionPerkeso( $amountOfContributionPerkeso)
    {
        $this->amountOfContributionPerkeso = $amountOfContributionPerkeso;
    }

    /**
     * @return mixed|null
     */
    public function getTotalAllowance()
    {
        return $this->totalAllowance;
    }

    /**
     * @param mixed|null $totalAllowance
     */
    public function setTotalAllowance( $totalAllowance)
    {
        $this->totalAllowance = $totalAllowance;
    }

    /**
     * @return mixed|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed|null $date
     */
    public function setDate( $date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed|null
     */
    public function getOfficerName()
    {
        return $this->officerName;
    }

    /**
     * @param mixed|null $officerName
     */
    public function setOfficerName( $officerName)
    {
        $this->officerName = $officerName;
    }

    /**
     * @return mixed|null
     */
    public function getOfficerPosition()
    {
        return $this->officerPosition;
    }

    /**
     * @param mixed|null $officerPosition
     */
    public function setOfficerPosition( $officerPosition)
    {
        $this->officerPosition = $officerPosition;
    }

    /**
     * @return mixed|null
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed|null $companyName
     */
    public function setCompanyName( $companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed|null
     */
    public function getCompanyAddress1()
    {
        return $this->companyAddress1;
    }

    /**
     * @param mixed|null $companyAddress1
     */
    public function setCompanyAddress1( $companyAddress1)
    {
        $this->companyAddress1 = $companyAddress1;
    }

    /**
     * @return mixed|null
     */
    public function getCompanyAddress2()
    {
        return $this->companyAddress2;
    }

    /**
     * @param mixed|null $companyAddress2
     */
    public function setCompanyAddress2( $companyAddress2)
    {
        $this->companyAddress2 = $companyAddress2;
    }

    /**
     * @return mixed|null
     */
    public function getCompanyAddress3()
    {
        return $this->companyAddress3;
    }

    /**
     * @param mixed|null $companyAddress3
     */
    public function setCompanyAddress3( $companyAddress3)
    {
        $this->companyAddress3 = $companyAddress3;
    }

    /**
     * @return mixed|null
     */
    public function getCompanyPostcode()
    {
        return $this->companyPostcode;
    }

    /**
     * @param mixed|null $companyPostcode
     */
    public function setCompanyPostcode( $companyPostcode)
    {
        $this->companyPostcode = $companyPostcode;
    }

    /**
     * @return mixed|null
     */
    public function getCompanyNoTel()
    {
        return $this->companyNoTel;
    }

    /**
     * @param mixed|null $companyNoTel
     */
    public function setCompanyNoTel( $companyNoTel)
    {
        $this->companyNoTel = $companyNoTel;
    }

    public function toArray() {
        return [
            'serialNo' => $this->serialNo,
            'incomeTaxNo' => $this->incomeTaxNo,
            'employerNoE' => $this->employerNoE,
            'year' => $this->year,
            'lhdnmBranch' => $this->lhdnmBranch,
            'name' => $this->name,
            'jobPosition' => $this->jobPosition,
            'salaryNo' => $this->salaryNo,
            'icNo' => $this->icNo,
            'passportNo' => $this->passportNo,
            'kwspNo' => $this->kwspNo,
            'perkesoNo' => $this->perkesoNo,
            'childNoforTax' => $this->childNoforTax,
            'startDateLessOneYear' => $this->startDateLessOneYear,
            'endDateLessOneYear' => $this->endDateLessOneYear,
            'netSalary' => $this->netSalary,
            'commission' => $this->commission,
            'tip' => $this->tip,
            'employerIncomeTax' => $this->employerIncomeTax,
            'esos' => $this->esos,
            'reward' => $this->reward,
            'benefitsOfMerchandise' => $this->benefitsOfMerchandise,
            'residenceValue' => $this->residenceValue,
            'failedRefund' => $this->failedRefund,
            'lostJobReparation' => $this->lostJobReparation,

            'pension' => $this->pension,
            'annuity' => $this->annuity,
            'total' => $this->total,

            'pcb' => $this->pcb,
            'deductionsInstructionsCP38' => $this->deductionsInstructionsCP38,
            'zakatPaidThroughSalaryDeductions' => $this->zakatPaidThroughSalaryDeductions,
            'tp1Release' => $this->tp1Release,
            'tp1Zakat' => $this->tp1Zakat,
            'totalDisbursementForEligibleChildren' => $this->totalDisbursementForEligibleChildren,

            'nameOfFund' => $this->nameOfFund,
            'amountOfContribution' => $this->amountOfContribution,
            'amountOfContributionPerkeso' => $this->amountOfContributionPerkeso,
            'totalAllowance' => $this->totalAllowance,

            'date' => $this->date,
            'officerName' => $this->officerName,
            'officerPosition' => $this->officerPosition,
            'companyName' => $this->companyName,
            'companyAddress1' => $this->companyAddress1,
            'companyAddress2' => $this->companyAddress2,
            'companyAddress3' => $this->companyAddress3,
            'companyPostcode' => $this->companyPostcode,
            'companyNoTel' => $this->companyNoTel
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
}
