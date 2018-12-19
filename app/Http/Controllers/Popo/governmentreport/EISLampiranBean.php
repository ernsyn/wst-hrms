<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 12/11/18
 * Time: 3:43 PM
 */

namespace App\Http\Controllers\Popo\governmentreport;

class EISLampiranBean
{

    private $companyName;
    private $companyNoCode;

    private $employeeIcNo;
    private $employeeName;
    private $contributionMonth;
    private $contributionAmount;

    public function __construct(array $array = []){
        $this->companyName = isset($array['companyName']) ? $array['companyName'] : null;
        $this->companyNoCode = isset($array['companyNoCode']) ? $array['companyNoCode'] : null;

        $this->employeeIcNo = isset($array['employeeIcNo']) ? $array['employeeIcNo'] : null;
        $this->employeeName = isset($array['employeeName']) ? $array['employeeName'] : null;
        $this->contributionMonth = isset($array['contributionMonth']) ? $array['contributionMonth'] : null;
        $this->contributionAmount = isset($array['contributionAmount']) ? $array['contributionAmount'] : null;
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
    public function getCompanyNoCode()
    {
        return $this->companyNoCode;
    }

    /**
     * @param mixed|null $companyNoCode
     */
    public function setCompanyNoCode( $companyNoCode)
    {
        $this->companyNoCode = $companyNoCode;
    }

    /**
     * @return mixed|null
     */
    public function getEmployeeIcNo()
    {
        return $this->employeeIcNo;
    }

    /**
     * @param mixed|null $employeeIcNo
     */
    public function setEmployeeIcNo( $employeeIcNo)
    {
        $this->employeeIcNo = $employeeIcNo;
    }

    /**
     * @return mixed|null
     */
    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    /**
     * @param mixed|null $employeeName
     */
    public function setEmployeeName( $employeeName)
    {
        $this->employeeName = $employeeName;
    }

    /**
     * @return mixed|null
     */
    public function getContributionMonth()
    {
        return $this->contributionMonth;
    }

    /**
     * @param mixed|null $contributionMonth
     */
    public function setContributionMonth( $contributionMonth)
    {
        $this->contributionMonth = $contributionMonth;
    }

    /**
     * @return mixed|null
     */
    public function getContributionAmount()
    {
        return $this->contributionAmount;
    }

    /**
     * @param mixed|null $contributionAmount
     */
    public function setContributionAmount( $contributionAmount)
    {
        $this->contributionAmount = $contributionAmount;
    }

    public function toArray() {
        return [
            'companyName' => $this->companyName,
            'companyNoCode' => $this->companyNoCode,
            'employeeIcNo' => $this->employeeIcNo,
            'employeeName' => $this->employeeName,
            'contributionMonth' => $this->contributionMonth,
            'contributionAmount' => $this->contributionAmount
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
}
