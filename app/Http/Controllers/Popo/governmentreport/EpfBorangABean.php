<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/14/18
 * Time: 5:36 PM
 */

namespace App\Popo\report;


class EpfBorangABean
{
    private $month;
    private $year;
    private $employerReferenceNo;
    private $contributionMonth;
    private $contributionAmount;
    private $referenceNo;
    private $paymentCheck;
    private $paymentCash;

    private $companyName;
    private $companyRegNo;
    private $companyAddress1;
    private $companyAddress2;
    private $companyAddress3;
    private $companyPostcode;
    private $printedDate;
    private $employeeTotal;

    private $employeeKwspNo;
    private $employeeIcNo;
    private $employeeName;
    private $employeeWages;
    private $employerContribution;
    private $employeeContribution;

    private $officerSignature;
    private $officerName;
    private $officerIC;
    private $officerPosition;
    private $officerTelNo;
    private $officerEmail;
    private $date;

    public function __construct(array $array = []) {
        $this->month = isset($array['month']) ? $array['month'] : date("F");
        $this->year = isset($array['year']) ? $array['year'] : date("Y");

        $this->employerReferenceNo = isset($array['employerReferenceNo']) ? $array['employerReferenceNo'] : null;
        $this->contributionMonth = isset($array['contributionMonth']) ? $array['contributionMonth'] : date("my");
        $this->contributionAmount = isset($array['contributionAmount']) ? $array['contributionAmount'] : null;
        $this->referenceNo = isset($array['referenceNo']) ? $array['referenceNo'] : null;
        $this->paymentCheck = isset($array['paymentCheck']) ? $array['paymentCheck'] : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $this->paymentCash = isset($array['paymentCash']) ? $array['paymentCash'] : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

        $this->companyName = isset($array['companyName']) ? $array['companyName'] : null;
        $this->companyRegNo = isset($array['companyRegNo']) ? $array['companyRegNo'] : null;
        $this->companyAddress1 = isset($array['companyAddress1']) ? $array['companyAddress1'] : null;
        $this->companyAddress2 = isset($array['companyAddress2']) ? $array['companyAddress2'] : null;
        $this->companyAddress3 = isset($array['companyAddress3']) ? $array['companyAddress3'] : null;
        $this->companyPostcode = isset($array['companyPostcode']) ? $array['companyPostcode'] : null;
        $this->printedDate = isset($array['printedDate']) ? $array['printedDate'] : date("d/m/Y");
        $this->employeeTotal = isset($array['employeeTotal']) ? $array['employeeTotal'] : null;

        $this->employeeKwspNo = isset($array['employeeKwspNo']) ? $array['employeeKwspNo'] : null;
        $this->employeeIcNo = isset($array['employeeIcNo']) ? $array['employeeIcNo'] : null;
        $this->employeeName = isset($array['employeeName']) ? $array['employeeName'] : null;
        $this->employeeWages = isset($array['employeeWages']) ? $array['employeeWages'] : null;
        $this->employerContribution = isset($array['employerContribution']) ? $array['employerContribution'] : null;
        $this->employeeContribution = isset($array['employeeContribution']) ? $array['employeeContribution'] : null;

        $this->officerSignature = isset($array['officerSignature']) ? $array['officerSignature'] : null;
        $this->officerName = isset($array['officerName']) ? $array['officerName'] : null;
        $this->officerIC = isset($array['officerIC']) ? $array['officerIC'] : null;
        $this->officerPosition = isset($array['officerPosition']) ? $array['officerPosition'] : null;
        $this->officerTelNo = isset($array['officerTelNo']) ? $array['officerTelNo'] : null;
        $this->officerEmail = isset($array['officerEmail']) ? $array['officerEmail'] : null;
        $this->date = isset($array['date']) ? $array['date'] : date("d/m/Y");
    }


    /**
     * @return false|mixed|string
     */
    public function getMonth()
    {
        return strtoupper($this->month);
    }

    /**
     * @param false|mixed|string $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
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
    public function getEmployerReferenceNo()
    {
        return $this->employerReferenceNo;
    }

    /**
     * @param mixed|null $employerReferenceNo
     */
    public function setEmployerReferenceNo( $employerReferenceNo)
    {
        $this->employerReferenceNo = $employerReferenceNo;
    }

    /**
     * @return false|mixed|string
     */
    public function getContributionMonth()
    {
        return $this->contributionMonth;
    }

    /**
     * @param false|mixed|string $contributionMonth
     */
    public function setContributionMonth($contributionMonth)
    {
        $this->contributionMonth = $contributionMonth;
    }

    /**
     * @return mixed|null
     */
    public function getContributionAmount()
    {
        return $this->contributionAmount;
    }

    /**
     * @param mixed|null $contributionAmount
     */
    public function setContributionAmount( $contributionAmount)
    {
        $this->contributionAmount = $contributionAmount;
    }

    /**
     * @return mixed|null
     */
    public function getReferenceNo()
    {
        return $this->referenceNo;
    }

    /**
     * @param mixed|null $referenceNo
     */
    public function setReferenceNo( $referenceNo)
    {
        $this->referenceNo = $referenceNo;
    }

    /**
     * @return mixed
     */
    public function getPaymentCheck()
    {
        return $this->paymentCheck;
    }

