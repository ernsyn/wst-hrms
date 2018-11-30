<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/27/18
 * Time: 3:22 PM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class SocsoBorang8ABean
{
    private $month;
    private $year;
    private $companyReferenceNo;
    private $companyBusinessRegistrationNo;
    private $totalContribution;
    private $payNotBeforeDate;
    private $companyName;
    private $companyAddress1;
    private $companyAddress2;
    private $companyAddress3;
    private $companyPostcode;
    private $totalEmployee;

    private $jobDate;
    private $status;
    private $employeeIcNo;
    private $employeeName;
    private $employeeContribution;

    private $officerName;
    private $officerTelNo;
    private $paymentMethod;

    public function __construct(array $array = []) {
        $this->month = isset($array['month']) ? $array['month'] : date("m");
        $this->year = isset($array['year']) ? $array['year'] : date("Y");
        $this->companyReferenceNo = isset($array['companyReferenceNo']) ? $array['companyReferenceNo'] : null;
        $this->companyBusinessRegistrationNo = isset($array['companyBusinessRegistrationNo']) ? $array['companyBusinessRegistrationNo'] : null;
        $this->totalContribution = isset($array['totalContribution']) ? $array['totalContribution'] : null;
        $this->payNotBeforeDate = isset($array['payNotBeforeDate']) ? $array['payNotBeforeDate'] : date('d/m/Y');
        $this->companyName = isset($array['companyName']) ? $array['companyName'] : null;
        $this->companyAddress1 = isset($array['companyAddress1']) ? $array['companyAddress1'] : null;
        $this->companyAddress2 = isset($array['companyAddress2']) ? $array['companyAddress2'] : null;
        $this->companyAddress3 = isset($array['companyAddress3']) ? $array['companyAddress3'] : null;
        $this->companyPostcode = isset($array['companyPostcode']) ? $array['companyPostcode'] : null;
        $this->totalEmployee = isset($array['totalEmployee']) ? $array['totalEmployee'] : null;

        $this->jobDate = isset($array['jobDate']) ? $array['jobDate'] : null;
        $this->status = isset($array['status']) ? $array['status'] : null;
        $this->employeeIcNo = isset($array['employeeIcNo']) ? $array['employeeIcNo'] : null;
        $this->employeeName = isset($array['employeeName']) ? $array['employeeName'] : null;
        $this->employeeContribution = isset($array['employeeContribution']) ? $array['employeeContribution'] : null;

        $this->officerName = isset($array['officerName']) ? $array['officerName'] : null;
        $this->officerTelNo = isset($array['officerTelNo']) ? $array['officerTelNo'] : null;
        $this->paymentMethod = isset($array['paymentMethod']) ? $array['paymentMethod'] : null;
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
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getCompanyReferenceNo()
    {
        return $this->companyReferenceNo;
    }

    /**
     * @param mixed $companyReferenceNo
     */
    public function setCompanyReferenceNo($companyReferenceNo)
    {
        $this->companyReferenceNo = $companyReferenceNo;
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
    public function getTotalContribution()
    {
        return $this->totalContribution;
    }

    /**
     * @param mixed $totalContribution
     */
    public function setTotalContribution($totalContribution)
    {
        $this->totalContribution = $totalContribution;
    }

    /**
     * @return mixed
     */
    public function getPayNotBeforeDate()
    {
        return $this->payNotBeforeDate;
    }

    /**
     * @param mixed $payNotBeforeDate
     */
    public function setPayNotBeforeDate($payNotBeforeDate)
    {
        $this->payNotBeforeDate = $payNotBeforeDate;
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
    public function getTotalEmployee()
    {
        return $this->totalEmployee;
    }

    /**
     * @param mixed $totalEmployee
     */
    public function setTotalEmployee($totalEmployee)
    {
        $this->totalEmployee = $totalEmployee;
    }

    /**
     * @return mixed
     */
    public function getJobDate()
    {
        return $this->jobDate;
    }

    /**
     * @param mixed $jobDate
     */
    public function setJobDate($jobDate)
    {
        $this->jobDate = $jobDate;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getEmployeeIcNo()
    {
        return $this->employeeIcNo;
    }

    /**
     * @param mixed $employeeIcNo
     */
    public function setEmployeeIcNo($employeeIcNo)
    {
        $this->employeeIcNo = $employeeIcNo;
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
    public function getEmployeeContribution()
    {
        return $this->employeeContribution;
    }

    /**
     * @param mixed $employeeContribution
     */
    public function setEmployeeContribution($employeeContribution)
    {
        $this->employeeContribution = $employeeContribution;
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
    public function getOfficerTelNo()
    {
        return $this->officerTelNo;
    }

    /**
     * @param mixed $officerTelNo
     */
    public function setOfficerTelNo($officerTelNo)
    {
        $this->officerTelNo = $officerTelNo;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param mixed $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function toArray() {
        return [
            'month' => $this->month,
            'year' => $this->year,
            'companyReferenceNo' => $this->companyReferenceNo,
            'companyBusinessRegistrationNo' => $this->companyBusinessRegistrationNo,
            'totalContribution' => $this->totalContribution,
            'payNotBeforeDate' => $this->payNotBeforeDate,
            'companyName' => $this->companyName,
            'companyAddress1' => $this->companyAddress1,
            'companyAddress2' => $this->companyAddress2,
            'companyAddress3' => $this->companyAddress3,
            'companyPostcode' => $this->companyPostcode,
            'totalEmployee' => $this->totalEmployee,

            'jobDate' => $this->jobDate,
            'status' => $this->status,
            'employeeIcNo' => $this->employeeIcNo,
            'employeeName' => $this->employeeName,
            'employeeContribution' => $this->employeeContribution,

            'officerName' => $this->officerName,
            'officerTelNo' => $this->officerTelNo,
            'paymentMethod' => $this->paymentMethod
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
}
