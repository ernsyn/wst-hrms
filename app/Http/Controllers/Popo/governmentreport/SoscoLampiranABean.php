<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/6/18
 * Time: 6:56 PM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class SoscoLampiranABean
{
    private $fromMonth;
    private $toMonth;
    private $year;
    private $date; //01/10/2018
    private $employeeTotalNumber;
    private $noCheck;
    private $amount;
    private $employerCode;
    private $companyName;
    private $companyRegistrationNo;
    private $address1;
    private $address2;
    private $address3;
    private $postcode;
    private $officerName;
    private $officerTelNo;

    public function __construct(array $array = []) {
        $this->fromMonth = isset($array['fromMonth']) ? $array['fromMonth'] : null;
        $this->toMonth = isset($array['toMonth']) ? $array['toMonth'] : null;
        $this->year = isset($array['year']) ? $array['year'] : date("Y");
        $this->date = isset($array['date']) ? $array['date'] : date("d/m/Y");
        $this->employeeTotalNumber = isset($array['employeeTotalNumber']) ? $array['employeeTotalNumber'] : null;
        $this->noCheck = isset($array['noCheck']) ? $array['noCheck'] : null;
        $this->amount = isset($array['amount']) ? $array['amount'] : "0.00";
        $this->employerCode = isset($array['employerCode']) ? $array['employerCode'] : null;
        $this->companyName = isset($array['companyName']) ? $array['companyName'] : null;
        $this->companyRegistrationNo = isset($array['companyRegistrationNo']) ? $array['companyRegistrationNo'] : null;
        $this->address1 = isset($array['address1']) ? $array['address1'] : null;
        $this->address2 = isset($array['address2']) ? $array['address2'] : null;
        $this->address3 = isset($array['address3']) ? $array['address3'] : null;
        $this->postcode = isset($array['postcode']) ? $array['postcode'] : null;
        $this->officerName = isset($array['officerName']) ? $array['officerName'] : null;
        $this->officerTelNo = isset($array['officerTelNo']) ? $array['officerTelNo'] : null;
    }

    public function getFromMonth() {
        return $this->fromMonth;
    }

    public function setFromMonth($fromMonth) {
        $this->fromMonth = $fromMonth;
        return $this;
    }

    public function getToMonth() {
        return $this->toMonth;
    }

    public function setToMonth($toMonth) {
        $this->toMonth = $toMonth;
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

    public function getEmployeeTotalNumber() {
        return $this->employeeTotalNumber;
    }

    public function setEmployeeTotalNumber($employeeTotalNumber) {
        $this->employeeTotalNumber = $employeeTotalNumber;
        return $this;
    }

    public function getNoCheck() {
        return $this->noCheck;
    }

    public function setNoCheck($noCheck) {
        $this->noCheck = $noCheck;
        return $this;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    public function getEmployerCode() {
        return $this->employerCode;
    }

    public function setEmployerCode($employerCode) {
        $this->employerCode = $employerCode;
        return $this;
    }

    public function getCompanyName() {
        return $this->companyName;
    }

    public function setCompanyName($companyName) {
        $this->companyName = $companyName;
        return $this;
    }

    public function getCompanyRegistrationNo() {
        return $this->companyRegistrationNo;
    }

    public function setCompanyRegistrationNo($companyRegistrationNo) {
        $this->companyRegistrationNo = $companyRegistrationNo;
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

    public function getOfficerName() {
        return $this->officerName;
    }

    public function setOfficerName($officerName) {
        $this->officerName = $officerName;
        return $this;
    }

    public function getOfficerTelNo() {
        return $this->officerTelNo;
    }

    public function setOfficerTelNo($officerTelNo) {
        $this->officerTelNo = $officerTelNo;
        return $this;
    }

    public function toArray() {
        return [
            'fromMonth' => $this->fromMonth,
            'toMonth' => $this->toMonth,
            'year' => $this->year,
            'date' => $this->date,
            'noCheck' => $this->noCheck,
            'amount' => $this->amount,
            'employerCode' => $this->employerCode,
            'companyName' => $this->companyName,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'address3' => $this->address3,
            'postcode' => $this->postcode,
            'officerName' => $this->officerName,
            'officerTelNo' => $this->oficerTelNo,
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

}
