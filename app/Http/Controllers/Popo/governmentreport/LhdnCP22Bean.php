<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/10/18
 * Time: 11:15 PM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class LhdnCP22Bean
{
    private $companyName;
    private $companyNoE;
    private $companyNoTel;
    private $addressTo1;
    private $addressTo2;
    private $addressTo3;
    private $postcodeTo;
    private $addressFrom1;
    private $addressFrom2;
    private $addressFrom3;
    private $postcodeFrom;

    private $name_A;
    private $incomeTaxNo_A;
    private $jobRole_A;
    private $noIc_A;
    private $employmentStartDate_A;
    private $employmentExpectedDate_A;
    private $immigrationNo_A;
    private $address1_A;
    private $address2_A;
    private $address3_A;
    private $postcode_A;
    private $birthDate_A;
    private $maritalStatus_A;
    private $childrenUnder18No_A;
    private $addressNow1_A;
    private $addressNow2_A;
    private $addressNow3_A;
    private $postcodeNow_A;
    private $signX_A;
    private $spouseName_A;
    private $spouseIC_A;
    private $spouseIncomeTax_A;

    private $fixedMontlyRemunerationRate_B;
    private $rateCashAllowance_B;
    private $emolumentNotFixed_B;
    private $employerName_B;
    private $employerAddress1_B;
    private $employerAddress2_B;
    private $employerAddress3_B;

    private $officerSignature_C;
    private $officerName_C;
    private $officerRole_C;
    private $date_C;

    public function __construct(array $array = []) {
        $this->companyName = isset($array['companyName']) ? $array['companyName'] : null;
        $this->companyNoE = isset($array['companyNoE']) ? $array['companyNoE'] : null;
        $this->companyNoTel = isset($array['companyNoTel']) ? $array['companyNoTel'] : null;
        $this->addressTo1 = isset($array['addressTo1']) ? $array['addressTo1'] : null;
        $this->addressTo2 = isset($array['addressTo2']) ? $array['addressTo2'] : null;
        $this->addressTo3 = isset($array['addressTo3']) ? $array['addressTo3'] : null;
        $this->postcodeTo = isset($array['postcodeTo']) ? $array['postcodeTo'] : null;
        $this->addressFrom1 = isset($array['addressFrom1']) ? $array['addressFrom1'] : null;
        $this->addressFrom2 = isset($array['addressFrom2']) ? $array['addressFrom2'] : null;
        $this->addressFrom3 = isset($array['addressFrom3']) ? $array['addressFrom3'] : null;
        $this->postcodeFrom = isset($array['postcodeFrom']) ? $array['postcodeFrom'] : null;

        $this->name_A = isset($array['name_A']) ? $array['name_A'] : null;
        $this->incomeTaxNo_A = isset($array['incomeTaxNo_A']) ? $array['incomeTaxNo_A'] : null;
        $this->jobRole_A = isset($array['jobRole_A']) ? $array['jobRole_A'] : null;
        $this->noIc_A = isset($array['noIc_A']) ? $array['noIc_A'] : null;
        $this->employmentStartDate_A = isset($array['employmentStartDate_A']) ? $array['employmentStartDate_A'] : null;
        $this->employmentExpectedDate_A = isset($array['employmentExpectedDate_A']) ? $array['employmentExpectedDate_A'] : null;
        $this->immigrationNo_A = isset($array['immigrationNo_A']) ? $array['immigrationNo_A'] : null;
        $this->address1_A = isset($array['address1_A']) ? $array['address1_A'] : null;
        $this->address2_A = isset($array['address2_A']) ? $array['address2_A'] : null;
        $this->address3_A = isset($array['address3_A']) ? $array['address3_A'] : null;
        $this->postcode_A = isset($array['postcode_A']) ? $array['postcode_A'] : null;
        $this->birthDate_A = isset($array['birthDate_A']) ? $array['birthDate_A'] : null;
        $this->maritalStatus_A = isset($array['maritalStatus_A']) ? $array['maritalStatus_A'] : null;
        $this->childrenUnder18No_A = isset($array['childrenUnder18No_A']) ? $array['childrenUnder18No_A'] : null;
        $this->addressNow1_A = isset($array['addressNow1_A']) ? $array['addressNow1_A'] : null;
        $this->addressNow2_A = isset($array['addressNow2_A']) ? $array['addressNow2_A'] : null;
        $this->addressNow3_A = isset($array['addressNow3_A']) ? $array['addressNow3_A'] : null;
        $this->postcodeNow_A = isset($array['postcodeNow_A']) ? $array['postcodeNow_A'] : null;
        $this->signX_A = isset($array['signX_A']) ? $array['signX_A'] : null;
        $this->spouseName_A = isset($array['spouseName_A']) ? $array['spouseName_A'] : null;
        $this->spouseIC_A = isset($array['spouseIC_A']) ? $array['spouseIC_A'] : null;
        $this->spouseIncomeTax_A = isset($array['spouseIncomeTax_A']) ? $array['spouseIncomeTax_A'] : null;

        $this->fixedMontlyRemunerationRate_B = isset($array['fixedMontlyRemunerationRate_B']) ? $array['fixedMontlyRemunerationRate_B'] : null;
        $this->rateCashAllowance_B = isset($array['rateCashAllowance_B']) ? $array['rateCashAllowance_B'] : null;
        $this->emolumentNotFixed_B = isset($array['emolumentNotFixed_B']) ? $array['emolumentNotFixed_B'] : null;
        $this->employerName_B = isset($array['employerName_B']) ? $array['employerName_B'] : null;
        $this->employerAddress1_B = isset($array['employerAddress1_B']) ? $array['employerAddress1_B'] : null;
        $this->employerAddress2_B = isset($array['employerAddress2_B']) ? $array['employerAddress2_B'] : null;
        $this->employerAddress3_B = isset($array['employerAddress3_B']) ? $array['employerAddress3_B'] : null;

        $this->officerSignature_C = isset($array['officerSignature_C']) ? $array['officerSignature_C'] : null;
        $this->officerName_C = isset($array['officerName_C']) ? $array['officerName_C'] : null;
        $this->officerRole_C = isset($array['officerRole_C']) ? $array['officerRole_C'] : null;
        $this->date_C = isset($array['date_C']) ? $array['date_C'] : null;
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
    public function getCompanyNoE()
    {
        return $this->companyNoE;
    }

    /**
     * @param mixed|null $companyNoE
     */
    public function setCompanyNoE( $companyNoE)
    {
        $this->companyNoE = $companyNoE;
    }

    /**
     * @return mixed|null
     */
    public function getCompanyNoTel()
    {
        return $this->companyNoTel;
    }

    /**
     * @param mixed|null $companyNoTel
     */
    public function setCompanyNoTel( $companyNoTel)
    {
        $this->companyNoTel = $companyNoTel;
    }

    /**
     * @return mixed|null
     */
    public function getAddressTo1()
    {
        return $this->addressTo1;
    }

    /**
     * @param mixed|null $addressTo1
     */
    public function setAddressTo1( $addressTo1)
    {
        $this->addressTo1 = $addressTo1;
    }

    /**
     * @return mixed|null
     */
    public function getAddressTo2()
    {
        return $this->addressTo2;
    }

    /**
     * @param mixed|null $addressTo2
     */
    public function setAddressTo2( $addressTo2)
    {
        $this->addressTo2 = $addressTo2;
    }

    /**
     * @return mixed|null
     */
    public function getAddressTo3()
    {
        return $this->addressTo3;
    }

    /**
     * @param mixed|null $addressTo3
     */
    public function setAddressTo3( $addressTo3)
    {
        $this->addressTo3 = $addressTo3;
    }

    /**
     * @return mixed|null
     */
    public function getPostcodeTo()
    {
        return $this->postcodeTo;
    }

    /**
     * @param mixed|null $postcodeTo
     */
    public function setPostcodeTo( $postcodeTo)
    {
        $this->postcodeTo = $postcodeTo;
    }

    /**
     * @return mixed|null
     */
    public function getAddressFrom1()
    {
        return $this->addressFrom1;
    }

    /**
     * @param mixed|null $addressFrom1
     */
    public function setAddressFrom1( $addressFrom1)
    {
        $this->addressFrom1 = $addressFrom1;
    }

    /**
     * @return mixed|null
     */
    public function getAddressFrom2()
    {
        return $this->addressFrom2;
    }

    /**
     * @param mixed|null $addressFrom2
     */
    public function setAddressFrom2( $addressFrom2)
    {
        $this->addressFrom2 = $addressFrom2;
    }

    /**
     * @return mixed|null
     */
    public function getAddressFrom3()
    {
        return $this->addressFrom3;
    }

    /**
     * @param mixed|null $addressFrom3
     */
    public function setAddressFrom3( $addressFrom3)
    {
        $this->addressFrom3 = $addressFrom3;
    }

    /**
     * @return mixed|null
     */
    public function getPostcodeFrom()
    {
        return $this->postcodeFrom;
    }

    /**
     * @param mixed|null $postcodeFrom
     */
    public function setPostcodeFrom( $postcodeFrom)
    {
        $this->postcodeFrom = $postcodeFrom;
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

    /**
     * @return mixed|null
     */
    public function getJobRoleA()
    {
        return $this->jobRole_A;
    }

    /**
     * @param mixed|null $jobRole_A
     */
    public function setJobRoleA( $jobRole_A)
    {
        $this->jobRole_A = $jobRole_A;
    }

    /**
     * @return mixed|null
     */
    public function getNoIcA()
    {
        return $this->noIc_A;
    }

    /**
     * @param mixed|null $noIc_A
     */
    public function setNoIcA( $noIc_A)
    {
        $this->noIc_A = $noIc_A;
    }

    /**
     * @return mixed|null
     */
    public function getEmploymentStartDateA()
    {
        return $this->employmentStartDate_A;
    }

    /**
     * @param mixed|null $employmentStartDate_A
     */
    public function setEmploymentStartDateA( $employmentStartDate_A)
    {
        $this->employmentStartDate_A = $employmentStartDate_A;
    }

    /**
     * @return mixed|null
     */
    public function getEmploymentExpectedDateA()
    {
        return $this->employmentExpectedDate_A;
    }

    /**
     * @param mixed|null $employmentExpectedDate_A
     */
    public function setEmploymentExpectedDateA( $employmentExpectedDate_A)
    {
        $this->employmentExpectedDate_A = $employmentExpectedDate_A;
    }

    /**
     * @return mixed|null
     */
    public function getImmigrationNoA()
    {
        return $this->immigrationNo_A;
    }

    /**
     * @param mixed|null $immigrationNo_A
     */
    public function setImmigrationNoA( $immigrationNo_A)
    {
        $this->immigrationNo_A = $immigrationNo_A;
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
    public function getBirthDateA()
    {
        return $this->birthDate_A;
    }

    /**
     * @param mixed|null $birthDate_A
     */
    public function setBirthDateA( $birthDate_A)
    {
        $this->birthDate_A = $birthDate_A;
    }

    /**
     * @return mixed|null
     */
    public function getMaritalStatusA()
    {
        return $this->maritalStatus_A;
    }

    /**
     * @param mixed|null $maritalStatus_A
     */
    public function setMaritalStatusA( $maritalStatus_A)
    {
        $this->maritalStatus_A = $maritalStatus_A;
    }

    /**
     * @return mixed|null
     */
    public function getChildrenUnder18NoA()
    {
        return $this->childrenUnder18No_A;
    }

    /**
     * @param mixed|null $childrenUnder18No_A
     */
    public function setChildrenUnder18NoA( $childrenUnder18No_A)
    {
        $this->childrenUnder18No_A = $childrenUnder18No_A;
    }

    /**
     * @return mixed|null
     */
    public function getAddressNow1A()
    {
        return $this->addressNow1_A;
    }

    /**
     * @param mixed|null $addressNow1_A
     */
    public function setAddressNow1A( $addressNow1_A)
    {
        $this->addressNow1_A = $addressNow1_A;
    }

    /**
     * @return mixed|null
     */
    public function getAddressNow2A()
    {
        return $this->addressNow2_A;
    }

    /**
     * @param mixed|null $addressNow2_A
     */
    public function setAddressNow2A( $addressNow2_A)
    {
        $this->addressNow2_A = $addressNow2_A;
    }

    /**
     * @return mixed|null
     */
    public function getAddressNow3A()
    {
        return $this->addressNow3_A;
    }

    /**
     * @param mixed|null $addressNow3_A
     */
    public function setAddressNow3A( $addressNow3_A)
    {
        $this->addressNow3_A = $addressNow3_A;
    }

    /**
     * @return mixed|null
     */
    public function getPostcodeNowA()
    {
        return $this->postcodeNow_A;
    }

    /**
     * @param mixed|null $postcodeNow_A
     */
    public function setPostcodeNowA( $postcodeNow_A)
    {
        $this->postcodeNow_A = $postcodeNow_A;
    }

    /**
     * @return mixed|null
     */
    public function getSignXA()
    {
        return $this->signX_A;
    }

    /**
     * @param mixed|null $signX_A
     */
    public function setSignXA( $signX_A)
    {
        $this->signX_A = $signX_A;
    }

    /**
     * @return mixed|null
     */
    public function getSpouseNameA()
    {
        return $this->spouseName_A;
    }

    /**
     * @param mixed|null $spouseName_A
     */
    public function setSpouseNameA( $spouseName_A)
    {
        $this->spouseName_A = $spouseName_A;
    }

    /**
     * @return mixed|null
     */
    public function getSpouseICA()
    {
        return $this->spouseIC_A;
    }

    /**
     * @param mixed|null $spouseIC_A
     */
    public function setSpouseICA( $spouseIC_A)
    {
        $this->spouseIC_A = $spouseIC_A;
    }

    /**
     * @return mixed|null
     */
    public function getSpouseIncomeTaxA()
    {
        return $this->spouseIncomeTax_A;
    }

    /**
     * @param mixed|null $spouseIncomeTax_A
     */
    public function setSpouseIncomeTaxA( $spouseIncomeTax_A)
    {
        $this->spouseIncomeTax_A = $spouseIncomeTax_A;
    }

    /**
     * @return mixed|null
     */
    public function getFixedMontlyRemunerationRateB()
    {
        return $this->fixedMontlyRemunerationRate_B;
    }

    /**
     * @param mixed|null $fixedMontlyRemunerationRate_B
     */
    public function setFixedMontlyRemunerationRateB( $fixedMontlyRemunerationRate_B)
    {
        $this->fixedMontlyRemunerationRate_B = $fixedMontlyRemunerationRate_B;
    }

    /**
     * @return mixed|null
     */
    public function getRateCashAllowanceB()
    {
        return $this->rateCashAllowance_B;
    }

    /**
     * @param mixed|null $rateCashAllowance_B
     */
    public function setRateCashAllowanceB( $rateCashAllowance_B)
    {
        $this->rateCashAllowance_B = $rateCashAllowance_B;
    }

    /**
     * @return mixed|null
     */
    public function getEmolumentNotFixedB()
    {
        return $this->emolumentNotFixed_B;
    }

    /**
     * @param mixed|null $emolumentNotFixed_B
     */
    public function setEmolumentNotFixedB( $emolumentNotFixed_B)
    {
        $this->emolumentNotFixed_B = $emolumentNotFixed_B;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerNameB()
    {
        return $this->employerName_B;
    }

    /**
     * @param mixed|null $employerName_B
     */
    public function setEmployerNameB( $employerName_B)
    {
        $this->employerName_B = $employerName_B;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerAddress1B()
    {
        return $this->employerAddress1_B;
    }

    /**
     * @param mixed|null $employerAddress1_B
     */
    public function setEmployerAddress1B( $employerAddress1_B)
    {
        $this->employerAddress1_B = $employerAddress1_B;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerAddress2B()
    {
        return $this->employerAddress2_B;
    }

    /**
     * @param mixed|null $employerAddress2_B
     */
    public function setEmployerAddress2B( $employerAddress2_B)
    {
        $this->employerAddress2_B = $employerAddress2_B;
    }

    /**
     * @return mixed|null
     */
    public function getEmployerAddress3B()
    {
        return $this->employerAddress3_B;
    }

    /**
     * @param mixed|null $employerAddress3_B
     */
    public function setEmployerAddress3B( $employerAddress3_B)
    {
        $this->employerAddress3_B = $employerAddress3_B;
    }

    /**
     * @return mixed|null
     */
    public function getOfficerSignatureC()
    {
        return $this->officerSignature_C;
    }

    /**
     * @param mixed|null $officerSignature_C
     */
    public function setOfficerSignatureC( $officerSignature_C)
    {
        $this->officerSignature_C = $officerSignature_C;
    }

    /**
     * @return mixed
     */
    public function getOfficerNameC()
    {
        return $this->officerName_C;
    }

    /**
     * @param mixed $officerName_C
     */
    public function setOfficerNameC($officerName_C): void
    {
        $this->officerName_C = $officerName_C;
    }

    /**
     * @return mixed|null
     */
    public function getOfficerRoleC()
    {
        return $this->officerRole_C;
    }

    /**
     * @param mixed|null $officerRole_C
     */
    public function setOfficerRoleC( $officerRole_C)
    {
        $this->officerRole_C = $officerRole_C;
    }

    /**
     * @return mixed|null
     */
    public function getDateC()
    {
        return $this->date_C;
    }

    /**
     * @param mixed|null $date_C
     */
    public function setDateC( $date_C)
    {
        $this->date_C = $date_C;
    }

    public function toArray() {
        return [
            'companyName' => $this->companyName,
            'companyNoE' => $this->companyNoE,
            'companyNoTel' => $this->companyNoTel,
            'addressTo1' => $this->addressTo1,
            'addressTo2' => $this->addressTo2,
            'addressTo3' => $this->addressTo3,
            'postcodeTo' => $this->postcodeTo,
            'addressFrom1' => $this->addressFrom1,
            'addressFrom2' => $this->addressFrom2,
            'addressFrom3' => $this->addressFrom3,
            'postcodeFrom' => $this->postcodeFrom,

            'name_A' => $this->name_A,
            'incomeTaxNo_A' => $this->incomeTaxNo_A,
            'jobRole_A' => $this->jobRole_A,
            'noIc_A' => $this->noIc_A,
            'employmentStartDate_A' => $this->employmentStartDate_A,
            'employmentExpectedDate_A' => $this->employmentExpectedDate_A,
            'immigrationNo_A' => $this->immigrationNo_A,
            'address1_A' => $this->address1_A,
            'address2_A' => $this->address2_A,
            'address3_A' => $this->address3_A,
            'postcode_A' => $this->postcode_A,
            'birthDate_A' => $this->birthDate_A,
            'maritalStatus_A' => $this->maritalStatus_A,
            'childrenUnder18No_A' => $this->childrenUnder18No_A,
            'addressNow1_A' => $this->addressNow1_A,
            'addressNow2_A' => $this->addressNow2_A,
            'addressNow3_A' => $this->addressNow3_A,
            'postcodeNow_A' => $this->postcodeNow_A,
            'signX_A' => $this->signX_A,
            'spouseName_A' => $this->spouseName_A,
            'spouseIC_A' => $this->spouseIC_A,
            'spouseIncomeTax_A' => $this->spouseIncomeTax_A,

            'fixedMontlyRemunerationRate_B' => $this->fixedMontlyRemunerationRate_B,
            'rateCashAllowance_B' => $this->rateCashAllowance_B,
            'emolumentNotFixed_B' => $this->emolumentNotFixed_B,
            'employerName_B' => $this->employerName_B,
            'employerAddress1_B' => $this->employerAddress1_B,
            'employerAddress2_B' => $this->employerAddress2_B,
            'employerAddress3_B' => $this->employerAddress3_B,

            'officerSignature_C' => $this->officerSignature_C,
            'officerName_C' => $this->officerName_C,
            'officerRole_C' => $this->officerRole_C,
            'date_C' => $this->date_C
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

}
