<?php
/**
 * Created by IntelliJ IDEA.
 * User: play
 * Date: 11/8/18
 * Time: 11:08 AM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class LhdnCP21Bean
{
    private $employerName;
    private $employerNoE;
    private $employerNoArr;
    private $employerAddress1;
    private $employerAddress2;
    private $employerAddress3;
    private $employerPostcode;
    private $employerNoTel;

    private $name_A; // 2 row
    private $dateOfCommencement_A;
    private $dateOfCommencementArr; //array
    private $address1_A;
    private $address2_A;
    private $address3_A;
    private $postcode_A;
    private $expectedDatetoLeaveMalaysia_A;
    private $expectedDatetoLeaveMalaysiaArr; //array
    private $xAddressBelongsToTaxAgent_A;
    private $ic_A;
    private $icArr; //array
    private $incomeTaxNo_A;
    private $incomeTaxNoArr; //array
    private $reasonLeaveMalaysia_A; // 2 row
    private $citizenship_A;
    private $dateOfBirth_A;
    private $dateOfBirthArr;
    private $placeOfBirth_A;
    private $addressOutMalaysia1_A;
    private $addressOutMalaysia2_A;
    private $addressOutMalaysia3_A;
    private $postcodeOutMalaysia_A;
    private $natureOfEmployment_A;
    private $telno_A;
    private $stateProbableDateofReturn_A;

    private $salaryFrom_B;
    private $salaryUntil_B;
    private $salaryAmount_B;
    private $leavePayFrom_B;
    private $leavePayUntil_B;
    private $leavePayAmount_B;
    private $commissionFrom_B;
    private $commissionUntil_B;
    private $commissionAmount_B;
    private $gratuityFrom_B;
    private $gratuityUntil_B;
    private $gratuityAmount_B;
    private $compensationFrom_B;
    private $compensationUntil_B;
    private $compensationAmount_B;
    private $cashAllowanceFrom_B;
    private $cashAllowanceUntil_B;
    private $cashAllowanceAmount_B;
    private $pensionFrom_B;
    private $pensionUntil_B;
    private $pensionAmount_B;
    private $benefitSubjectToTaxFrom_B;
    private $benefitSubjectToTaxUntil_B;
    private $benefitSubjectToTaxAmount_B;
    private $livingAccommodationFrom_B;
    private $livingAccommodationUntil_B;
    private $livingAccommodationAmount_B;
    private $otherAllowanceFrom_B;
    private $otherAllowanceUntil_B;
    private $otherAllowanceAmount_B;
    private $otherPaymentsFrom_B;
    private $otherPaymentsUntil_B;
    private $otherPaymentsAmount_B;
    private $total_B = 0; //default amount

    private $typeOfIncome1_C;
    private $typeOfIncome2_C;
    private $typeOfIncome3_C;
    private $yearForWhichPaid1_C;
    private $yearForWhichPaid2_C;
    private $yearForWhichPaid3_C;
    private $totalIncome1_C;
    private $totalIncome2_C;
    private $totalIncome3_C;
    private $pensionFund1_C;
    private $pensionFund2_C;
    private $pensionFund3_C;

    private $moneyWithheldByEmployer_D;
    private $monthlyTaxDeductions_D;
    private $amountOfZakatPaid_D;
    private $contributionsToEmployeeProvidentFund_D;

    private $officerName_E;
    private $officerDesignation_E;
    private $officerSignature_E;
    private $date_E;
    private $dateArr; //array

    public function __construct(array $array = []) {
        $this->employerName = isset($array['employerName']) ? $array['employerName'] : null;
        $this->employerNoE = isset($array['employerNoE']) ? $array['employerNoE'] : null;
        $this->employerAddress1 = isset($array['employerAddress1']) ? $array['employerAddress1'] : null;
        $this->employerAddress2 = isset($array['employerAddress2']) ? $array['employerAddress2'] : null;
        $this->employerAddress3 = isset($array['employerAddress3']) ? $array['employerAddress3'] : null;
        $this->employerPostcode = isset($array['employerPostcode']) ? $array['employerPostcode'] : null;
        $this->employerNoTel = isset($array['employerNoTel']) ? $array['employerNoTel'] : null;

        $this->name_A = isset($array['name_A']) ? $array['name_A'] : null;
        $this->dateOfCommencement_A = isset($array['dateOfCommencement_A']) ? $array['dateOfCommencement_A'] : null;
        $this->address1_A = isset($array['address1_A']) ? $array['address1_A'] : null;
        $this->address2_A = isset($array['address2_A']) ? $array['address2_A'] : null;
        $this->address3_A = isset($array['address3_A']) ? $array['address3_A'] : null;
        $this->postcode_A = isset($array['postcode_A']) ? $array['postcode_A'] : null;
        $this->expectedDatetoLeaveMalaysia_A = isset($array['expectedDatetoLeaveMalaysia_A']) ? $array['expectedDatetoLeaveMalaysia_A'] : null;
        $this->xAddressBelongsToTaxAgent_A = isset($array['xAddressBelongsToTaxAgent_A']) ? $array['xAddressBelongsToTaxAgent_A'] : null;
        $this->ic_A = isset($array['ic_A']) ? $array['ic_A'] : null;
        $this->incomeTaxNo_A = isset($array['incomeTaxNo_A']) ? $array['incomeTaxNo_A'] : null;
        $this->reasonLeaveMalaysia_A = isset($array['reasonLeaveMalaysia_A']) ? $array['reasonLeaveMalaysia_A'] : null;
        $this->citizenship_A = isset($array['citizenship_A']) ? $array['citizenship_A'] : null;
        $this->dateOfBirth_A = isset($array['dateOfBirth_A']) ? $array['dateOfBirth_A'] : null;
        $this->placeOfBirth_A = isset($array['placeOfBirth_A']) ? $array['placeOfBirth_A'] : null;
        $this->addressOutMalaysia1_A = isset($array['addressOutMalaysia1_A']) ? $array['addressOutMalaysia1_A'] : null;
        $this->addressOutMalaysia2_A = isset($array['addressOutMalaysia2_A']) ? $array['addressOutMalaysia2_A'] : null;
        $this->addressOutMalaysia3_A = isset($array['addressOutMalaysia3_A']) ? $array['addressOutMalaysia3_A'] : null;
        $this->postcodeOutMalaysia_A = isset($array['postcodeOutMalaysia_A']) ? $array['postcodeOutMalaysia_A'] : null;
        $this->natureOfEmployment_A = isset($array['natureOfEmployment_A']) ? $array['natureOfEmployment_A'] : null;
        $this->telno_A = isset($array['telno_A']) ? $array['telno_A'] : null;
        $this->stateProbableDateofReturn_A = isset($array['stateProbableDateofReturn_A']) ? $array['stateProbableDateofReturn_A'] : null;

        $this->salaryFrom_B = isset($array['salaryFrom_B']) ? $array['salaryFrom_B'] : null;
        $this->salaryUntil_B = isset($array['salaryUntil_B']) ? $array['salaryUntil_B'] : null;
        $this->leavePayFrom_B = isset($array['leavePayFrom_B']) ? $array['leavePayFrom_B'] : null;
        $this->leavePayUntil_B = isset($array['leavePayUntil_B']) ? $array['leavePayUntil_B'] : null;
        $this->commissionFrom_B = isset($array['commissionFrom_B']) ? $array['commissionFrom_B'] : null;
        $this->commissionUntil_B = isset($array['commissionUntil_B']) ? $array['commissionUntil_B'] : null;
        $this->gratuityFrom_B = isset($array['gratuityFrom_B']) ? $array['gratuityFrom_B'] : null;
        $this->gratuityUntil_B = isset($array['gratuityUntil_B']) ? $array['gratuityUntil_B'] : null;
        $this->compensationFrom_B = isset($array['compensationFrom_B']) ? $array['compensationFrom_B'] : null;
        $this->compensationUntil_B = isset($array['compensationUntil_B']) ? $array['compensationUntil_B'] : null;
        $this->cashAllowanceFrom_B = isset($array['cashAllowanceFrom_B']) ? $array['cashAllowanceFrom_B'] : null;
        $this->cashAllowanceUntil_B = isset($array['cashAllowanceUntil_B']) ? $array['cashAllowanceUntil_B'] : null;
        $this->pensionFrom_B = isset($array['pensionFrom_B']) ? $array['pensionFrom_B'] : null;
        $this->pensionUntil_B = isset($array['pensionUntil_B']) ? $array['pensionUntil_B'] : null;
        $this->benefitSubjectToTaxFrom_B = isset($array['benefitSubjectToTaxFrom_B']) ? $array['benefitSubjectToTaxFrom_B'] : null;
        $this->benefitSubjectToTaxUntil_B = isset($array['benefitSubjectToTaxUntil_B']) ? $array['benefitSubjectToTaxUntil_B'] : null;
        $this->livingAccommodationFrom_B = isset($array['livingAccommodationFrom_B']) ? $array['livingAccommodationFrom_B'] : null;
        $this->livingAccommodationUntil_B = isset($array['livingAccommodationUntil_B']) ? $array['livingAccommodationUntil_B'] : null;
        $this->otherAllowanceFrom_B = isset($array['otherAllowanceFrom_B']) ? $array['otherAllowanceFrom_B'] : null;
        $this->otherAllowanceUntil_B = isset($array['otherAllowanceUntil_B']) ? $array['otherAllowanceUntil_B'] : null;
        $this->otherPaymentsFrom_B = isset($array['otherPaymentsFrom_B']) ? $array['otherPaymentsFrom_B'] : null;
        $this->otherPaymentsUntil_B = isset($array['otherPaymentsUntil_B']) ? $array['otherPaymentsUntil_B'] : null;
        $this->salaryAmount_B = isset($array['salaryAmount_B']) ? $array['salaryAmount_B'] : null;
        $this->leavePayAmount_B = isset($array['leavePayAmount_B']) ? $array['leavePayAmount_B'] : null;
        $this->commissionAmount_B = isset($array['commissionAmount_B']) ? $array['commissionAmount_B'] : null;
        $this->gratuityAmount_B = isset($array['gratuityAmount_B']) ? $array['gratuityAmount_B'] : null;
        $this->compensationAmount_B = isset($array['compensationAmount_B']) ? $array['compensationAmount_B'] : null;
        $this->cashAllowanceAmount_B = isset($array['cashAllowanceAmount_B']) ? $array['cashAllowanceAmount_B'] : null;
        $this->pensionAmount_B = isset($array['pensionAmount_B']) ? $array['pensionAmount_B'] : null;
        $this->benefitSubjectToTaxAmount_B = isset($array['benefitSubjectToTaxAmount_B']) ? $array['benefitSubjectToTaxAmount_B'] : null;
        $this->livingAccommodationAmount_B = isset($array['livingAccommodationAmount_B']) ? $array['livingAccommodationAmount_B'] : null;
        $this->otherAllowanceAmount_B = isset($array['otherAllowanceAmount_B']) ? $array['otherAllowanceAmount_B'] : null;
        $this->otherPaymentsAmount_B = isset($array['otherPaymentsAmount_B']) ? $array['otherPaymentsAmount_B'] : null;

        $this->typeOfIncome1_C = isset($array['typeOfIncome1_C']) ? $array['typeOfIncome1_C'] : null;
        $this->typeOfIncome2_C = isset($array['typeOfIncome2_C']) ? $array['typeOfIncome2_C'] : null;
        $this->typeOfIncome3_C = isset($array['typeOfIncome3_C']) ? $array['typeOfIncome3_C'] : null;
        $this->yearForWhichPaid1_C = isset($array['yearForWhichPaid1_C']) ? $array['yearForWhichPaid1_C'] : null;
        $this->yearForWhichPaid2_C = isset($array['yearForWhichPaid2_C']) ? $array['yearForWhichPaid2_C'] : null;
        $this->yearForWhichPaid3_C = isset($array['yearForWhichPaid3_C']) ? $array['yearForWhichPaid3_C'] : null;
        $this->totalIncome1_C = isset($array['totalIncome1_C']) ? $array['totalIncome1_C'] : null;
        $this->totalIncome2_C = isset($array['totalIncome2_C']) ? $array['totalIncome2_C'] : null;
        $this->totalIncome3_C = isset($array['totalIncome3_C']) ? $array['totalIncome3_C'] : null;
        $this->pensionFund1_C = isset($array['pensionFund1_C']) ? $array['pensionFund1_C'] : null;
        $this->pensionFund2_C = isset($array['pensionFund2_C']) ? $array['pensionFund2_C'] : null;
        $this->pensionFund3_C = isset($array['pensionFund3_C']) ? $array['pensionFund3_C'] : null;

        $this->moneyWithheldByEmployer_D = isset($array['moneyWithheldByEmployer_D']) ? $array['moneyWithheldByEmployer_D'] : null;
        $this->monthlyTaxDeductions_D = isset($array['monthlyTaxDeductions_D']) ? $array['monthlyTaxDeductions_D'] : null;
        $this->amountOfZakatPaid_D = isset($array['amountOfZakatPaid_D']) ? $array['amountOfZakatPaid_D'] : null;
        $this->contributionsToEmployeeProvidentFund_D = isset($array['contributionsToEmployeeProvidentFund_D']) ? $array['contributionsToEmployeeProvidentFund_D'] : null;

        $this->officerName_E = isset($array['officerName_E']) ? $array['officerName_E'] : null;
        $this->officerDesignation_E = isset($array['officerDesignation_E']) ? $array['officerDesignation_E'] : null;
        $this->officerSignature_E = isset($array['officerSignature_E']) ? $array['officerSignature_E'] : null;
        $this->date_E = isset($array['date_E']) ? $array['date_E'] : null;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerName()
    {
        return $this->employerName;
    }

    /**
     * @param mixed|null $employerName
     */
    public function setEmployerName($employerName)
    {
        $this->employerName = $employerName;
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

    public function getEmployerNoArr(){
        if(strlen($this->employerNoE) != 0){
            $this->employerNoArr = str_split($this->employerNoE);
            return $this->employerNoArr;
        }else{
            return $this->employerNoArr = array();
        }
    }

    /**
     * @return mixed|null
     */
    public function getEmployerAddress1()
    {
        return $this->employerAddress1;
    }

    /**
     * @param mixed|null $employerAddress1
     */
    public function setEmployerAddress1($employerAddress1)
    {
        $this->employerAddress1 = $employerAddress1;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerAddress2()
    {
        return $this->employerAddress2;
    }

    /**
     * @param mixed|null $employerAddress2
     */
    public function setEmployerAddress2($employerAddress2)
    {
        $this->employerAddress2 = $employerAddress2;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerAddress3()
    {
        return $this->employerAddress3;
    }

    /**
     * @param mixed|null $employerAddress3
     */
    public function setEmployerAddress3( $employerAddress3)
    {
        $this->employerAddress3 = $employerAddress3;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerPostcode()
    {
        return $this->employerPostcode;
    }

    /**
     * @param mixed|null $employerPostcode
     */
    public function setEmployerPostcode( $employerPostcode)
    {
        $this->employerPostcode = $employerPostcode;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerNoTel()
    {
        return $this->employerNoTel;
    }

    /**
     * @param mixed|null $employerNoTel
     */
    public function setEmployerNoTel( $employerNoTel)
    {
        $this->employerNoTel = $employerNoTel;
    }

    /**
     * @return mixed|null
     */
    public function getNameA()
    {
        return $this->name_A;
    }

    /**
     * @param mixed|null $name_A
     */
    public function setNameA( $name_A)
    {
        $this->name_A = $name_A;
    }

    /**
     * @return mixed|null
     */
    public function getDateOfCommencementA()
    {
        return $this->dateOfCommencement_A;
    }

    /**
     * @param mixed|null $dateOfCommencement_A
     */
    public function setDateOfCommencementA( $dateOfCommencement_A)
    {
        $this->dateOfCommencement_A = $dateOfCommencement_A;
    }

    public function getDateOfCommencementArr(){
        if(strlen($this->dateOfCommencement_A) != 0){
            $this->dateOfCommencementArr = str_split($this->dateOfCommencement_A);
            return $this->dateOfCommencementArr;
        }else{
            return $this->dateOfCommencementArr = array();
        }
    }

    /**
     * @return mixed|null
     */
    public function getAddress1A()
    {
        return $this->address1_A;
    }

    /**
     * @param mixed|null $address1_A
     */
    public function setAddress1A( $address1_A)
    {
        $this->address1_A = $address1_A;
    }

    /**
     * @return mixed|null
     */
    public function getAddress2A()
    {
        return $this->address2_A;
    }

    /**
     * @param mixed|null $address2_A
     */
    public function setAddress2A( $address2_A)
    {
        $this->address2_A = $address2_A;
    }

    /**
     * @return mixed|null
     */
    public function getAddress3A()
    {
        return $this->address3_A;
    }

    /**
     * @param mixed|null $address3_A
     */
    public function setAddress3A( $address3_A)
    {
        $this->address3_A = $address3_A;
    }

    /**
     * @return mixed|null
     */
    public function getPostcodeA()
    {
        return $this->postcode_A;
    }

    /**
     * @param mixed|null $postcode_A
     */
    public function setPostcodeA( $postcode_A)
    {
        $this->postcode_A = $postcode_A;
    }

    /**
     * @return mixed|null
     */
    public function getExpectedDatetoLeaveMalaysiaA()
    {
        return $this->expectedDatetoLeaveMalaysia_A;
    }

    /**
     * @param mixed|null $expectedDatetoLeaveMalaysia_A
     */
    public function setExpectedDatetoLeaveMalaysiaA( $expectedDatetoLeaveMalaysia_A)
    {
        $this->expectedDatetoLeaveMalaysia_A = $expectedDatetoLeaveMalaysia_A;
    }

    public function getExpectedDatetoLeaveMalaysiaArr(){
        if(strlen($this->expectedDatetoLeaveMalaysia_A) != 0){
            $this->expectedDatetoLeaveMalaysiaArr = str_split($this->expectedDatetoLeaveMalaysia_A);
            return $this->expectedDatetoLeaveMalaysiaArr;
        }else{
            return $this->expectedDatetoLeaveMalaysiaArr = array();
        }
    }

    /**
     * @return mixed|null
     */
    public function getXAddressBelongsToTaxAgentA()
    {
        return $this->xAddressBelongsToTaxAgent_A;
    }

    /**
     * @param mixed|null $xAddressBelongsToTaxAgent_A
     */
    public function setXAddressBelongsToTaxAgentA( $xAddressBelongsToTaxAgent_A)
    {
        $this->xAddressBelongsToTaxAgent_A = $xAddressBelongsToTaxAgent_A;
    }

    /**
     * @return mixed|null
     */
    public function getIcA()
    {
        return $this->ic_A;
    }

    /**
     * @param mixed|null $ic_A
     */
    public function setIcA( $ic_A)
    {
        $this->ic_A = $ic_A;
    }

    public function getIcArr(){
        if(strlen($this->ic_A) != 0){
            $this->icArr = str_split($this->ic_A);
            return $this->icArr;
        }else{
            return $this->icArr = array();
        }
    }

    /**
     * @return mixed|null
     */
    public function getIncomeTaxNoA()
    {
        return $this->incomeTaxNo_A;
    }

    /**
     * @param mixed|null $incomeTaxNo_A
     */
    public function setIncomeTaxNoA( $incomeTaxNo_A)
    {
        $this->incomeTaxNo_A = $incomeTaxNo_A;
    }

    public function getIncomeTaxNoArr(){
        if(strlen($this->incomeTaxNo_A) != 0){
            $this->incomeTaxNoArr = str_split($this->incomeTaxNo_A);
            return $this->incomeTaxNoArr;
        }else{
            return $this->incomeTaxNoArr = array();
        }
    }

    /**
     * @return mixed|null
     */
    public function getReasonLeaveMalaysiaA()
    {
        return $this->reasonLeaveMalaysia_A;
    }

    /**
     * @param mixed|null $reasonLeaveMalaysia_A
     */
    public function setReasonLeaveMalaysiaA( $reasonLeaveMalaysia_A)
    {
        $this->reasonLeaveMalaysia_A = $reasonLeaveMalaysia_A;
    }

    /**
     * @return mixed|null
     */
    public function getCitizenshipA()
    {
        return $this->citizenship_A;
    }

    /**
     * @param mixed|null $citizenship_A
     */
    public function setCitizenshipA( $citizenship_A)
    {
        $this->citizenship_A = $citizenship_A;
    }

    /**
     * @return mixed|null
     */
    public function getDateOfBirthA()
    {
        return $this->dateOfBirth_A;
    }

    /**
     * @param mixed|null $dateOfBirth_A
     */
    public function setDateOfBirthA( $dateOfBirth_A)
    {
        $this->dateOfBirth_A = $dateOfBirth_A;
    }

    public function getDateOfBirthArr(){
        if(strlen($this->dateOfBirth_A) != 0){
            $this->dateOfBirthArr = str_split($this->dateOfBirth_A);
            return $this->dateOfBirthArr;
        }else{
            return $this->dateOfBirthArr = array();
        }
    }

    /**
     * @return mixed|null
     */
    public function getPlaceOfBirthA()
    {
        return $this->placeOfBirth_A;
    }

    /**
     * @param mixed|null $placeOfBirth_A
     */
    public function setPlaceOfBirthA( $placeOfBirth_A)
    {
        $this->placeOfBirth_A = $placeOfBirth_A;
    }

    /**
     * @return mixed|null
     */
    public function getAddressOutMalaysia1A()
    {
        return $this->addressOutMalaysia1_A;
    }

    /**
     * @param mixed|null $addressOutMalaysia1_A
     */
    public function setAddressOutMalaysia1A( $addressOutMalaysia1_A)
    {
        $this->addressOutMalaysia1_A = $addressOutMalaysia1_A;
    }

    /**
     * @return mixed|null
     */
    public function getAddressOutMalaysia2A()
    {
        return $this->addressOutMalaysia2_A;
    }

    /**
     * @param mixed|null $addressOutMalaysia2_A
     */
    public function setAddressOutMalaysia2A( $addressOutMalaysia2_A)
    {
        $this->addressOutMalaysia2_A = $addressOutMalaysia2_A;
    }

    /**
     * @return mixed|null
     */
    public function getAddressOutMalaysia3A()
    {
        return $this->addressOutMalaysia3_A;
    }

    /**
     * @param mixed|null $addressOutMalaysia3_A
     */
    public function setAddressOutMalaysia3A( $addressOutMalaysia3_A)
    {
        $this->addressOutMalaysia3_A = $addressOutMalaysia3_A;
    }

    /**
     * @return mixed|null
     */
    public function getPostcodeOutMalaysiaA()
    {
        return $this->postcodeOutMalaysia_A;
    }

    /**
     * @param mixed|null $postcodeOutMalaysia_A
     */
    public function setPostcodeOutMalaysiaA( $postcodeOutMalaysia_A)
    {
        $this->postcodeOutMalaysia_A = $postcodeOutMalaysia_A;
    }


    /**
     * @return mixed
     */
    public function getNatureOfEmploymentA()
    {
        return $this->natureOfEmployment_A;
    }

    /**
     * @param mixed $natureOfEmployment_A
     */
    public function setNatureOfEmploymentA($natureOfEmployment_A)
    {
        $this->natureOfEmployment_A = $natureOfEmployment_A;
    }

    /**
     * @return mixed|null
     */
    public function getTelnoA()
    {
        return $this->telno_A;
    }

    /**
     * @param mixed|null $telno_A
     */
    public function setTelnoA( $telno_A)
    {
        $this->telno_A = $telno_A;
    }

    /**
     * @return mixed|null
     */
    public function getStateProbableDateofReturnA()
    {
        return $this->stateProbableDateofReturn_A;
    }

    /**
     * @param mixed|null $stateProbableDateofReturn_A
     */
    public function setStateProbableDateofReturnA( $stateProbableDateofReturn_A)
    {
        $this->stateProbableDateofReturn_A = $stateProbableDateofReturn_A;
    }

    /**
     * @return mixed|null
     */
    public function getSalaryFromB()
    {
        return $this->salaryFrom_B;
    }

    /**
     * @param mixed|null $salaryFrom_B
     */
    public function setSalaryFromB( $salaryFrom_B)
    {
        $this->salaryFrom_B = $salaryFrom_B;
    }

    /**
     * @return mixed|null
     */
    public function getSalaryUntilB()
    {
        return $this->salaryUntil_B;
    }

    /**
     * @param mixed|null $salaryUntil_B
     */
    public function setSalaryUntilB( $salaryUntil_B)
    {
        $this->salaryUntil_B = $salaryUntil_B;
    }

    /**
     * @return mixed|null
     */
    public function getLeavePayFromB()
    {
        return $this->leavePayFrom_B;
    }

    /**
     * @param mixed|null $leavePayFrom_B
     */
    public function setLeavePayFromB( $leavePayFrom_B)
    {
        $this->leavePayFrom_B = $leavePayFrom_B;
    }

    /**
     * @return mixed|null
     */
    public function getLeavePayUntilB()
    {
        return $this->leavePayUntil_B;
    }

    /**
     * @param mixed|null $leavePayUntil_B
     */
    public function setLeavePayUntilB( $leavePayUntil_B)
    {
        $this->leavePayUntil_B = $leavePayUntil_B;
    }

    /**
     * @return mixed|null
     */
    public function getCommissionFromB()
    {
        return $this->commissionFrom_B;
    }

    /**
     * @param mixed|null $commissionFrom_B
     */
    public function setCommissionFromB( $commissionFrom_B)
    {
        $this->commissionFrom_B = $commissionFrom_B;
    }

    /**
     * @return mixed|null
     */
    public function getCommissionUntilB()
    {
        return $this->commissionUntil_B;
    }

    /**
     * @param mixed|null $commissionUntil_B
     */
    public function setCommissionUntilB( $commissionUntil_B)
    {
        $this->commissionUntil_B = $commissionUntil_B;
    }

    /**
     * @return mixed|null
     */
    public function getGratuityFromB()
    {
        return $this->gratuityFrom_B;
    }

    /**
     * @param mixed|null $gratuityFrom_B
     */
    public function setGratuityFromB( $gratuityFrom_B)
    {
        $this->gratuityFrom_B = $gratuityFrom_B;
    }

    /**
     * @return mixed|null
     */
    public function getGratuityUntilB()
    {
        return $this->gratuityUntil_B;
    }

    /**
     * @param mixed|null $gratuityUntil_B
     */
    public function setGratuityUntilB( $gratuityUntil_B)
    {
        $this->gratuityUntil_B = $gratuityUntil_B;
    }

    /**
     * @return mixed|null
     */
    public function getCompensationFromB()
    {
        return $this->compensationFrom_B;
    }

    /**
     * @param mixed|null $compensationFrom_B
     */
    public function setCompensationFromB( $compensationFrom_B)
    {
        $this->compensationFrom_B = $compensationFrom_B;
    }

    /**
     * @return mixed|null
     */
    public function getCompensationUntilB()
    {
        return $this->compensationUntil_B;
    }

    /**
     * @param mixed|null $compensationUntil_B
     */
    public function setCompensationUntilB( $compensationUntil_B)
    {
        $this->compensationUntil_B = $compensationUntil_B;
    }

    /**
     * @return mixed|null
     */
    public function getCashAllowanceFromB()
    {
        return $this->cashAllowanceFrom_B;
    }

    /**
     * @param mixed|null $cashAllowanceFrom_B
     */
    public function setCashAllowanceFromB( $cashAllowanceFrom_B)
    {
        $this->cashAllowanceFrom_B = $cashAllowanceFrom_B;
    }

    /**
     * @return mixed|null
     */
    public function getCashAllowanceUntilB()
    {
        return $this->cashAllowanceUntil_B;
    }

    /**
     * @param mixed|null $cashAllowanceUntil_B
     */
    public function setCashAllowanceUntilB( $cashAllowanceUntil_B)
    {
        $this->cashAllowanceUntil_B = $cashAllowanceUntil_B;
    }

    /**
     * @return mixed|null
     */
    public function getPensionFromB()
    {
        return $this->pensionFrom_B;
    }

    /**
     * @param mixed|null $pensionFrom_B
     */
    public function setPensionFromB( $pensionFrom_B)
    {
        $this->pensionFrom_B = $pensionFrom_B;
    }

    /**
     * @return mixed|null
     */
    public function getPensionUntilB()
    {
        return $this->pensionUntil_B;
    }

    /**
     * @param mixed|null $pensionUntil_B
     */
    public function setPensionUntilB( $pensionUntil_B)
    {
        $this->pensionUntil_B = $pensionUntil_B;
    }

    /**
     * @return mixed|null
     */
    public function getBenefitSubjectToTaxFromB()
    {
        return $this->benefitSubjectToTaxFrom_B;
    }

    /**
     * @param mixed|null $benefitSubjectToTaxFrom_B
     */
    public function setBenefitSubjectToTaxFromB( $benefitSubjectToTaxFrom_B)
    {
        $this->benefitSubjectToTaxFrom_B = $benefitSubjectToTaxFrom_B;
    }

    /**
     * @return mixed|null
     */
    public function getBenefitSubjectToTaxUntilB()
    {
        return $this->benefitSubjectToTaxUntil_B;
    }

    /**
     * @param mixed|null $benefitSubjectToTaxUntil_B
     */
    public function setBenefitSubjectToTaxUntilB( $benefitSubjectToTaxUntil_B)
    {
        $this->benefitSubjectToTaxUntil_B = $benefitSubjectToTaxUntil_B;
    }

    /**
     * @return mixed|null
     */
    public function getLivingAccommodationFromB()
    {
        return $this->livingAccommodationFrom_B;
    }

    /**
     * @param mixed|null $livingAccommodationFrom_B
     */
    public function setLivingAccommodationFromB( $livingAccommodationFrom_B)
    {
        $this->livingAccommodationFrom_B = $livingAccommodationFrom_B;
    }

    /**
     * @return mixed|null
     */
    public function getLivingAccommodationUntilB()
    {
        return $this->livingAccommodationUntil_B;
    }

    /**
     * @param mixed|null $livingAccommodationUntil_B
     */
    public function setLivingAccommodationUntilB( $livingAccommodationUntil_B)
    {
        $this->livingAccommodationUntil_B = $livingAccommodationUntil_B;
    }

    /**
     * @return mixed|null
     */
    public function getOtherAllowanceFromB()
    {
        return $this->otherAllowanceFrom_B;
    }

    /**
     * @param mixed|null $otherAllowanceFrom_B
     */
    public function setOtherAllowanceFromB( $otherAllowanceFrom_B)
    {
        $this->otherAllowanceFrom_B = $otherAllowanceFrom_B;
    }

    /**
     * @return mixed|null
     */
    public function getOtherAllowanceUntilB()
    {
        return $this->otherAllowanceUntil_B;
    }

    /**
     * @param mixed|null $otherAllowanceUntil_B
     */
    public function setOtherAllowanceUntilB( $otherAllowanceUntil_B)
    {
        $this->otherAllowanceUntil_B = $otherAllowanceUntil_B;
    }

    /**
     * @return mixed|null
     */
    public function getOtherPaymentsFromB()
    {
        return $this->otherPaymentsFrom_B;
    }

    /**
     * @param mixed|null $otherPaymentsFrom_B
     */
    public function setOtherPaymentsFromB( $otherPaymentsFrom_B)
    {
        $this->otherPaymentsFrom_B = $otherPaymentsFrom_B;
    }

    /**
     * @return mixed|null
     */
    public function getOtherPaymentsUntilB()
    {
        return $this->otherPaymentsUntil_B;
    }

    /**
     * @param mixed|null $otherPaymentsUntil_B
     */
    public function setOtherPaymentsUntilB( $otherPaymentsUntil_B)
    {
        $this->otherPaymentsUntil_B = $otherPaymentsUntil_B;
    }

    /**
     * @return mixed|null
     */
    public function getTotalB()
    {
        $this->total_B =
            $this->salaryAmount_B +
            $this->leavePayAmount_B +
            $this->commissionAmount_B +
            $this->gratuityAmount_B +
            $this->compensationAmount_B +
            $this->cashAllowanceAmount_B +
            $this->pensionAmount_B +
            $this->benefitSubjectToTaxAmount_B +
            $this->livingAccommodationAmount_B +
            $this->otherAllowanceAmount_B +
            $this->otherPaymentsAmount_B;

        return $this->total_B;
    }

    /**
     * @return mixed|null
     */
    public function getTypeOfIncome1C()
    {
        return $this->typeOfIncome1_C;
    }

    /**
     * @param mixed|null $typeOfIncome1_C
     */
    public function setTypeOfIncome1C( $typeOfIncome1_C)
    {
        $this->typeOfIncome1_C = $typeOfIncome1_C;
    }

    /**
     * @return mixed|null
     */
    public function getTypeOfIncome2C()
    {
        return $this->typeOfIncome2_C;
    }

    /**
     * @param mixed|null $typeOfIncome2_C
     */
    public function setTypeOfIncome2C( $typeOfIncome2_C)
    {
        $this->typeOfIncome2_C = $typeOfIncome2_C;
    }

    /**
     * @return mixed|null
     */
    public function getTypeOfIncome3C()
    {
        return $this->typeOfIncome3_C;
    }

    /**
     * @param mixed|null $typeOfIncome3_C
     */
    public function setTypeOfIncome3C( $typeOfIncome3_C)
    {
        $this->typeOfIncome3_C = $typeOfIncome3_C;
    }

    /**
     * @return mixed|null
     */
    public function getYearForWhichPaid1C()
    {
        return $this->yearForWhichPaid1_C;
    }

    /**
     * @param mixed|null $yearForWhichPaid1_C
     */
    public function setYearForWhichPaid1C( $yearForWhichPaid1_C)
    {
        $this->yearForWhichPaid1_C = $yearForWhichPaid1_C;
    }

    /**
     * @return mixed|null
     */
    public function getYearForWhichPaid2C()
    {
        return $this->yearForWhichPaid2_C;
    }

    /**
     * @param mixed|null $yearForWhichPaid2_C
     */
    public function setYearForWhichPaid2C( $yearForWhichPaid2_C)
    {
        $this->yearForWhichPaid2_C = $yearForWhichPaid2_C;
    }

    /**
     * @return mixed|null
     */
    public function getYearForWhichPaid3C()
    {
        return $this->yearForWhichPaid3_C;
    }

    /**
     * @param mixed|null $yearForWhichPaid3_C
     */
    public function setYearForWhichPaid3C( $yearForWhichPaid3_C)
    {
        $this->yearForWhichPaid3_C = $yearForWhichPaid3_C;
    }

    /**
     * @return mixed|null
     */
    public function getTotalIncome1C()
    {
        return $this->totalIncome1_C;
    }

    /**
     * @param mixed|null $totalIncome1_C
     */
    public function setTotalIncome1C( $totalIncome1_C)
    {
        $this->totalIncome1_C = $totalIncome1_C;
    }

    /**
     * @return mixed|null
     */
    public function getTotalIncome2C()
    {
        return $this->totalIncome2_C;
    }

    /**
     * @param mixed|null $totalIncome2_C
     */
    public function setTotalIncome2C( $totalIncome2_C)
    {
        $this->totalIncome2_C = $totalIncome2_C;
    }

    /**
     * @return mixed|null
     */
    public function getTotalIncome3C()
    {
        return $this->totalIncome3_C;
    }

    /**
     * @param mixed|null $totalIncome3_C
     */
    public function setTotalIncome3C( $totalIncome3_C)
    {
        $this->totalIncome3_C = $totalIncome3_C;
    }

    /**
     * @return mixed|null
     */
    public function getPensionFund1C()
    {
        return $this->pensionFund1_C;
    }

    /**
     * @param mixed|null $pensionFund1_C
     */
    public function setPensionFund1C( $pensionFund1_C)
    {
        $this->pensionFund1_C = $pensionFund1_C;
    }

    /**
     * @return mixed|null
     */
    public function getPensionFund2C()
    {
        return $this->pensionFund2_C;
    }

    /**
     * @param mixed|null $pensionFund2_C
     */
    public function setPensionFund2C( $pensionFund2_C)
    {
        $this->pensionFund2_C = $pensionFund2_C;
    }

    /**
     * @return mixed|null
     */
    public function getPensionFund3C()
    {
        return $this->pensionFund3_C;
    }

    /**
     * @param mixed|null $pensionFund3_C
     */
    public function setPensionFund3C( $pensionFund3_C)
    {
        $this->pensionFund3_C = $pensionFund3_C;
    }

    /**
     * @return mixed|null
     */
    public function getMoneyWithheldByEmployerD()
    {
        return $this->moneyWithheldByEmployer_D;
    }

    /**
     * @param mixed|null $moneyWithheldByEmployer_D
     */
    public function setMoneyWithheldByEmployerD( $moneyWithheldByEmployer_D)
    {
        $this->moneyWithheldByEmployer_D = $moneyWithheldByEmployer_D;
    }

    /**
     * @return mixed|null
     */
    public function getMonthlyTaxDeductionsD()
    {
        return $this->monthlyTaxDeductions_D;
    }

    /**
     * @param mixed|null $monthlyTaxDeductions_D
     */
    public function setMonthlyTaxDeductionsD( $monthlyTaxDeductions_D)
    {
        $this->monthlyTaxDeductions_D = $monthlyTaxDeductions_D;
    }

    /**
     * @return mixed|null
     */
    public function getAmountOfZakatPaidD()
    {
        return $this->amountOfZakatPaid_D;
    }

    /**
     * @param mixed|null $amountOfZakatPaid_D
     */
    public function setAmountOfZakatPaidD( $amountOfZakatPaid_D)
    {
        $this->amountOfZakatPaid_D = $amountOfZakatPaid_D;
    }

    /**
     * @return mixed|null
     */
    public function getContributionsToEmployeeProvidentFundD()
    {
        return $this->contributionsToEmployeeProvidentFund_D;
    }

    /**
     * @param mixed|null $contributionsToEmployeeProvidentFund_D
     */
    public function setContributionsToEmployeeProvidentFundD( $contributionsToEmployeeProvidentFund_D)
    {
        $this->contributionsToEmployeeProvidentFund_D = $contributionsToEmployeeProvidentFund_D;
    }

    /**
     * @return mixed|null
     */
    public function getOfficerNameE()
    {
        return $this->officerName_E;
    }

    /**
     * @param mixed|null $officerName_E
     */
    public function setOfficerNameE( $officerName_E)
    {
        $this->officerName_E = $officerName_E;
    }

    /**
     * @return mixed|null
     */
    public function getOfficerDesignationE()
    {
        return $this->officerDesignation_E;
    }

    /**
     * @param mixed|null $officerDesignation_E
     */
    public function setOfficerDesignationE( $officerDesignation_E)
    {
        $this->officerDesignation_E = $officerDesignation_E;
    }

    /**
     * @return mixed|null
     */
    public function getOfficerSignatureE()
    {
        return $this->officerSignature_E;
    }

    /**
     * @param mixed|null $officerSignature_E
     */
    public function setOfficerSignatureE( $officerSignature_E)
    {
        $this->officerSignature_E = $officerSignature_E;
    }

    /**
     * @return mixed|null
     */
    public function getDateE()
    {
        return $this->date_E;
    }

    /**
     * @param mixed|null $date_E
     */
    public function setDateE( $date_E)
    {
        $this->date_E = $date_E;
    }

    public function getDateArr(){
        if(strlen($this->date_E) != 0){
            $this->dateArr = str_split($this->date_E);
            return $this->dateArr;
        }else{
            return $this->dateArr = array();
        }
    }

    /**
     * @return mixed
     */
    public function getSalaryAmountB()
    {
        return $this->salaryAmount_B;
    }

    /**
     * @param mixed $salaryAmount_B
     */
    public function setSalaryAmountB($salaryAmount_B)
    {
        $this->salaryAmount_B = $salaryAmount_B;
    }

    /**
     * @return mixed
     */
    public function getLeavePayAmountB()
    {
        return $this->leavePayAmount_B;
    }

    /**
     * @param mixed $leavePayAmount_B
     */
    public function setLeavePayAmountB($leavePayAmount_B)
    {
        $this->leavePayAmount_B = $leavePayAmount_B;
    }

    /**
     * @return mixed
     */
    public function getCommissionAmountB()
    {
        return $this->commissionAmount_B;
    }

    /**
     * @param mixed $commissionAmount_B
     */
    public function setCommissionAmountB($commissionAmount_B)
    {
        $this->commissionAmount_B = $commissionAmount_B;
    }

    /**
     * @return mixed
     */
    public function getGratuityAmountB()
    {
        return $this->gratuityAmount_B;
    }

    /**
     * @param mixed $gratuityAmount_B
     */
    public function setGratuityAmountB($gratuityAmount_B)
    {
        $this->gratuityAmount_B = $gratuityAmount_B;
    }

    /**
     * @return mixed
     */
    public function getCompensationAmountB()
    {
        return $this->compensationAmount_B;
    }

    /**
     * @param mixed $compensationAmount_B
     */
    public function setCompensationAmountB($compensationAmount_B)
    {
        $this->compensationAmount_B = $compensationAmount_B;
    }

    /**
     * @return mixed
     */
    public function getCashAllowanceAmountB()
    {
        return $this->cashAllowanceAmount_B;
    }

    /**
     * @param mixed $cashAllowanceAmount_B
     */
    public function setCashAllowanceAmountB($cashAllowanceAmount_B)
    {
        $this->cashAllowanceAmount_B = $cashAllowanceAmount_B;
    }

    /**
     * @return mixed
     */
    public function getPensionAmountB()
    {
        return $this->pensionAmount_B;
    }

    /**
     * @param mixed $pensionAmount_B
     */
    public function setPensionAmountB($pensionAmount_B)
    {
        $this->pensionAmount_B = $pensionAmount_B;
    }

    /**
     * @return mixed
     */
    public function getBenefitSubjectToTaxAmountB()
    {
        return $this->benefitSubjectToTaxAmount_B;
    }

    /**
     * @param mixed $benefitSubjectToTaxAmount_B
     */
    public function setBenefitSubjectToTaxAmountB($benefitSubjectToTaxAmount_B)
    {
        $this->benefitSubjectToTaxAmount_B = $benefitSubjectToTaxAmount_B;
    }

    /**
     * @return mixed
     */
    public function getLivingAccommodationAmountB()
    {
        return $this->livingAccommodationAmount_B;
    }

    /**
     * @param mixed $livingAccommodationAmount_B
     */
    public function setLivingAccommodationAmountB($livingAccommodationAmount_B)
    {
        $this->livingAccommodationAmount_B = $livingAccommodationAmount_B;
    }

    /**
     * @return mixed
     */
    public function getOtherAllowanceAmountB()
    {
        return $this->otherAllowanceAmount_B;
    }

    /**
     * @param mixed $otherAllowanceAmount_B
     */
    public function setOtherAllowanceAmountB($otherAllowanceAmount_B)
    {
        $this->otherAllowanceAmount_B = $otherAllowanceAmount_B;
    }

    /**
     * @return mixed
     */
    public function getOtherPaymentsAmountB()
    {
        return $this->otherPaymentsAmount_B;
    }

    /**
     * @param mixed $otherPaymentsAmount_B
     */
    public function setOtherPaymentsAmountB($otherPaymentsAmount_B)
    {
        $this->otherPaymentsAmount_B = $otherPaymentsAmount_B;
    }

    public function toArray() {
        return [
            'employerName' => $this->employerName,
            'employerNoE' => $this->employerNoE,
            'employerAddress1' => $this->employerAddress1,
            'employerAddress2' => $this->employerAddress2,
            'employerAddress3' => $this->employerAddress3,
            'employerPostcode' => $this->employerPostcode,
            'employerNoTel' => $this->employerNoTel,

            'name_A' => $this->name_A,
            'dateOfCommencement_A' => $this->dateOfCommencement_A,
            'address1_A' => $this->address1_A,
            'address2_A' => $this->address2_A,
            'address3_A' => $this->address3_A,
            'postcode_A' => $this->postcode_A,
            'expectedDatetoLeaveMalaysia_A' => $this->expectedDatetoLeaveMalaysia_A,
            'xAddressBelongsToTaxAgent_A' => $this->xAddressBelongsToTaxAgent_A,
            'ic_A' => $this->ic_A,
            'incomeTaxNo_A' => $this->incomeTaxNo_A,
            'reasonLeaveMalaysia_A' => $this->reasonLeaveMalaysia_A,
            'citizenship_A' => $this->citizenship_A,
            'dateOfBirth_A' => $this->dateOfBirth_A,
            'placeOfBirth_A' => $this->placeOfBirth_A,
            'addressOutMalaysia1_A' => $this->addressOutMalaysia1_A,
            'addressOutMalaysia2_A' => $this->addressOutMalaysia2_A,
            'addressOutMalaysia3_A' => $this->addressOutMalaysia3_A,
            'postcodeOutMalaysia_A' => $this->postcodeOutMalaysia_A,
            'natureOfEmployment_A' => $this->natureOfEmployment_A,
            'telno_A' => $this->telno_A,
            'stateProbableDateofReturn_A' => $this->stateProbableDateofReturn_A,

            'salaryFrom_B' => $this->salaryFrom_B,
            'salaryUntil_B' => $this->salaryUntil_B,
            'leavePayFrom_B' => $this->leavePayFrom_B,
            'leavePayUntil_B' => $this->leavePayUntil_B,
            'commissionFrom_B' => $this->commissionFrom_B,
            'commissionUntil_B' => $this->commissionUntil_B,
            'gratuityFrom_B' => $this->gratuityFrom_B,
            'gratuityUntil_B' => $this->gratuityUntil_B,
            'compensationFrom_B' => $this->compensationFrom_B,
            'compensationUntil_B' => $this->compensationUntil_B,
            'cashAllowanceFrom_B' => $this->cashAllowanceFrom_B,
            'cashAllowanceUntil_B' => $this->cashAllowanceUntil_B,
            'pensionFrom_B' => $this->pensionFrom_B,
            'pensionUntil_B' => $this->pensionUntil_B,
            'benefitSubjectToTaxFrom_B' => $this->benefitSubjectToTaxFrom_B,
            'benefitSubjectToTaxUntil_B' => $this->benefitSubjectToTaxUntil_B,
            'livingAccommodationFrom_B' => $this->livingAccommodationFrom_B,
            'livingAccommodationUntil_B' => $this->livingAccommodationUntil_B,
            'otherAllowanceFrom_B' => $this->otherAllowanceFrom_B,
            'otherAllowanceUntil_B' => $this->otherAllowanceUntil_B,
            'otherPaymentsFrom_B' => $this->otherPaymentsFrom_B,
            'otherPaymentsUntil_B' => $this->otherPaymentsUntil_B,
            'salaryAmount_B' => $this->salaryAmount_B,
            'leavePayAmount_B' => $this->leavePayAmount_B,
            'commissionAmount_B' => $this->commissionAmount_B,
            'gratuityAmount_B' => $this->gratuityAmount_B,
            'compensationAmount_B' => $this->compensationAmount_B,
            'cashAllowanceAmount_B' => $this->cashAllowanceAmount_B,
            'pensionAmount_B' => $this->pensionAmount_B,
            'benefitSubjectToTaxAmount_B' => $this->benefitSubjectToTaxAmount_B,
            'livingAccommodationAmount_B' => $this->livingAccommodationAmount_B,
            'otherAllowanceAmount_B' => $this->otherAllowanceAmount_B,
            'otherPaymentsAmount_B' => $this->otherPaymentsAmount_B,
            'total_B' => $this->total_B,

            'typeOfIncome1_C' => $this->typeOfIncome1_C,
            'typeOfIncome2_C' => $this->typeOfIncome2_C,
            'typeOfIncome3_C' => $this->typeOfIncome3_C,
            'yearForWhichPaid1_C' => $this->yearForWhichPaid1_C,
            'yearForWhichPaid2_C' => $this->yearForWhichPaid2_C,
            'yearForWhichPaid3_C' => $this->yearForWhichPaid3_C,
            'totalIncome1_C' => $this->totalIncome1_C,
            'totalIncome2_C' => $this->totalIncome2_C,
            'totalIncome3_C' => $this->totalIncome3_C,
            'pensionFund1_C' => $this->pensionFund1_C,
            'pensionFund2_C' => $this->pensionFund2_C,
            'pensionFund3_C' => $this->pensionFund3_C,

            'moneyWithheldByEmployer_D' => $this->moneyWithheldByEmployer_D,
            'monthlyTaxDeductions_D' => $this->monthlyTaxDeductions_D,
            'amountOfZakatPaid_D' => $this->amountOfZakatPaid_D,
            'contributionsToEmployeeProvidentFund_D' => $this->contributionsToEmployeeProvidentFund_D,

            'officerName_E' => $this->officerName_E,
            'officerDesignation_E' => $this->officerDesignation_E,
            'officerSignature_E' => $this->officerSignature_E,
            'date_E' => $this->date_E
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

}
