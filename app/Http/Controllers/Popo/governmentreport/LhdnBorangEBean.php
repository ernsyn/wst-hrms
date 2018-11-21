<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/7/18
 * Time: 11:12 AM
 */

namespace App\Http\Controllers\Popo\governmentreport;

use App\Http\Controllers\Popo\governmentreport\LhdnCP8EmployeeDetail;

class LhdnBorangEBean
{
    private $employerName;
    private $employerNoE;
    private $employerStatus; // 1=Kerajaan  2=Berkanun  3=Swasta
    private $businessStatus; // 1=Beroperasi  2=Belum Beroperasi  3=Dorman  4=Dalam Proses Pembubaran
    private $incomeTaxNo;
    private $icNo;
    private $passportNo;
    private $ssmNo;
    private $address1;
    private $address2;
    private $address3;
    private $postcode;
    private $phoneNo;
    private $mobileNo;
    private $email;
    private $CP8D; // 1=Bersama Borang E  2=Melalui Data Praisi  3=Cakera Padat

    private $totalEmployee;
    private $totalEmployeeWithPCB;
    private $totalNewEmployee;
    private $totalEmployeeResigned;
    private $totalEmployeeResignedLeaveMalaysia;
    private $reportLHDNM; // 1=Ya    2=Tidak
    private $officerName;
    private $officerIC;
    private $officerPosition;
    private $date; //01/10/2018

