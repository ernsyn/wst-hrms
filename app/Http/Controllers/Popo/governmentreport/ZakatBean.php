<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 12/13/18
 * Time: 12:29 PM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class ZakatBean
{

    private $companyName;
    private $companyAddress1;
    private $companyAddress2;
    private $companyAddress3;
    private $companyPostcode;
    private $companyBusinessRegistrationNo;

    private $employerCodeNo;
    private $month;
    private $bankName;
    private $checkNo;
    private $totalAmount;

    private $employeeOldIcNo;
    private $employeeNewIcNo;
    private $employeeName;
    private $employeeAmount;
    private $zakatType;

    private $officerName;
    private $officerIcNo;
    private $officerPosition;
    private $officerNoTel;
    private $officerEmail;

    public function __construct(array $array = []) {
        $this->companyName = isset($array['companyName']) ? $array['companyName'] : null;
        $this->companyAddress1 = isset($array['companyAddress1']) ? $array['companyAddress1'] : null;
        $this->companyAddress2 = isset($array['companyAddress2']) ? $array['companyAddress2'] : null;
        $this->companyAddress3 = isset($array['companyAddress3']) ? $array['companyAddress3'] : null;
        $this->companyPostcode = isset($array['companyPostcode']) ? $array['companyPostcode'] : null;
        $this->companyBusinessRegistrationNo = isset($array['companyBusinessRegistrationNo']) ? $array['companyBusinessRegistrationNo'] : null;

        $this->employerCodeNo = isset($array['employerCodeNo']) ? $array['employerCodeNo'] : null;
        $this->month = isset($array['month']) ? $array['month'] : null;
        $this->bankName = isset($array['bankName']) ? $array['bankName'] : null;
        $this->checkNo = isset($array['checkNo']) ? $array['checkNo'] : null;
        $this->totalAmount = isset($array['totalAmount']) ? $array['totalAmount'] : null;

        $this->employeeOldIcNo = isset($array['employeeOldIcNo']) ? $array['employeeOldIcNo'] : null;
        $this->employeeNewIcNo = isset($array['employeeNewIcNo']) ? $array['employeeNewIcNo'] : null;
        $this->employeeName = isset($array['employeeName']) ? $array['employeeName'] : null;
        $this->employeeAmount = isset($array['employeeAmount']) ? $array['employeeAmount'] : null;
        $this->zakatType = isset($array['zakatType']) ? $array['zakatType'] : null;

        $this->officerName = isset($array['officerName']) ? $array['officerName'] : null;
        $this->officerIcNo = isset($array['officerIcNo']) ? $array['officerIcNo'] : null;
        $this->officerPosition = isset($array['officerPosition']) ? $array['officerPosition'] : null;
        $this->officerNoTel = isset($array['officerNoTel']) ? $array['officerNoTel'] : null;
        $this->officerEmail = isset($array['officerEmail']) ? $array['officerEmail'] : null;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed
     */
    public function getCompanyAddress1()
    {
        return $this->companyAddress1;
    }

    /**
     * @param mixed $companyAddress1
     */
    public function setCompanyAddress1($companyAddress1)
    {
        $this->companyAddress1 = $companyAddress1;
    }

    /**
     * @return mixed
     */
    public function getCompanyAddress2()
    {
        return $this->companyAddress2;
    }

    /**
     * @param mixed $companyAddress2
     */
    public function setCompanyAddress2($companyAddress2)
    {
        $this->companyAddress2 = $companyAddress2;
    }

    /**
     * @return mixed
     */
    public function getCompanyAddress3()
    {
        return $this->companyAddress3;
    }

    /**
     * @param mixed $companyAddress3
     */
    public function setCompanyAddress3($companyAddress3)
    {
        $this->companyAddress3 = $companyAddress3;
    }

    /**
     * @return mixed
     */
    public function getCompanyPostcode()
    {
        return $this->companyPostcode;
    }

    /**
     * @param mixed $companyPostcode
     */
    public function setCompanyPostcode($companyPostcode)
    {
        $this->companyPostcode = $companyPostcode;
    }

    /**
     * @return mixed
     */
    public function getCompanyBusinessRegistrationNo()
    {
        return $this->companyBusinessRegistrationNo;
    }

    /**
     * @param mixed $companyBusinessRegistrationNo
     */
    public function setCompanyBusinessRegistrationNo($companyBusinessRegistrationNo)
    {
        $this->companyBusinessRegistrationNo = $companyBusinessRegistrationNo;
    }

    /**
     * @return mixed
     */
    public function getEmployerCodeNo()
    {
        return $this->employerCodeNo;
    }

    /**
     * @param mixed $employerCodeNo
     */
    public function setEmployerCodeNo($employerCodeNo)
    {
        $this->employerCodeNo = $employerCodeNo;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return mixed
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @param mixed $bankName
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
    }

    /**
     * @return mixed
     */
    public function getCheckNo()
    {
        return $this->checkNo;
    }

    /**
     * @param mixed $checkNo
     */
    public function setCheckNo($checkNo)
    {
        $this->checkNo = $checkNo;
    }

    /**
     * @return mixed
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param mixed $totalAmount
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return mixed
     */
    public function getEmployeeOldIcNo()
    {
        return $this->employeeOldIcNo;
    }

    /**
     * @param mixed $employeeOldIcNo
     */
    public function setEmployeeOldIcNo($employeeOldIcNo)
    {
        $this->employeeOldIcNo = $employeeOldIcNo;
    }

    /**
     * @return mixed
     */
    public function getEmployeeNewIcNo()
    {
        return $this->employeeNewIcNo;
    }

    /**
     * @param mixed $employeeNewIcNo
     */
    public function setEmployeeNewIcNo($employeeNewIcNo)
    {
        $this->employeeNewIcNo = $employeeNewIcNo;
    }

    /**
     * @return mixed
     */
    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    /**
     * @param mixed $employeeName
     */
    public function setEmployeeName($employeeName)
    {
        $this->employeeName = $employeeName;
    }

    /**
     * @return mixed
     */
    public function getEmployeeAmount()
    {
        return $this->employeeAmount;
    }

    /**
     * @param mixed $employeeAmount
     */
    public function setEmployeeAmount($employeeAmount)
    {
        $this->employeeAmount = $employeeAmount;
    }

    /**
     * @return mixed
     */
    public function getZakatType()
    {
        return $this->zakatType;
    }

    /**
     * @param mixed $zakatType
     */
    public function setZakatType($zakatType)
    {
        $this->zakatType = $zakatType;
    }

    /**
     * @return mixed
     */
    public function getOfficerName()
    {
        return $this->officerName;
    }

    /**
     * @param mixed $officerName
     */
    public function setOfficerName($officerName)
    {
        $this->officerName = $officerName;
    }

    /**
     * @return mixed
     */
    public function getOfficerIcNo()
    {
        return $this->officerIcNo;
    }

    /**
     * @param mixed $officerIcNo
     */
    public function setOfficerIcNo($officerIcNo)
    {
        $this->officerIcNo = $officerIcNo;
    }

    /**
     * @return mixed
     */
    public function getOfficerPosition()
    {
        return $this->officerPosition;
    }

    /**
     * @param mixed $officerPosition
     */
    public function setOfficerPosition($officerPosition)
    {
        $this->officerPosition = $officerPosition;
    }

    /**
     * @return mixed
     */
    public function getOfficerNoTel()
    {
        return $this->officerNoTel;
    }

    /**
     * @param mixed $officerNoTel
     */
    public function setOfficerNoTel($officerNoTel)
    {
        $this->officerNoTel = $officerNoTel;
    }

    /**
     * @return mixed
     */
    public function getOfficerEmail()
    {
        return $this->officerEmail;
    }

    /**
     * @param mixed $officerEmail
     */
    public function setOfficerEmail($officerEmail)
    {
        $this->officerEmail = $officerEmail;
    }

    public function toArray() {
        return [
            'companyName' => $this->companyName,
            'companyAddress1' => $this->companyAddress1,
            'companyAddress2' => $this->companyAddress2,
            'companyAddress3' => $this->companyAddress3,
            'companyPostcode' => $this->companyPostcode,
            'companyBusinessRegistrationNo' => $this->companyBusinessRegistrationNo,

            'employerCodeNo' => $this->employerCodeNo,
            'month' => $this->month,
            'bankName' => $this->bankName,
            'checkNo' => $this->checkNo,
            'totalAmount' => $this->totalAmount,

            'employeeOldIcNo' => $this->employeeOldIcNo,
            'employeeNewIcNo' => $this->employeeNewIcNo,
            'employeeName' => $this->employeeName,
            'employeeAmount' => $this->employeeAmount,
            'zakatType' => $this->zakatType,

            'officerName' => $this->officerName,
            'officerIcNo' => $this->officerIcNo,
            'officerPosition' => $this->officerPosition,
            'officerNoTel' => $this->officerNoTel,
            'officerEmail' => $this->officerEmail,
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
}
