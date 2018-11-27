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
    private $showOfficer;
    private $showPeriod;
    private $showFilter;
    private $value;


    public function __construct(array $array = []) {
        $this->reportName = isset($array['reportName']) ? $array['reportName'] : null;
        $this->reportDescription = isset($array['reportDescription']) ? $array['reportDescription'] : null;
        $this->reportGroup = isset($array['reportGroup']) ? $array['reportGroup'] : null;
        $this->reportTarget = isset($array['reportTarget']) ? $array['reportTarget'] : null;
        $this->reportCss = isset($array['reportCss']) ? $array['reportCss'] : null;
        $this->showOfficer = isset($array['showOfficer']) ? $array['showOfficer'] : null;
        $this->showPeriod = isset($array['showPeriod']) ? $array['showPeriod'] : null;
        $this->showFilter = isset($array['showFilter']) ? $array['showFilter'] : null;
        $this->value = isset($array['value']) ? $array['value'] : null;
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

    /**
     * @return mixed|null
     */
    public function getShowOfficer()
    {
        return $this->showOfficer;
    }

    /**
     * @param mixed|null $showOfficer
     */
    public function setShowOfficer( $showOfficer)
    {
        $this->showOfficer = $showOfficer;
    }

    /**
     * @return mixed|null
     */
    public function getShowPeriod()
    {
        return $this->showPeriod;
    }

    /**
     * @param mixed|null $showPeriod
     */
    public function setShowPeriod( $showPeriod)
    {
        $this->showPeriod = $showPeriod;
    }

    /**
     * @return mixed|null
     */
    public function getShowFilter()
    {
        return $this->showFilter;
    }

    /**
     * @param mixed|null $showFilter
     */
    public function setShowFilter( $showFilter)
    {
        $this->showFilter = $showFilter;
    }

    /**
     * @return mixed|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed|null $value
     */
    public function setValue( $value)
    {
        $this->value = $value;
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

        array_push($slider,new PayrollReport(['reportName' => 'Payroll Report', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => 'report1', 'reportCss' => 'm-bg-brand']));
        array_push($slider,new PayrollReport(['reportName' => 'Supplier Payment Form', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => 'report2', 'reportCss' => 'm-bg-brand']));
        array_push($slider,new PayrollReport(['reportName' => 'Department Salary', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => 'report3', 'reportCss' => 'm-bg-brand']));
        array_push($slider,new PayrollReport(['reportName' => 'Payroll Detail', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => 'report4', 'reportCss' => 'm-bg-brand']));

        array_push($slider1,new PayrollReport(['reportName' => 'Bank Credit Detail', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => 'report5', 'reportCss' => 'm-bg-brand']));
        array_push($slider1,new PayrollReport(['reportName' => 'Payroll Summary', 'reportDescription' => '', 'reportGroup' => '', 'reportTarget' => 'report6', 'reportCss' => 'm-bg-brand']));

        $arr = array(
            "slider"=>$slider,
            "slider1"=>$slider1
        );

        return $arr;
    }

    public static function getPayrollReportForm(){
        $form = array();
        $form1 = array();

        array_push($form,new PayrollReport(['reportName' => 'Payroll Report', 'value' => '1', 'reportGroup' => '', 'reportTarget' => 'report1', 'reportCss' => 'm-bg-brand', 'reportCss' => 'm-bg-brand', 'showOfficer' => false, 'showPeriod' => true, 'showFilter' => true ]));
        array_push($form,new PayrollReport(['reportName' => 'Supplier Payment Form', 'value' => '2', 'reportGroup' => '', 'reportTarget' => 'report2', 'reportCss' => 'm-bg-brand', 'showOfficer' => false, 'showPeriod' => true, 'showFilter' => true]));
        array_push($form,new PayrollReport(['reportName' => 'Department Salary', 'value' => '3', 'reportGroup' => '', 'reportTarget' => 'report3', 'reportCss' => 'm-bg-brand', 'showOfficer' => false, 'showPeriod' => true, 'showFilter' => true]));
        array_push($form,new PayrollReport(['reportName' => 'Payroll Detail', 'value' => '4', 'reportGroup' => '', 'reportTarget' => 'report4', 'reportCss' => 'm-bg-brand', 'showOfficer' => false, 'showPeriod' => true, 'showFilter' => true]));

        array_push($form1,new PayrollReport(['reportName' => 'Bank Credit Detail', 'value' => '5', 'reportGroup' => '', 'reportTarget' => 'report5', 'reportCss' => 'm-bg-brand', 'showOfficer' => false, 'showPeriod' => true, 'showFilter' => true]));
        array_push($form1,new PayrollReport(['reportName' => 'Payroll Summary', 'value' => '6', 'reportGroup' => '', 'reportTarget' => 'report6', 'reportCss' => 'm-bg-brand', 'showOfficer' => false, 'showPeriod' => true, 'showFilter' => true]));

        $form = array(
            "form"=>$form,
            "form1"=>$form1
        );
        return $form;
    }

//     public static function getGovernmentReportType(){
//         $arr = array(
//             "LHDNborangE" => "landscape",
//             "LHDNcp21" => "portrait",
//             "LHDN_cp22" => "portrait",
//             "LHDN_cp22a" => "portrait",
//             "LHDN_cp22b" => "portrait",
//             "LHDN_cp39" => "portrait",
//             "LHDN_cp39lieu" => "portrait",
//             "LHDN_eaform" => "portrait",
//         );
//         return $arr;
//     }


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
