<?php
namespace App\Http\Controllers\Popo\payrollreport;

use App\Enums\PayrollReportEnum;
use function GuzzleHttp\json_encode;


class PayrollReport
{
    private $reportName;
    private $reportDescription;
    private $reportGroup;
    private $reportTarget;
    private $reportCss;


    public function __construct(array $array = []) {
        $this->reportName = isset($array['reportName']) ? $array['reportName'] : null;
        $this->reportDescription = isset($array['reportDescription']) ? $array['reportDescription'] : null;
        $this->reportGroup = isset($array['reportGroup']) ? $array['reportGroup'] : null;
        $this->reportTarget = isset($array['reportTarget']) ? $array['reportTarget'] : null;
        $this->reportCss = isset($array['reportCss']) ? $array['reportCss'] : null;

    }


    /**
     * @return mixed|null
     */
    public function getReportName()
    {
        return $this->reportName;
    }

    /**
     * @param mixed|null $reportName
     */
    public function setReportName( $reportName)
    {
        $this->reportName = $reportName;
    }

    /**
     * @return mixed|null
     */
    public function getReportDescription()
    {
        return $this->reportDescription;
    }

    /**
     * @param mixed|null $reportDescription
     */
    public function setReportDescription( $reportDescription)
    {
        $this->reportDescription = $reportDescription;
    }

    /**
     * @return mixed|null
     */
    public function getReportGroup()
    {
        return $this->reportGroup;
    }

    /**
     * @param mixed|null $reportGroup
     */
    public function setReportGroup( $reportGroup)
    {
        $this->reportGroup = $reportGroup;
    }

    /**
     * @return mixed|null
     */
    public function getReportTarget()
    {
        return $this->reportTarget;
    }

    /**
     * @param mixed|null $reportTarget
     */
    public function setReportTarget( $reportTarget)
    {
        $this->reportTarget = $reportTarget;
    }

    /**
     * @return mixed|null
     */
    public function getReportCss()
    {
        return $this->reportCss;
    }

    /**
     * @param mixed|null $reportCss
     */
    public function setReportCss( $reportCss)
    {
        $this->reportCss = $reportCss;
    }

    public static function getPayrollReport(){
//         $payrollReport = array();
//         $payrollReportEnum = PayrollReportEnum::choices();
//         $payrollReportChunk = array_chunk($payrollReportEnum, 3);
        
//         foreach($payrollReportEnum as $k=>$v) {
//             array_push($payrollReport,new PayrollReport(['reportName' => $v, 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => $k, 'reportCss' => 'm-bg-brand']));
//         }
            
        $slider = array();
        $slider1 = array();
        
        array_push($slider,new PayrollReport(['reportName' => 'Payroll Report', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => '1', 'reportCss' => 'm-bg-brand']));
        array_push($slider,new PayrollReport(['reportName' => 'Supplier Payment Form', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => '2', 'reportCss' => 'm-bg-brand']));
        array_push($slider,new PayrollReport(['reportName' => 'Department Salary', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => '3', 'reportCss' => 'm-bg-brand']));
        array_push($slider,new PayrollReport(['reportName' => 'Payroll Detail', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => '4', 'reportCss' => 'm-bg-brand']));
        
        array_push($slider1,new PayrollReport(['reportName' => 'Bank Credit Detail', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => '5', 'reportCss' => 'm-bg-brand']));
        array_push($slider1,new PayrollReport(['reportName' => 'Payroll Summary', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => '6', 'reportCss' => 'm-bg-brand']));
        
        $arr = array(
            "slider"=>$slider,
            "slider1"=>$slider1
        );
        
        return $arr;
    }

    public static function getGovernmentReportType(){
        $arr = array(
            "LHDNborangE" => "landscape",
            "LHDNcp21" => "portrait",
            "LHDN_cp22" => "portrait",
            "LHDN_cp22a" => "portrait",
            "LHDN_cp22b" => "portrait",
            "LHDN_cp39" => "portrait",
            "LHDN_cp39lieu" => "portrait",
            "LHDN_eaform" => "portrait",
        );
        return $arr;
    }


    public function toArray() {
        return [
            'reportDescription'=> $this->reportDescription,
            'reportGroup' => $this->reportGroup,
            'reportTarget'=> $this->reportTarget,
            'reportCss' => $this->reportCss
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
}