    /**
     * @param mixed $paymentCheck
     */
    public function setPaymentCheck($paymentCheck)
    {
        $this->paymentCheck = $paymentCheck;
    }

    /**
     * @return mixed
     */
    public function getPaymentCash()
    {
        return $this->paymentCash;
    }

    /**
     * @param mixed $paymentCash
     */
    public function setPaymentCash($paymentCash)
    {
        $this->paymentCash = $paymentCash;
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
    public function getCompanyRegNo()
    {
        return $this->companyRegNo;
    }

    /**
     * @param mixed|null $companyRegNo
     */
    public function setCompanyRegNo( $companyRegNo)
    {
        $this->companyRegNo = $companyRegNo;
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
    public function getPrintedDate()
    {
        return $this->printedDate;
    }

    /**
     * @param mixed|null $printedDate
     */
    public function setPrintedDate( $printedDate)
    {
        $this->printedDate = $printedDate;
    }

    /**
     * @return mixed|null
     */
    public function getEmployeeTotal()
    {
        return $this->employeeTotal;
    }

    /**
     * @param mixed|null $employeeTotal
     */
    public function setEmployeeTotal( $employeeTotal)
    {
        $this->employeeTotal = $employeeTotal;
    }

    /**
     * @return mixed|null
     */
    public function getEmployeeKwspNo()
    {
        return $this->employeeKwspNo;
    }

    /**
     * @param mixed|null $employeeKwspNo
     */
    public function setEmployeeKwspNo( $employeeKwspNo)
    {
        $this->employeeKwspNo = $employeeKwspNo;
    }

    /**
     * @return mixed|null
     */
    public function getEmployeeIcNo()
    {
        return $this->employeeIcNo;
    }

    /**
     * @param mixed|null $employeeIcNo
     */
    public function setEmployeeIcNo( $employeeIcNo)
    {
        $this->employeeIcNo = $employeeIcNo;
    }

    /**
     * @return mixed|null
     */
    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    /**
     * @param mixed|null $employeeName
     */
    public function setEmployeeName( $employeeName)
    {
        $this->employeeName = $employeeName;
    }

    /**
     * @return mixed|null
     */
    public function getEmployeeWages()
    {
        return $this->employeeWages;
    }

    /**
     * @param mixed|null $employeeWages
     */
    public function setEmployeeWages( $employeeWages)
    {
        $this->employeeWages = $employeeWages;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerContribution()
    {
        return $this->employerContribution;
    }

    /**
     * @param mixed|null $employerContribution
     */
    public function setEmployerContribution( $employerContribution)
    {
        $this->employerContribution = $employerContribution;
    }

    /**
     * @return mixed|null
     */
    public function getEmployeeContribution()
    {
        return $this->employeeContribution;
    }

    /**
     * @param mixed|null $employeeContribution
     */
    public function setEmployeeContribution( $employeeContribution)
    {
        $this->employeeContribution = $employeeContribution;
    }

    /**
     * @return mixed|null
     */
    public function getOfficerSignature()
    {
        return $this->officerSignature;
    }

    /**
     * @param mixed|null $officerSignature
     */
    public function setOfficerSignature( $officerSignature)
    {
        $this->officerSignature = $officerSignature;
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
    public function getOfficerIC()
    {
        return $this->officerIC;
    }

    /**
     * @param mixed|null $officerIC
     */
    public function setOfficerIC( $officerIC)
    {
        $this->officerIC = $officerIC;
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
    public function getOfficerTelNo()
    {
        return $this->officerTelNo;
    }

    /**
     * @param mixed|null $officerTelNo
     */
    public function setOfficerTelNo( $officerTelNo)
    {
        $this->officerTelNo = $officerTelNo;
    }

    /**
     * @return mixed|null
     */
    public function getOfficerEmail()
    {
        return $this->officerEmail;
    }

    /**
     * @param mixed|null $officerEmail
     */
    public function setOfficerEmail( $officerEmail)
    {
        $this->officerEmail = $officerEmail;
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

    public function toArray() {
        return [
            'month'=> $this->month,
            'year'=> $this->year,

            'employerReferenceNo' => $this->employerReferenceNo,
            'contributionMonth' => $this->contributionMonth,
            'contributionAmount' => $this->contributionAmount,
            'referenceNo' => $this->referenceNo,
            'paymentCheck' => $this->paymentCheck,
            'paymentCash' => $this->paymentCash,

            'companyName' => $this->companyName,
            'companyRegNo' => $this->companyRegNo,
            'companyAddress1' => $this->companyAddress1,
            'companyAddress2' => $this->companyAddress2,
            'companyAddress3' => $this->companyAddress3,
            'companyPostcode' => $this->companyPostcode,
            'printedDate' => $this->printedDate,
            'employeeTotal' => $this->employeeTotal,

            'employeeKwspNo' => $this->employeeKwspNo,
            'employeeIcNo' => $this->employeeIcNo,
            'employeeName' => $this->employeeName,
            'employeeWages' => $this->employeeWages,
            'employerContribution' => $this->employerContribution,
            'employeeContribution' => $this->employeeContribution,

            'officerSignature' => $this->officerSignature,
            'officerName' => $this->officerName,
            'officerIC' => $this->officerIC,
            'officerPosition' => $this->officerPosition,
            'officerTelNo' => $this->officerTelNo,
            'officerEmail' => $this->officerEmail,
            'date' => $this->date,
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

}
