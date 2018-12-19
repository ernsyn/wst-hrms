<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/28/18
 * Time: 3:41 PM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class ASNBBean
{
    private $date;
    private $employerCodeNo;

    private $employeeCodeNo;
    private $departmentCode;
    private $accountNo;
    private $employeeName;
    private $employeeIcNo;
    private $amount;

    public function __construct(array $array = []) {
        $this->date = isset($array['date']) ? $array['date'] : null;
        $this->employerCodeNo = isset($array['employerCodeNo']) ? $array['employerCodeNo'] : null;

        $this->employeeCodeNo = isset($array['employeeCodeNo']) ? $array['employeeCodeNo'] : null;
        $this->departmentCode = isset($array['departmentCode']) ? $array['departmentCode'] : null;
        $this->accountNo = isset($array['accountNo']) ? $array['accountNo'] : null;
        $this->employeeName = isset($array['employeeName']) ? $array['employeeName'] : null;
        $this->employeeIcNo = isset($array['employeeIcNo']) ? $array['employeeIcNo'] : null;
        $this->amount = isset($array['amount']) ? $array['amount'] : null;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getEmployerCodeNo()
    {
        return $this->employerCodeNo;
    }

    /**
     * @param mixed $employerCodeNo
     */
    public function setEmployerCodeNo($employerCodeNo)
    {
        $this->employerCodeNo = $employerCodeNo;
    }

    /**
     * @return mixed
     */
    public function getEmployeeCodeNo()
    {
        return $this->employeeCodeNo;
    }

    /**
     * @param mixed $employeeCodeNo
     */
    public function setEmployeeCodeNo($employeeCodeNo)
    {
        $this->employeeCodeNo = $employeeCodeNo;
    }

    /**
     * @return mixed
     */
    public function getDepartmentCode()
    {
        return $this->departmentCode;
    }

    /**
     * @param mixed $departmentCode
     */
    public function setDepartmentCode($departmentCode)
    {
        $this->departmentCode = $departmentCode;
    }

    /**
     * @return mixed
     */
    public function getAccountNo()
    {
        return $this->accountNo;
    }

    /**
     * @param mixed $accountNo
     */
    public function setAccountNo($accountNo)
    {
        $this->accountNo = $accountNo;
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
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function toArray() {
        return [
            'date' => $this->date,
            'employerCodeNo' => $this->employerCodeNo,

            'employeeCodeNo' => $this->employeeCodeNo,
            'departmentCode' => $this->departmentCode,
            'accountNo' => $this->accountNo,
            'employeeName' => $this->employeeName,
            'employeeIcNo' => $this->employeeIcNo,
            'amount' => $this->amount,
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }


}