    public function __construct(array $array = []) {
        $this->employerName = isset($array['employerName']) ? $array['employerName'] : null;
        $this->employerNoE = isset($array['employerNoE']) ? $array['employerNoE'] : null;
        $this->employerStatus = isset($array['employerStatus']) ? $array['employerStatus'] : null;
        $this->businessStatus = isset($array['businessStatus']) ? $array['businessStatus'] : null;
        $this->incomeTaxNo = isset($array['incomeTaxNo']) ? $array['incomeTaxNo'] : null;
        $this->icNo = isset($array['icNo']) ? $array['icNo'] : null;
        $this->passportNo = isset($array['passportNo']) ? $array['passportNo'] : null;
        $this->ssmNo = isset($array['ssmNo']) ? $array['ssmNo'] : null;
        $this->address1 = isset($array['address1']) ? $array['address1'] : null;
        $this->address2 = isset($array['address2']) ? $array['address2'] : null;
        $this->address3 = isset($array['address3']) ? $array['address3'] : null;
        $this->postcode = isset($array['postcode']) ? $array['postcode'] : null;
        $this->phoneNo = isset($array['phoneNo']) ? $array['phoneNo'] : null;
        $this->mobileNo = isset($array['mobileNo']) ? $array['mobileNo'] : null;
        $this->email = isset($array['email']) ? $array['email'] : null;
        $this->CP8D = isset($array['CP8D']) ? $array['CP8D'] : null;

        $this->totalEmployee = isset($array['totalEmployee']) ? $array['totalEmployee'] : null;
        $this->totalEmployeeWithPCB = isset($array['totalEmployeeWithPCB']) ? $array['totalEmployeeWithPCB'] : null;
        $this->totalNewEmployee = isset($array['totalNewEmployee']) ? $array['totalNewEmployee'] : null;
        $this->totalEmployeeResigned = isset($array['totalEmployeeResigned']) ? $array['totalEmployeeResigned'] : null;
        $this->totalEmployeeResignedLeaveMalaysia = isset($array['totalEmployeeResignedLeaveMalaysia']) ? $array['totalEmployeeResignedLeaveMalaysia'] : null;
        $this->reportLHDNM = isset($array['reportLHDNM']) ? $array['reportLHDNM'] : null;
        $this->officerName = isset($array['officerName']) ? $array['officerName'] : null;
        $this->officerIC = isset($array['officerIC']) ? $array['officerIC'] : null;
        $this->officerPosition = isset($array['officerPosition']) ? $array['officerPosition'] : null;
        $this->date = isset($array['date']) ? $array['date'] : date("d/m/Y");
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

    public function getEmployerStatus() {
        return $this->employerStatus;
    }

    public function setEmployerStatus($employerStatus) {
        $this->employerStatus = $employerStatus;
        return $this;
    }

    public function getBusinessStatus() {
        return $this->businessStatus;
    }

    public function setBusinessStatus($businessStatus) {
        $this->businessStatus = $businessStatus;
        return $this;
    }

    public function getFirstIncomeTaxNo(){
        $first = preg_replace('/[^a-zA-Z]/', '', $this->incomeTaxNo);
        return $first;
    }

    public function getLastIncomeTaxNo(){
        $end = preg_replace('/[^0-9]/', '', $this->incomeTaxNo);
        return $end;
    }

    public function getIncomeTaxNo() {
        return $this->incomeTaxNo;
    }

    public function setIncomeTaxNo($incomeTaxNo) {
        $this->incomeTaxNo = $incomeTaxNo;
        return $this;
    }

    public function getIcNo() {
        return $this->icNo;
    }

    public function setIcNo($icNo) {
        $this->icNo = $icNo;
        return $this;
    }

    public function getPassportNo() {
        return $this->passportNo;
    }

    public function setPassportNo($passportNo) {
        $this->passportNo = $passportNo;
        return $this;
    }

    public function getSsmNo() {
        return $this->ssmNo;
    }

    public function setSsmNo($ssmNo) {
        $this->ssmNo = $ssmNo;
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
        $this->address1 = $address3;
        return $this;
    }

    public function getPostcode() {
        return $this->postcode;
    }

    public function setPostcode($postcode) {
        $this->postcode = $postcode;
        return $this;
    }

    public function getPhoneNo() {
        return $this->phoneNo;
    }

    public function setPhoneNo($phoneNo) {
        $this->phoneNo = $phoneNo;
        return $this;
    }

    public function getMobileNo() {
        return $this->mobileNo;
    }

    public function setMobileNo($mobileNo) {
        $this->mobileNo = $mobileNo;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getCP8D() {
        return $this->CP8D;
    }

    public function setCP8D($CP8D) {
        $this->CP8D = $CP8D;
        return $this;
    }

    public function getTotalEmployee() {
        return $this->totalEmployee;
    }

    public function setTotalEmployee($totalEmployee) {
        $this->totalEmployee = $totalEmployee;
        return $this;
    }

    public function getTotalEmployeeWithPCB() {
        return $this->totalEmployeeWithPCB;
    }

    public function setTotalEmployeeWithPCB($totalEmployeeWithPCB) {
        $this->totalEmployeeWithPCB = $totalEmployeeWithPCB;
        return $this;
    }

    public function getTotalNewEmployee() {
        return $this->totalNewEmployee;
    }

    public function setTotalNewEmployee($totalNewEmployee) {
        $this->totalNewEmployee = $totalNewEmployee;
        return $this;
    }

    public function getTotalEmployeeResigned() {
        return $this->totalEmployeeResigned;
    }

    public function setTotalEmployeeResigned($totalEmployeeResigned) {
        $this->totalEmployeeResigned = $totalEmployeeResigned;
        return $this;
    }

    public function getTotalEmployeeResignedLeaveMalaysia() {
        return $this->totalEmployeeResignedLeaveMalaysia;
    }

    public function setTotalEmployeeResignedLeaveMalaysia($totalEmployeeResignedLeaveMalaysia) {
        $this->totalEmployeeResignedLeaveMalaysia = $totalEmployeeResignedLeaveMalaysia;
        return $this;
    }

    public function getReportLHDNM() {
        return $this->reportLHDNM;
    }

    public function setReportLHDNM($reportLHDNM) {
        $this->reportLHDNM = $reportLHDNM;
        return $this;
    }

    public function getOfficerName() {
        return $this->officerName;
    }

    public function setOfficerName($officerName) {
        $this->officerName = $officerName;
        return $this;
    }

    public function getOfficerIC() {
        return $this->officerIC;
    }

    public function setOfficerIC($officerIC) {
        $this->officerIC = $officerIC;
        return $this;
    }

    public function getOfficerPosition() {
        return $this->officerPosition;
    }

    public function setOfficerPosition($officerPosition) {
        $this->officerPosition = $officerPosition;
        return $this;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    public function toArray() {
        return [
            'employerName' => $this->employerName,
            'employerNoE' => $this->employerNoE,
            'employerStatus' => $this->employerStatus,
            'businessStatus' => $this->businessStatus,
            'incomeTaxNo' => $this->incomeTaxNo,
            'icNo' => $this->icNo,
            'passportNo' => $this->passportNo,
            'ssmNo' => $this->ssmNo,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'address3' => $this->address3,
            'postcode' => $this->postcode,
            'phoneNo' => $this->phoneNo,
            'mobileNo' => $this->mobileNo,
            'email' => $this->email,
            'CP8D' => $this->CP8D,

            'totalEmployee' => $this->totalEmployee,
            'totalEmployeeWithPCB' => $this->totalEmployeeWithPCB,
            'totalNewEmployee' => $this->totalNewEmployee,
            'totalEmployeeResigned' => $this->totalEmployeeResigned,
            'totalEmployeeResignedLeaveMalaysia' => $this->totalEmployeeResignedLeaveMalaysia,
            'reportLHDNM' => $this->reportLHDNM,
            'officerName' => $this->officerName,
            'offficerIC' => $this->offficerIC,
            'officerPosition' => $this->officerPosition,
            'date' => $this->date
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

}
