<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/6/18
 * Time: 6:56 PM
 */

namespace App\Popo\report;


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
    private $employerName;
    private $address1;
    private $address2;
    private $address3;
    private $postcode;
    private $name;
    private $telNo;

    public function __construct(array $array = []) {
        $this->fromMonth = isset($array['fromMonth']) ? $array['fromMonth'] : null;
        $this->toMonth = isset($array['toMonth']) ? $array['toMonth'] : null;
        $this->year = isset($array['year']) ? $array['year'] : date("Y");
        $this->date = isset($array['date']) ? $array['date'] : date("d/m/Y");
        $this->noCheck = isset($array['noCheck']) ? $array['noCheck'] : null;
        $this->amount = isset($array['amount']) ? $array['amount'] : "0.00";
        $this->employerCode = isset($array['employerCode']) ? $array['employerCode'] : null;
        $this->employerName = isset($array['employerName']) ? $array['employerName'] : null;
        $this->address1 = isset($array['address1']) ? $array['address1'] : null;
        $this->address2 = isset($array['address2']) ? $array['address2'] : null;
        $this->address3 = isset($array['address3']) ? $array['address3'] : null;
        $this->postcode = isset($array['postcode']) ? $array['postcode'] : null;
        $this->name = isset($array['name']) ? $array['name'] : null;
        $this->telNo = isset($array['telNo']) ? $array['telNo'] : null;
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

    public function getEmployerName() {
        return $this->employerName;
    }

    public function setEmployerName($employerName) {
        $this->employerName = $employerName;
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

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getTelNo() {
        return $this->telNo;
    }

    public function setTelNo($telNo) {
        $this->telNo = $telNo;
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
            'employerName' => $this->employerName,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'address3' => $this->address3,
            'postcode' => $this->postcode,
            'name' => $this->name,
            'telNo' => $this->telNo,
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

}
