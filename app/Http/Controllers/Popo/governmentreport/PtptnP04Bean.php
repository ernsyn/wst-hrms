<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/12/18
 * Time: 11:04 AM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class PtptnP04Bean
{
    private $month;
    private $year;
    private $employerReferenceNo;
    private $companyName;
    private $companyAddress1;
    private $companyAddress2;
    private $companyAddress3;
    private $companyPostcode;
    private $companyBusinessRegistrationNo;

    private $officerName;
    private $officerPosition;
    private $officerNoTel;
    private $officerEmail;

    private $transferDate;
    private $transferReferenceNo;
    private $transferAmount;
    private $checkNo;
    private $bankProduceCheck;
    private $checkDate;
    private $checkAmount;
    private $checkPostDateToPTPTN;
    private $checkDepositDate;

    private $staffIcNo;
    private $staffName;
    private $amount;
    private $staffNo;
    private $totalAmount;

    public function __construct(array $array = []) {
        $this->month = isset($array['month']) ? $array['month'] : date("F");
        $this->year = isset($array['year']) ? $array['year'] : date("Y");
        $this->employerReferenceNo = isset($array['employerReferenceNo']) ? $array['employerReferenceNo'] : null;
        $this->companyName = isset($array['companyName']) ? $array['companyName'] : null;
        $this->companyAddress1 = isset($array['companyAddress1']) ? $array['companyAddress1'] : null;
        $this->companyAddress2 = isset($array['companyAddress2']) ? $array['companyAddress2'] : null;
        $this->companyAddress3 = isset($array['companyAddress3']) ? $array['companyAddress3'] : null;
        $this->companyPostcode = isset($array['companyPostcode']) ? $array['companyPostcode'] : null;
        $this->companyBusinessRegistrationNo = isset($array['companyBusinessRegistrationNo']) ? $array['companyBusinessRegistrationNo'] : null;

        $this->officerName = isset($array['officerName']) ? $array['officerName'] : null;
        $this->officerPosition = isset($array['officerPosition']) ? $array['officerPosition'] : null;
        $this->officerNoTel = isset($array['officerNoTel']) ? $array['officerNoTel'] : null;
        $this->officerEmail = isset($array['officerEmail']) ? $array['officerEmail'] : null;

        $this->transferDate = isset($array['transferDate']) ? $array['transferDate'] : null;
        $this->transferReferenceNo = isset($array['transferReferenceNo']) ? $array['transferReferenceNo'] : null;
        $this->transferAmount = isset($array['transferAmount']) ? $array['transferAmount'] : null;
        $this->checkNo = isset($array['checkNo']) ? $array['checkNo'] : null;
        $this->bankProduceCheck = isset($array['bankProduceCheck']) ? $array['bankProduceCheck'] : null;
        $this->checkDate = isset($array['checkDate']) ? $array['checkDate'] : date("d/m/Y");
        $this->checkAmount = isset($array['checkAmount']) ? $array['checkAmount'] : null;
        $this->checkPostDateToPTPTN = isset($array['checkPostDateToPTPTN']) ? $array['checkPostDateToPTPTN'] : null;
        $this->checkDepositDate = isset($array['checkDepositDate']) ? $array['checkDepositDate'] : null;

        $this->staffIcNo = isset($array['staffIcNo']) ? $array['staffIcNo'] : null;
        $this->staffName = isset($array['staffName']) ? $array['staffName'] : null;
        $this->amount = isset($array['amount']) ? $array['amount'] : null;
        $this->staffNo = isset($array['staffNo']) ? $array['staffNo'] : null;
        $this->totalAmount = isset($array['totalAmount']) ? $array['totalAmount'] : null;
    }


    /**
     * @return false|mixed|string
     */
    public function getMonth()
    {
        return $this->month;
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
    public function getCompanyBusinessRegistrationNo()
    {
        return $this->companyBusinessRegistrationNo;
    }

    /**
     * @param mixed|null $companyBusinessRegistrationNo
     */
    public function setCompanyBusinessRegistrationNo( $companyBusinessRegistrationNo)
    {
        $this->companyBusinessRegistrationNo = $companyBusinessRegistrationNo;
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
    public function getOfficerNoTel()
    {
        return $this->officerNoTel;
    }

    /**
     * @param mixed|null $officerNoTel
     */
    public function setOfficerNoTel( $officerNoTel)
    {
        $this->officerNoTel = $officerNoTel;
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
    public function getTransferDate()
    {
        return $this->transferDate;
    }

    /**
     * @param mixed|null $transferDate
     */
    public function setTransferDate( $transferDate)
    {
        $this->transferDate = $transferDate;
    }

    /**
     * @return mixed|null
     */
    public function getTransferReferenceNo()
    {
        return $this->transferReferenceNo;
    }

    /**
     * @param mixed|null $transferReferenceNo
     */
    public function setTransferReferenceNo( $transferReferenceNo)
    {
        $this->transferReferenceNo = $transferReferenceNo;
    }

    /**
     * @return mixed|null
     */
    public function getTransferAmount()
    {
        return $this->transferAmount;
    }

    /**
     * @param mixed|null $transferAmount
     */
    public function setTransferAmount( $transferAmount)
    {
        $this->transferAmount = $transferAmount;
    }

    /**
     * @return mixed|null
     */
    public function getCheckNo()
    {
        return $this->checkNo;
    }

    /**
     * @param mixed|null $checkNo
     */
    public function setCheckNo( $checkNo)
    {
        $this->checkNo = $checkNo;
    }

    /**
     * @return mixed|null
     */
    public function getBankProduceCheck()
    {
        return $this->bankProduceCheck;
    }

    /**
     * @param mixed|null $bankProduceCheck
     */
    public function setBankProduceCheck( $bankProduceCheck)
    {
        $this->bankProduceCheck = $bankProduceCheck;
    }

    /**
     * @return mixed|null
     */
    public function getCheckDate()
    {
        return $this->checkDate;
    }

    /**
     * @param mixed|null $checkDate
     */
    public function setCheckDate( $checkDate)
    {
        $this->checkDate = $checkDate;
    }

    /**
     * @return mixed|null
     */
    public function getCheckAmount()
    {
        return $this->checkAmount;
    }

    /**
     * @param mixed|null $checkAmount
     */
    public function setCheckAmount( $checkAmount)
    {
        $this->checkAmount = $checkAmount;
    }

    /**
     * @return mixed|null
     */
    public function getCheckPostDateToPTPTN()
    {
        return $this->checkPostDateToPTPTN;
    }

    /**
     * @param mixed|null $checkPostDateToPTPTN
     */
    public function setCheckPostDateToPTPTN( $checkPostDateToPTPTN)
    {
        $this->checkPostDateToPTPTN = $checkPostDateToPTPTN;
    }

    /**
     * @return mixed|null
     */
    public function getCheckDepositDate()
    {
        return $this->checkDepositDate;
    }

    /**
     * @param mixed|null $checkDepositDate
     */
    public function setCheckDepositDate( $checkDepositDate)
    {
        $this->checkDepositDate = $checkDepositDate;
    }

    /**
     * @return mixed|null
     */
    public function getStaffIcNo()
    {
        return $this->staffIcNo;
    }

    /**
     * @param mixed|null $staffIcNo
     */
    public function setStaffIcNo( $staffIcNo)
    {
        $this->staffIcNo = $staffIcNo;
    }

    /**
     * @return mixed|null
     */
    public function getStaffName()
    {
        return $this->staffName;
    }

    /**
     * @param mixed|null $staffName
     */
    public function setStaffName( $staffName)
    {
        $this->staffName = $staffName;
    }

    /**
     * @return mixed|null
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed|null $amount
     */
    public function setAmount( $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed|null
     */
    public function getStaffNo()
    {
        return $this->staffNo;
    }

    /**
     * @param mixed|null $staffNo
     */
    public function setStaffNo( $staffNo)
    {
        $this->staffNo = $staffNo;
    }

    public function toArray() {
        return [
            'month' => $this->month,
            'year' => $this->year,
            'employerReferenceNo' => $this->employerReferenceNo,
            'companyName' => $this->companyName,
            'companyAddress1' => $this->companyAddress1,
            'companyAddress2' => $this->companyAddress2,
            'companyAddress3' => $this->companyAddress3,
            'companyPostcode' => $this->companyPostcode,
            'companyBusinessRegistrationNo' => $this->companyBusinessRegistrationNo,

            'officerName' => $this->officerName,
            'officerPosition' => $this->officerPosition,
            'officerNoTel' => $this->officerNoTel,
            'officerEmail' => $this->officerEmail,

            'transferDate' => $this->transferDate,
            'transferReferenceNo' => $this->transferReferenceNo,
            'transferAmount' => $this->transferAmount,
            'checkNo' => $this->checkNo,
            'bankProduceCheck' => $this->bankProduceCheck,
            'checkDate' => $this->checkDate,
            'checkAmount' => $this->checkAmount,
            'checkPostDateToPTPTN' => $this->checkPostDateToPTPTN,
            'checkDepositDate' => $this->checkDepositDate,

            'staffIcNo' => $this->staffIcNo,
            'staffName' => $this->staffName,
            'amount' => $this->amount,
            'staffNo' => $this->staffNo,
            'totalAmount' => $this->totalAmount
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
}
