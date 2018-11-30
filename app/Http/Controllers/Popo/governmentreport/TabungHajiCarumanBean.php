<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/6/18
 * Time: 6:56 PM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class TabungHajiCarumanBean
{
    private $month;
    private $year;
    private $date; //01/10/2018

    private $companyName;
    private $address1;
    private $address2;
    private $address3;
    private $postcode;
    private $employerCode;

    private $employeeNoAccount;
    private $employeeNo;
    private $employeeIcNo;
    private $employeeName;
    private $employeeContribution;

    private $employeeTotalContribution;

    public function __construct(array $array = []) {
        $this->month = isset($array['month']) ? $array['month'] : date("F");
        $this->year = isset($array['year']) ? $array['year'] : date("Y");
        $this->date = isset($array['date']) ? $array['date'] : date("d/m/Y");

        $this->companyName = isset($array['companyName']) ? $array['companyName'] : null;
        $this->employerCode = isset($array['employerCode']) ? $array['employerCode'] : null;
        $this->address1 = isset($array['address1']) ? $array['address1'] : null;
        $this->address2 = isset($array['address2']) ? $array['address2'] : null;
        $this->address3 = isset($array['address3']) ? $array['address3'] : null;
        $this->postcode = isset($array['postcode']) ? $array['postcode'] : null;

        $this->employeeNoAccount = isset($array['employeeNoAccount']) ? $array['employeeNoAccount'] : null;
        $this->employeeNo = isset($array['employeeNo']) ? $array['employeeNo'] : null;
        $this->employeeIcNo = isset($array['employeeIcNo']) ? $array['employeeIcNo'] : null;
        $this->employeeName = isset($array['employeeName']) ? $array['employeeName'] : null;
        $this->employeeContribution = isset($array['employeeContribution']) ? $array['employeeContribution'] : null;

        $this->employeeTotalContribution = isset($array['employeeTotalContribution']) ? $array['employeeTotalContribution'] : null;

    }

    public function getMonth() {
        return $this->month;
    }

    public function setMonth($month) {
        $this->month = $month;
        return $this;
    }


    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
        return $this;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    public function getCompanyName() {
        return $this->companyName;
    }

    public function setCompanyName($companyName) {
        $this->companyName = $companyName;
        return $this;
    }

    public function getEmployerCode() {
        return $this->employerCode;
    }

    public function setEmployerCode($employerCode) {
        $this->employerCode = $employerCode;
        return $this;
    }

    public function getAddress1() {
        return $this->address1;
    }

    public function setAddress1($address1) {
        $this->address1 = $address1;
        return $this;
    }

    public function getAddress2() {
        return $this->address2;
    }

    public function setAddress2($address2) {
        $this->address2 = $address2;
        return $this;
    }

    public function getAddress3() {
        return $this->address3;
    }

    public function setAddress3($address3) {
        $this->address3 = $address3;
        return $this;
    }

    public function getPostcode() {
        return $this->postcode;
    }

    public function setPostcode($postcode) {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmployeeNoAccount()
    {
        return $this->employeeNoAccount;
    }

    /**
     * @param mixed $employeeNoAccount
     */
    public function setEmployeeNoAccount($employeeNoAccount)
    {
        $this->employeeNoAccount = $employeeNoAccount;
    }

    /**
     * @return mixed
     */
    public function getEmployeeNo()
    {
        return $this->employeeNo;
    }

    /**
     * @param mixed $employeeNo
     */
    public function setEmployeeNo($employeeNo)
    {
        $this->employeeNo = $employeeNo;
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
    public function getEmployeeTotalContribution()
    {
        return $this->employeeTotalContribution;
    }

    /**
     * @param mixed $employeeTotalContribution
     */
    public function setEmployeeTotalContribution($employeeTotalContribution)
    {
        $this->employeeTotalContribution = $employeeTotalContribution;
    }


    public function toArray() {
        return [
            'month' => $this->month,
            'year' => $this->year,
            'date' => $this->date,

            'companyName' => $this->companyName,
            'employerCode' => $this->employerCode,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'address3' => $this->address3,
            'postcode' => $this->postcode,

            'employeeNoAccount' => $this->employeeNoAccount,
            'employeeNo' => $this->employeeNo,
            'employeeIcNo' => $this->employeeIcNo,
            'employeeName' => $this->employeeName,
            'employeeContribution' => $this->employeeContribution,

            'employeeTotalContribution' => $this->employeeTotalContribution,
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

}

