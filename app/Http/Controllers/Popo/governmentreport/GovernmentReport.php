<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shahril Abu Bakar
 * Date: 11/15/18
 * Time: 2:07 PM
 */

namespace App\Http\Controllers\Popo\governmentreport;


class GovernmentReport
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

    public static function getGovernmentReport(){
        $slider = array();
        $slider1 = array();
        $slider2 = array();
        $slider3 = array();
        $slider4 = array();

        //LHDN
        array_push($slider,new GovernmentReport(['reportName' => 'Borang E', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'borangE', 'reportCss' => 'm-bg-brand']));
        array_push($slider,new GovernmentReport(['reportName' => 'CP21', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp21', 'reportCss' => 'm-bg-brand']));
        array_push($slider,new GovernmentReport(['reportName' => 'CP22', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp22', 'reportCss' => 'm-bg-brand']));
        array_push($slider,new GovernmentReport(['reportName' => 'CP22a', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp22a', 'reportCss' => 'm-bg-brand']));

        array_push($slider1,new GovernmentReport(['reportName' => 'CP22b', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp22b', 'reportCss' => 'm-bg-brand']));
        array_push($slider1,new GovernmentReport(['reportName' => 'CP39', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp39', 'reportCss' => 'm-bg-brand']));
        array_push($slider1,new GovernmentReport(['reportName' => 'CP39 Lieu', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp39lieu', 'reportCss' => 'm-bg-brand']));
        array_push($slider1,new GovernmentReport(['reportName' => 'EA Form', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'eaform', 'reportCss' => 'm-bg-brand']));

        //Tabung haji
        array_push($slider2,new GovernmentReport(['reportName' => 'Caruman', 'reportDescription' => '', 'reportGroup' => 'Tabung Haji', 'reportTarget' => 'caruman', 'reportCss' => 'm-bg-brand-cream']));
        array_push($slider2,new GovernmentReport(['reportName' => 'Disket', 'reportDescription' => '', 'reportGroup' => 'Tabung Haji', 'reportTarget' => 'disket', 'reportCss' => 'm-bg-brand-cream']));

        //EPF
        array_push($slider2,new GovernmentReport(['reportName' => 'BBCD', 'reportDescription' => '', 'reportGroup' => 'EPF', 'reportTarget' => 'bbcd', 'reportCss' => 'm-bg-brand-bluish']));
        array_push($slider2,new GovernmentReport(['reportName' => 'Borang A', 'reportDescription' => '', 'reportGroup' => 'EPF', 'reportTarget' => 'borangA', 'reportCss' => 'm-bg-brand-bluish']));

        //SOSCO
        array_push($slider3,new GovernmentReport(['reportName' => 'Lampiran A', 'reportDescription' => '', 'reportGroup' => 'SOSCO', 'reportTarget' => 'lampiranA', 'reportCss' => 'm-bg-brand-greenish']));
        array_push($slider3,new GovernmentReport(['reportName' => 'Borang 8A', 'reportDescription' => '', 'reportGroup' => 'SOSCO', 'reportTarget' => 'borang8A', 'reportCss' => 'm-bg-brand-greenish']));


        //PTPTN
        array_push($slider3,new GovernmentReport(['reportName' => 'Montly', 'reportDescription' => '', 'reportGroup' => 'PTPTN', 'reportTarget' => 'ptptn', 'reportCss' => 'm-bg-brand-rasberry']));

        //ZAKAT
        array_push($slider3,new GovernmentReport(['reportName' => 'Montly', 'reportDescription' => '', 'reportGroup' => 'ZAKAT', 'reportTarget' => 'zakat', 'reportCss' => 'm-bg-brand-orange']));

        //ASBN
        array_push($slider4,new GovernmentReport(['reportName' => 'Montly', 'reportDescription' => '', 'reportGroup' => 'ASBN', 'reportTarget' => 'asbn', 'reportCss' => 'm-bg-brand-brown']));

        //EIS
        array_push($slider4,new GovernmentReport(['reportName' => 'Lampiran 1', 'reportDescription' => '', 'reportGroup' => 'EIS', 'reportTarget' => 'lampiran1', 'reportCss' => 'm-bg-brand-bluish']));

        $arr = array(
            "slider"=>$slider,
            "slider1"=>$slider1,
            "slider2"=>$slider2,
            "slider3"=>$slider3,
            "slider4"=>$slider4
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
