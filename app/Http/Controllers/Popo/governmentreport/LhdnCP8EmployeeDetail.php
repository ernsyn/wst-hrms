<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/7/18
 * Time: 11:43 AM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class LhdnCP8EmployeeDetail
{
    private $incomeTaxNo;
    private $icNo;
    private $employeeCategory;
    private $taxPayByEmployer;
    private $totalChildren;
    private $amountOfDeparture;
    private $totalGrossRemuneration;
    private $benefitsOfGoods;
    private $valuePlaceOfResidence;
    private $benefitsOfESOS;
    private $taxExemptPerquisites;
    private $TP1Departure;
    private $TP1Zakat;
    private $employeeEPFContributions;
    private $zakatDeductions;
    private $taxDeductionOfPCB;
    private $taxDeductionOfCP38;

    public function __construct(array $array = []) {
        $this->incomeTaxNo = isset($array['incomeTaxNo']) ? $array['incomeTaxNo'] : null;
        $this->icNo = isset($array['icNo']) ? $array['icNo'] : null;
        $this->employeeCategory = isset($array['employeeCategory']) ? $array['employeeCategory'] : null;
        $this->taxPayByEmployer = isset($array['taxPayByEmployer']) ? $array['taxPayByEmployer'] : null;
        $this->totalChildren = isset($array['totalChildren']) ? $array['totalChildren'] : null;
        $this->amountOfDeparture = isset($array['amountOfDeparture']) ? $array['amountOfDeparture'] : null;
        $this->totalGrossRemuneration = isset($array['totalGrossRemuneration']) ? $array['totalGrossRemuneration'] : null;
        $this->benefitsOfGoods = isset($array['benefitsOfGoods']) ? $array['benefitsOfGoods'] : null;
        $this->valuePlaceOfResidence = isset($array['valuePlaceOfResidence']) ? $array['valuePlaceOfResidence'] : null;
        $this->benefitsOfESOS = isset($array['benefitsOfESOS']) ? $array['benefitsOfESOS'] : null;
        $this->taxExemptPerquisites = isset($array['taxExemptPerquisites']) ? $array['taxExemptPerquisites'] : null;
        $this->TP1Departure = isset($array['TP1Departure']) ? $array['TP1Departure'] : null;
        $this->TP1Zakat = isset($array['TP1Zakat']) ? $array['TP1Zakat'] : null;
        $this->employeeEPFContributions = isset($array['employeeEPFContributions']) ? $array['employeeEPFContributions'] : null;
        $this->zakatDeductions = isset($array['zakatDeductions']) ? $array['zakatDeductions'] : null;
        $this->taxDeductionOfPCB = isset($array['taxDeductionOfPCB']) ? $array['taxDeductionOfPCB'] : null;
        $this->taxDeductionOfCP38 = isset($array['taxDeductionOfCP38']) ? $array['taxDeductionOfCP38'] : null;
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

    public function getEmployeeCategory() {
        return $this->employeeCategory;
    }

    public function setEmployeeCategory($employeeCategory) {
        $this->employeeCategory = $employeeCategory;
        return $this;
    }

    public function getTaxPayByEmployer() {
        return $this->taxPayByEmployer;
    }

    public function setTaxPayByEmployer($taxPayByEmployer) {
        $this->taxPayByEmployer = $taxPayByEmployer;
        return $this;
    }

    public function getTotalChildren() {
        return $this->totalChildren;
    }

    public function setTotalChildren($totalChildren) {
        $this->totalChildren = $totalChildren;
        return $this;
    }

    public function getAmountOfDeparture() {
        return $this->amountOfDeparture;
    }

    public function setAmountOfDeparture($amountOfDeparture) {
        $this->amountOfDeparture = $amountOfDeparture;
        return $this;
    }

    public function getTotalGrossRemuneration() {
        return $this->totalGrossRemuneration;
    }

    public function setTotalGrossRemuneration($totalGrossRemuneration) {
        $this->totalGrossRemuneration = $totalGrossRemuneration;
        return $this;
    }

    public function getBenefitsOfGoods() {
        return $this->benefitsOfGoods;
    }

    public function setBenefitsOfGoods($benefitsOfGoods) {
        $this->benefitsOfGoods = $benefitsOfGoods;
        return $this;
    }

    public function getValuePlaceOfResidence() {
        return $this->valuePlaceOfResidence;
    }

    public function setValuePlaceOfResidence($valuePlaceOfResidence) {
        $this->valuePlaceOfResidence = $valuePlaceOfResidence;
        return $this;
    }

    public function getBenefitsOfESOS() {
        return $this->benefitsOfESOS;
    }

    public function setBenefitsOfESOS($benefitsOfESOS) {
        $this->benefitsOfESOS = $benefitsOfESOS;
        return $this;
    }

    public function getTaxExemptPerquisites() {
        return $this->taxExemptPerquisites;
    }

    public function setTaxExemptPerquisites($taxExemptPerquisites) {
        $this->taxExemptPerquisites = $taxExemptPerquisites;
        return $this;
    }

    public function getTP1Departure() {
        return $this->TP1Departure;
    }

    public function setTP1Departure($TP1Departure) {
        $this->TP1Departure = $TP1Departure;
        return $this;
    }

    public function getTP1Zakat() {
        return $this->TP1Zakat;
    }

    public function setTP1Zakat($TP1Zakat) {
        $this->TP1Zakat = $TP1Zakat;
        return $this;
    }

    public function getEmployeeEPFContributions() {
        return $this->employeeEPFContributions;
    }

    public function setEmployeeEPFContributions($employeeEPFContributions) {
        $this->employeeEPFContributions = $employeeEPFContributions;
        return $this;
    }

    public function getZakatDeductions() {
        return $this->zakatDeductions;
    }

    public function setZakatDeductions($zakatDeductions) {
        $this->zakatDeductions = $zakatDeductions;
        return $this;
    }

    public function getTaxDeductionOfPCB() {
        return $this->taxDeductionOfPCB;
    }

    public function setTaxDeductionOfPCB($taxDeductionOfPCB) {
        $this->taxDeductionOfPCB = $taxDeductionOfPCB;
        return $this;
    }

    public function getTaxDeductionOfCP38() {
        return $this->taxDeductionOfCP38;
    }

    public function setTaxDeductionOfCP38($taxDeductionOfCP38) {
        $this->taxDeductionOfCP38 = $taxDeductionOfCP38;
        return $this;
    }

    public function toArray() {
        return [
            'incomeTaxNo' => $this->incomeTaxNo,
            'icNo' => $this->icNo,
            'employeeCategory' => $this->employeeCategory,
            'taxPayByEmployer' => $this->taxPayByEmployer,
            'totalChildren' => $this->totalChildren,
            'amountOfDeparture' => $this->amountOfDeparture,
            'totalGrossRemuneration' => $this->totalGrossRemuneration,
            'benefitsOfGoods' => $this->benefitsOfGoods,
            'valuePlaceOfResidence' => $this->valuePlaceOfResidence,
            'benefitsOfESOS' => $this->benefitsOfESOS,
            'taxExemptPerquisites' => $this->taxExemptPerquisites,
            'TP1Departure' => $this->TP1Departure,
            'TP1Zakat' => $this->TP1Zakat,
            'employeeEPFContributions' => $this->employeeEPFContributions,
            'zakatDeductions' => $this->zakatDeductions,
            'taxDeductionOfPCB' => $this->taxDeductionOfPCB,
            'taxDeductionOfCP38' => $this->taxDeductionOfCP38
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
}
