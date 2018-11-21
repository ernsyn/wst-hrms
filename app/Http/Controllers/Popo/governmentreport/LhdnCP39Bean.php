<?php
/**
 * Created by IntelliJ IDEA.
 * User: play
 * Date: 11/11/18
 * Time: 4:27 PM
 */

namespace App\Popo\report;


class LhdnCP39Bean
{
    private $companyName;
    private $companyRegistrationNo;
    private $companyAddress1;
    private $companyAddress2;
    private $companyAddress3;
    private $companyPostcode;

    private $month;
    private $year;

    private $employerNoE;
    private $employerNoEArr;
    private $pcbTotalCut;
    private $pcbTotalWorker;
    private $pcbTotalAmount;
    private $pcbBranchNo;
    private $pcbDate;
    private $cp38TotalCut;
    private $cp38TotalWorker;

    private $officerSignature;
    private $officerName;
    private $officerIcNo;
    private $officerPosition;
    private $officerNoTel;

    private $incomeTaxNo;
    private $name;
    private $oldIcNo;
    private $newIcNo;
    private $staffNo;
    private $foreignerPassportNo;
    private $foreignerCountry;
    private $pcbAmount;
    private $cp38Amount;

    public function __construct(array $array = []) {
        $this->companyName = isset($array['companyName']) ? $array['companyName'] : null;
        $this->companyRegistrationNo = isset($array['companyRegistrationNo']) ? $array['companyRegistrationNo'] : null;
        $this->companyAddress1 = isset($array['companyAddress1']) ? $array['companyAddress1'] : null;
        $this->companyAddress2 = isset($array['companyAddress2']) ? $array['companyAddress2'] : null;
        $this->companyAddress3 = isset($array['companyAddress3']) ? $array['companyAddress3'] : null;
        $this->companyPostcode = isset($array['companyPostcode']) ? $array['companyPostcode'] : null;

        $this->month = isset($array['month']) ? $array['month'] : date("F");
        $this->year = isset($array['year']) ? $array['year'] : date("Y");

        $this->employerNoE = isset($array['employerNoE']) ? $array['employerNoE'] : null;
        $this->pcbTotalCut = isset($array['pcbTotalCut']) ? $array['pcbTotalCut'] : '0.00';
        $this->pcbTotalWorker = isset($array['pcbTotalWorker']) ? $array['pcbTotalWorker'] : 0;
        $this->pcbTotalAmount = isset($array['pcbTotalAmount']) ? $array['pcbTotalAmount'] : null;
        $this->pcbBranchNo = isset($array['pcbBranchNo']) ? $array['pcbBranchNo'] : null;
        $this->pcbDate = isset($array['pcbDate']) ? $array['pcbDate'] : date("d/m/Y");
        $this->cp38TotalCut = isset($array['cp38TotalCut']) ? $array['cp38TotalCut'] : null;
        $this->cp38TotalWorker = isset($array['cp38TotalWorker']) ? $array['cp38TotalWorker'] : null;

        $this->officerSignature = isset($array['officerSignature']) ? $array['officerSignature'] : null;
        $this->officerName = isset($array['officerName']) ? $array['officerName'] : null;
        $this->officerIcNo = isset($array['officerIcNo']) ? $array['officerIcNo'] : null;
        $this->officerPosition = isset($array['officerPosition']) ? $array['officerPosition'] : null;
        $this->officerNoTel = isset($array['officerNoTel']) ? $array['officerNoTel'] : null;

        $this->incomeTaxNo = isset($array['incomeTaxNo']) ? $array['incomeTaxNo'] : null;
        $this->name = isset($array['name']) ? $array['name'] : null;
        $this->oldIcNo = isset($array['oldIcNo']) ? $array['oldIcNo'] : null;
        $this->newIcNo = isset($array['newIcNo']) ? $array['newIcNo'] : null;
        $this->staffNo = isset($array['staffNo']) ? $array['staffNo'] : null;
        $this->foreignerPassportNo = isset($array['foreignerPassportNo']) ? $array['foreignerPassportNo'] : null;
        $this->foreignerCountry = isset($array['foreignerCountry']) ? $array['foreignerCountry'] : null;
        $this->pcbAmount = isset($array['pcbAmount']) ? $array['pcbAmount'] : 0.00;
        $this->cp38Amount = isset($array['cp38Amount']) ? $array['cp38Amount'] : 0.00;
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
        setlocale(LC_TIME, 'Malay_Malaysia');
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
    public function getEmployerNoE()
    {
        return $this->employerNoE;
    }

    /**
     * @param mixed|null $employerNoE
     */
    public function setEmployerNoE( $employerNoE)
    {
        $this->employerNoE = $employerNoE;
    }

    public function getEmployerNoEArr()
    {
        if(strlen($this->employerNoE) != 0){
            $this->employerNoEArr = str_split($this->employerNoE);
            return $this->employerNoEArr;
        }else{
            return $this->employerNoEArr = array();
        }
    }

    /**
     * @return mixed|null
     */
    public function getPcbTotalCut()
    {
        return $this->pcbTotalCut;
    }

    /**
     * @param mixed|null $pcbTotalCut
     */
    public function setPcbTotalCut( $pcbTotalCut)
    {
        $this->pcbTotalCut = $pcbTotalCut;
    }

    /**
     * @return mixed|null
     */
    public function getPcbTotalWorker()
    {
        return $this->pcbTotalWorker;
    }

    /**
     * @param mixed|null $pcbTotalWorker
     */
    public function setPcbTotalWorker( $pcbTotalWorker)
    {
        $this->pcbTotalWorker = $pcbTotalWorker;
    }

    /**
     * @return mixed|null
     */
    public function getPcbTotalAmount()
    {
        return $this->pcbTotalAmount;
    }

    /**
     * @param mixed|null $pcbTotalAmount
     */
    public function setPcbTotalAmount( $pcbTotalAmount)
    {
        $this->pcbTotalAmount = $pcbTotalAmount;
    }

    /**
     * @return mixed|null
     */
    public function getPcbBranchNo()
    {
        return $this->pcbBranchNo;
    }

    /**
     * @param mixed|null $pcbBranchNo
     */
    public function setPcbBranchNo( $pcbBranchNo)
    {
        $this->pcbBranchNo = $pcbBranchNo;
    }

    /**
     * @return mixed|null
     */
    public function getPcbDate()
    {
        return $this->pcbDate;
    }

    /**
     * @param mixed|null $pcbDate
     */
    public function setPcbDate( $pcbDate)
    {
        $this->pcbDate = $pcbDate;
    }

    /**
     * @return mixed|null
     */
    public function getCp38TotalCut()
    {
        return $this->cp38TotalCut;
    }

    /**
     * @param mixed|null $cp38TotalCut
     */
    public function setCp38TotalCut( $cp38TotalCut)
    {
        $this->cp38TotalCut = $cp38TotalCut;
    }

    /**
     * @return mixed|null
     */
    public function getCp38TotalWorker()
    {
        return $this->cp38TotalWorker;
    }

    /**
     * @param mixed|null $cp38TotalWorker
     */
    public function setCp38TotalWorker( $cp38TotalWorker)
    {
        $this->cp38TotalWorker = $cp38TotalWorker;
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
    public function getOfficerIcNo()
    {
        return $this->officerIcNo;
    }

    /**
     * @param mixed|null $officerIcNo
     */
    public function setOfficerIcNo( $officerIcNo)
    {
        $this->officerIcNo = $officerIcNo;
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
     * @return mixed|string
     */
    public function getIncomeTaxNo()
    {
        return $this->incomeTaxNo;
    }

    /**
     * @param mixed|string $incomeTaxNo
     */
    public function setIncomeTaxNo($incomeTaxNo)
    {
        $this->incomeTaxNo = $incomeTaxNo;
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed|null $name
     */
    public function setName( $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed|string
     */
    public function getOldIcNo()
    {
        return $this->oldIcNo;
    }

    /**
     * @param mixed|string $oldIcNo
     */
    public function setOldIcNo($oldIcNo)
    {
        $this->oldIcNo = $oldIcNo;
    }

    /**
     * @return mixed|string
     */
    public function getNewIcNo()
    {
        return $this->newIcNo;
    }

    /**
     * @param mixed|string $newIcNo
     */
    public function setNewIcNo($newIcNo)
    {
        $this->newIcNo = $newIcNo;
    }

    /**
     * @return mixed|string
     */
    public function getStaffNo()
    {
        return $this->staffNo;
    }

    /**
     * @param mixed|string $staffNo
     */
    public function setStaffNo($staffNo)
    {
        $this->staffNo = $staffNo;
    }

    /**
     * @return mixed|string
     */
    public function getForeignerPassportNo()
    {
        return $this->foreignerPassportNo;
    }

    /**
     * @param mixed|string $foreignerPassportNo
     */
    public function setForeignerPassportNo($foreignerPassportNo)
    {
        $this->foreignerPassportNo = $foreignerPassportNo;
    }

    /**
     * @return mixed|string
     */
    public function getForeignerCountry()
    {
        return $this->foreignerCountry;
    }

    /**
     * @param mixed|string $foreignerCountry
     */
    public function setForeignerCountry($foreignerCountry)
    {
        $this->foreignerCountry = $foreignerCountry;
    }

    /**
     * @return mixed|string
     */
    public function getPcbAmount()
    {
        return $this->pcbAmount;
    }

    /**
     * @param mixed|string $pcbAmount
     */
    public function setPcbAmount($pcbAmount)
    {
        $this->pcbAmount = $pcbAmount;
    }

    /**
     * @return mixed|string
     */
    public function getCp38Amount()
    {
        return $this->cp38Amount;
    }

    /**
     * @param mixed|string $cp38Amount
     */
    public function setCp38Amount($cp38Amount)
    {
        $this->cp38Amount = $cp38Amount;
    }


    public function toArray() {
        return [
            'companyName' => $this->companyName,
            'companyRegistrationNo' => $this->companyRegistrationNo,
            'companyAddress1' => $this->companyAddress1,
            'companyAddress2' => $this->companyAddress2,
            'companyAddress3' => $this->companyAddress3,
            'companyPostcode' => $this->companyPostcode,

            'month' => $this->month,
            'year' => $this->year,

            'employerNoE' => $this->employerNoE,
            'pcbTotalCut' => $this->pcbTotalCut,
            'pcbTotalWorker' => $this->pcbTotalWorker,
            'pcbTotalAmount' => $this->pcbTotalAmount,
            'pcbBranchNo' => $this->pcbBranchNo,
            'pcbDate' => $this->pcbDate,
            'cp38TotalCut' => $this->cp38TotalCut,
            'cp38TotalWorker' => $this->cp38TotalWorker,

            'officerSignature' => $this->officerSignature,
            'officerName' => $this->officerName,
            'officerIcNo' => $this->officerIcNo,
            'officerPosition' => $this->officerPosition,
            'officerNoTel' => $this->officerNoTel,

            'incomeTaxNo' => $this->incomeTaxNo,
            'name' => $this->name,
            'oldIcNo' => $this->oldIcNo,
            'newIcNo' => $this->newIcNo,
            'staffNo' => $this->staffNo,
            'foreignerPassportNo' => $this->foreignerPassportNo,
            'foreignerCountry' => $this->foreignerCountry,
            'pcbAmount' => $this->pcbAmount,
            'cp38Amount' => $this->cp38Amount
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

}
