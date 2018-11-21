<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/12/18
 * Time: 3:59 PM
 */

namespace App\Popo\report;


class EpfBBCDBean
{
    private $month;
    private $year;
    private $employerReferenceNo;
    private $contributionMonth;
    private $contributionAmount;

    private $paymentCash;
    private $paymentCheck;

    private $companyName;
    private $companyRegistrationNo;
    private $companyAddress1;
    private $companyAddress2;
    private $companyAddress3;
    private $companyPostcode;

    private $officerSignature;
    private $officerName;
    private $officerICNo;
    private $officerPosition;
    private $officerTelNo;

    public function __construct(array $array = []) {
        $this->month = isset($array['month']) ? $array['month'] : date("F");
        $this->year = isset($array['year']) ? $array['year'] : date("Y");

        $this->employerReferenceNo = isset($array['employerReferenceNo']) ? $array['employerReferenceNo'] : null;
        $this->contributionMonth = isset($array['contributionMonth']) ? $array['contributionMonth'] : date("my");
        $this->contributionAmount = isset($array['contributionAmount']) ? $array['contributionAmount'] : null;

        $this->paymentCash = isset($array['paymentCash']) ? $array['paymentCash'] : null;
        $this->paymentCheck = isset($array['paymentCheck']) ? $array['paymentCheck'] : null;

        $this->companyName = isset($array['companyName']) ? $array['companyName'] : null;
        $this->companyRegistrationNo = isset($array['companyRegistrationNo']) ? $array['companyRegistrationNo'] : null;
        $this->companyAddress1 = isset($array['companyAddress1']) ? $array['companyAddress1'] : null;
        $this->companyAddress2 = isset($array['companyAddress2']) ? $array['companyAddress2'] : null;
        $this->companyAddress3 = isset($array['companyAddress3']) ? $array['companyAddress3'] : null;
        $this->companyPostcode = isset($array['companyPostcode']) ? $array['companyPostcode'] : null;

        $this->officerSignature = isset($array['officerSignature']) ? $array['officerSignature'] : null;
        $this->officerName = isset($array['officerName']) ? $array['officerName'] : null;
        $this->officerICNo = isset($array['officerICNo']) ? $array['officerICNo'] : null;
        $this->officerPosition = isset($array['officerPosition']) ? $array['officerPosition'] : null;
        $this->officerTelNo = isset($array['officerTelNo']) ? $array['officerTelNo'] : null;
    }

    /**
     * @return mixed|null
     */
    public function getMonth()
    {
        return strtoupper($this->month);
    }

    /**
     * @param mixed|null $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return mixed|null
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed|null $year
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
    public function getPaymentCash()
    {
        return $this->paymentCash;
    }

    /**
     * @param mixed|null $paymentCash
     */
    public function setPaymentCash( $paymentCash)
    {
        $this->paymentCash = $paymentCash;
    }

    /**
     * @return mixed|null
     */
    public function getPaymentCheck()
    {
        return $this->paymentCheck;
    }

    /**
     * @param mixed|null $paymentCheck
     */
    public function setPaymentCheck( $paymentCheck)
    {
        $this->paymentCheck = $paymentCheck;
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
    public function getCompanyRegistrationNo()
    {
        return $this->companyRegistrationNo;
    }

    /**
     * @param mixed|null $companyRegistrationNo
     */
    public function setCompanyRegistrationNo( $companyRegistrationNo)
    {
        $this->companyRegistrationNo = $companyRegistrationNo;
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
    public function getOfficerICNo()
    {
        return $this->officerICNo;
    }

    /**
     * @param mixed|null $officerICNo
     */
    public function setOfficerICNo( $officerICNo)
    {
        $this->officerICNo = $officerICNo;
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

    public function toArray() {
        return [
            'month'=> $this->month,
            'year'=> $this->year,

            'employerReferenceNo' => $this->employerReferenceNo,
            'contributionMonth' => $this->contributionMonth,
            'contributionAmount' => $this->contributionAmount,

            'paymentCash' => $this->paymentCash,
            'paymentCheck' => $this->paymentCheck,

            'companyName' => $this->companyName,
            'companyRegistrationNo' => $this->companyRegistrationNo,
            'companyAddress1' => $this->companyAddress1,
            'companyAddress2' => $this->companyAddress2,
            'companyAddress3' => $this->companyAddress3,
            'companyPostcode' => $this->companyPostcode,

            'officerSignature' => $this->officerSignature,
            'officerName' => $this->officerName,
            'officerICNo' => $this->officerICNo,
            'officerPosition' => $this->officerPosition,
            'officerTelNo' => $this->officerTelNo,
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
}
