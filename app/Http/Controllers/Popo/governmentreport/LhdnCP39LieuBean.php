<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/8/18
 * Time: 11:08 AM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class LhdnCP39LieuBean
{
    private $employerName;
    private $employerNoE;
    private $name;
    private $salaryNo;
    private $icOldNo;
    private $icNewNo;
    private $referenceTaxRevenueNo;
    private $marriageStatus;
    private $marriageDate;
    private $gender;
    private $pcbMadeYears;
    private $workStartedDate;
    private $monthlySalary;
    private $address1;
    private $address2;
    private $address3;
    private $postcode;
    private $foreignerBirthDate;
    private $foreignerPassportNo;
    private $spouseName;
    private $spouseIcOldNo;
    private $spouseIcNewNo;
    private $spouseReferenceTaxRevenueNo;
    private $foreignerSpouseBirthDate;
    private $foreignerSpousePassportNo;

    public function __construct(array $array = []) {
        $this->employerName = isset($array['employerName']) ? $array['employerName'] : null;
        $this->employerNoE = isset($array['employerNoE']) ? $array['employerNoE'] : null;
        $this->name = isset($array['name']) ? $array['name'] : null;
        $this->salaryNo = isset($array['salaryNo']) ? $array['salaryNo'] : null;
        $this->icOldNo = isset($array['icOldNo']) ? $array['icOldNo'] : null;
        $this->icNewNo = isset($array['icNewNo']) ? $array['icNewNo'] : null;
        $this->referenceTaxRevenueNo = isset($array['referenceTaxRevenueNo']) ? $array['referenceTaxRevenueNo'] : null;
        $this->marriageStatus = isset($array['marriageStatus']) ? $array['marriageStatus'] : null;
        $this->marriageDate = isset($array['marriageDate']) ? $array['marriageDate'] : null;
        $this->gender = isset($array['gender']) ? $array['gender'] : null;
        $this->pcbMadeYears = isset($array['pcbMadeYears']) ? $array['pcbMadeYears'] : null;
        $this->workStartedDate = isset($array['workStartedDate']) ? $array['workStartedDate'] : null;
        $this->monthlySalary = isset($array['monthlySalary']) ? $array['monthlySalary'] : null;
        $this->address1 = isset($array['address1']) ? $array['address1'] : null;
        $this->address2 = isset($array['address2']) ? $array['address2'] : null;
        $this->address3 = isset($array['address3']) ? $array['address3'] : null;
        $this->postcode = isset($array['postcode']) ? $array['postcode'] : null;
        $this->foreignerBirthDate = isset($array['foreignerBirthDate']) ? $array['foreignerBirthDate'] : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $this->foreignerPassportNo = isset($array['foreignerPassportNo']) ? $array['foreignerPassportNo'] : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $this->spouseName = isset($array['spouseName']) ? $array['spouseName'] : null;
        $this->spouseIcOldNo = isset($array['spouseIcOldNo']) ? $array['spouseIcOldNo'] : null;
        $this->spouseIcNewNo = isset($array['spouseIcNewNo']) ? $array['spouseIcNewNo'] : null;
        $this->spouseReferenceTaxRevenueNo = isset($array['spouseReferenceTaxRevenueNo']) ? $array['spouseReferenceTaxRevenueNo'] : null;
        $this->foreignerSpouseBirthDate = isset($array['foreignerSpouseBirthDate']) ? $array['foreignerSpouseBirthDate'] : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $this->foreignerSpousePassportNo = isset($array['foreignerSpousePassportNo']) ? $array['foreignerSpousePassportNo'] : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }

    public function getEmployerName() {
        return $this->employerName;
    }

    public function setEmployerName($employerName) {
        $this->employerName = $employerName;
        return $this;
    }

    public function getEmployerNoE() {
        return $this->employerNoE;
    }

    public function setEmployerNoE($employerNoE) {
        $this->employerNoE = $employerNoE;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getSalaryNo() {
        return $this->salaryNo;
    }

    public function setSalaryNo($salaryNo) {
        $this->salaryNo = $salaryNo;
        return $this;
    }

    public function getIcOldNo() {
        return $this->icOldNo;
    }

    public function setIcOldNo($icOldNo) {
        $this->icOldNo = $icOldNo;
        return $this;
    }

    public function getIcNewNo() {
        return $this->icNewNo;
    }

    public function setIcNewNo($icNewNo) {
        $this->icNewNo = $icNewNo;
        return $this;
    }

    public function getReferenceTaxRevenueNo() {
        return $this->referenceTaxRevenueNo;
    }

    public function setReferenceTaxRevenueNo($referenceTaxRevenueNo) {
        $this->referenceTaxRevenueNo = $referenceTaxRevenueNo;
        return $this;
    }

    public function getMarriageStatus() {
        return $this->marriageStatus;
    }

    public function setMarriageStatus($marriageStatus) {
        $this->marriageStatus = $marriageStatus;
        return $this;
    }

    public function getMarriageDate() {
        return $this->marriageDate;
    }

    public function setMarriageDate($marriageDate) {
        $this->marriageDate = $marriageDate;
        return $this;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
        return $this;
    }

    public function getPcbMadeYears() {
        return $this->pcbMadeYears;
    }

    public function setPcbMadeYears($pcbMadeYears) {
        $this->pcbMadeYears = $pcbMadeYears;
        return $this;
    }

    public function getWorkStartedDate() {
        return $this->workStartedDate;
    }

    public function setWorkStartedDate($workStartedDate) {
        $this->workStartedDate = $workStartedDate;
        return $this;
    }

    public function getMonthlySalary() {
        return $this->monthlySalary;
    }

    public function setMonthlySalary($monthlySalary) {
        $this->monthlySalary = $monthlySalary;
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

    public function getForeignerBirthDate() {
        return $this->foreignerBirthDate;
    }

    public function setForeignerBirthDate($foreignerBirthDate) {
        $this->foreignerBirthDate = $foreignerBirthDate;
        return $this;
    }

    public function getForeignerPassportNo() {
        return $this->foreignerPassportNo;
    }

    public function setForeignerPassportNo($foreignerPassportNo) {
        $this->foreignerPassportNo = $foreignerPassportNo;
        return $this;
    }

    public function getSpouseName() {
        return $this->spouseName;
    }

    public function setSpouseName($spouseName) {
        $this->spouseName = $spouseName;
        return $this;
    }

    public function getSpouseIcOldNo() {
        return $this->spouseIcOldNo;
    }

    public function setSpouseIcOldNo($spouseIcOldNo) {
        $this->spouseIcOldNo = $spouseIcOldNo;
        return $this;
    }

    public function getSpouseIcNewNo() {
        return $this->spouseIcNewNo;
    }

    public function setSpouseIcNewNo($spouseIcNewNo) {
        $this->spouseIcNewNo = $spouseIcNewNo;
        return $this;
    }

    public function getSpouseReferenceTaxRevenueNo() {
        return $this->spouseReferenceTaxRevenueNo;
    }

    public function setSpouseReferenceTaxRevenueNo($spouseReferenceTaxRevenueNo) {
        $this->spouseReferenceTaxRevenueNo = $spouseReferenceTaxRevenueNo;
        return $this;
    }

    public function getForeignerSpouseBirthDate() {
        return $this->foreignerSpouseBirthDate;
    }

    public function setForeignerSpouseBirthDate($foreignerSpouseBirthDate) {
        $this->foreignerSpouseBirthDate = $foreignerSpouseBirthDate;
        return $this;
    }

    public function getForeignerSpousePassportNo() {
        return $this->foreignerSpousePassportNo;
    }

    public function setForeignerSpousePassportNo($foreignerSpousePassportNo) {
        $this->foreignerSpousePassportNo = $foreignerSpousePassportNo;
        return $this;
    }

    public function toArray() {
        return [
            'employerName' => $this->employerName,
            'employerNoE' => $this->employerNoE,
            'name' => $this->name,
            'salaryNo' => $this->salaryNo,
            'icOldNo' => $this->icOldNo,
            'icNewNo' => $this->icNewNo,
            'referenceTaxRevenueNo' => $this->referenceTaxRevenueNo,
            'marriageStatus' => $this->marriageStatus,
            'marriageDate' => $this->marriageDate,
            'gender' => $this->gender,
            'pcbMadeYears' => $this->pcbMadeYears,
            'workStartedDate' => $this->workStartedDate,
            'monthlySalary' => $this->monthlySalary,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'address3' => $this->address3,
            'postcode' => $this->postcode,
            'foreignerBirthDate' => $this->foreignerBirthDate,
            'foreignerPassportNo' => $this->foreignerPassportNo,
            'spouseName' => $this->spouseName,
            'spouseIcOldNo' => $this->spouseIcOldNo,
            'spouseIcNewNo' => $this->spouseIcNewNo,
            'spouseReferenceTaxRevenueNo' => $this->spouseReferenceTaxRevenueNo,
            'foreignerSpouseBirthDate' => $this->foreignerSpouseBirthDate,
            'foreignerSpousePassportNo' => $this->foreignerSpousePassportNo
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

}
