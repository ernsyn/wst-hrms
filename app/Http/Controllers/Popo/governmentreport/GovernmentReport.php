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
    private $showOfficer;
    private $showPeriod;
    private $showYear;
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
        $this->showYear = isset($array['showYear']) ? $array['showYear'] : null;
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
    public function getShowYear()
    {
        return $this->showYear;
    }

    /**
     * @param mixed|null $showYear
     */
    public function setShowYear( $showYear)
    {
        $this->showYear = $showYear;
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

    public static function getGovernmentReportSlider(){
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
        array_push($slider3,new GovernmentReport(['reportName' => 'Lampiran A', 'reportDescription' => '', 'reportGroup' => 'SOCSO', 'reportTarget' => 'lampiranA', 'reportCss' => 'm-bg-brand-greenish']));
        array_push($slider3,new GovernmentReport(['reportName' => 'Borang 8A', 'reportDescription' => '', 'reportGroup' => 'SOCSO', 'reportTarget' => 'borang8A', 'reportCss' => 'm-bg-brand-greenish']));


        //PTPTN
        array_push($slider3,new GovernmentReport(['reportName' => 'Monthly', 'reportDescription' => '', 'reportGroup' => 'PTPTN', 'reportTarget' => 'ptptn', 'reportCss' => 'm-bg-brand-rasberry']));

        //ZAKAT
        array_push($slider3,new GovernmentReport(['reportName' => 'Monthly', 'reportDescription' => '', 'reportGroup' => 'ZAKAT', 'reportTarget' => 'zakat', 'reportCss' => 'm-bg-brand-orange']));

        //ASBN
        array_push($slider4,new GovernmentReport(['reportName' => 'Monthly', 'reportDescription' => '', 'reportGroup' => 'ASBN', 'reportTarget' => 'asbn', 'reportCss' => 'm-bg-brand-brown']));

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

    public static function getGovernmentReportForm(){
        $form = array();
        $form1 = array();
        $form2 = array();
        $form3 = array();
        $form4 = array();

        //LHDN
        array_push($form,new GovernmentReport(['reportName' => 'LHDN Borang E', 'value' => 'LHDN_borangE', 'reportGroup' => 'Lembaga Hasil Dalam Negeri', 'reportTarget' => 'borangE', 'reportCss' => 'm-bg-brand', 'reportCss' => 'm-bg-brand', 'showOfficer' => true, 'showYear' => true, 'showPeriod' => false, 'showFilter' => true ]));
        array_push($form,new GovernmentReport(['reportName' => 'LHDN CP21', 'value' => 'LHDN_cp21', 'reportGroup' => 'Lembaga Hasil Dalam Negeri', 'reportTarget' => 'cp21', 'reportCss' => 'm-bg-brand', 'showOfficer' => true, 'showYear' => true, 'showPeriod' => false, 'showFilter' => true]));
        array_push($form,new GovernmentReport(['reportName' => 'LHDN CP22', 'value' => 'LHDN_cp22', 'reportGroup' => 'Lembaga Hasil Dalam Negeri', 'reportTarget' => 'cp22', 'reportCss' => 'm-bg-brand', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));
        array_push($form,new GovernmentReport(['reportName' => 'LHDN CP22a', 'value' => 'LHDN_cp22a', 'reportGroup' => 'Lembaga Hasil Dalam Negeri', 'reportTarget' => 'cp22a', 'reportCss' => 'm-bg-brand', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));

        array_push($form1,new GovernmentReport(['reportName' => 'LHDN CP22b', 'value' => 'LHDN_cp22b', 'reportGroup' => 'Lembaga Hasil Dalam Negeri', 'reportTarget' => 'cp22b', 'reportCss' => 'm-bg-brand', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));
        array_push($form1,new GovernmentReport(['reportName' => 'LHDN CP39', 'value' => 'LHDN_cp39', 'reportGroup' => 'Lembaga Hasil Dalam Negeri', 'reportTarget' => 'cp39', 'reportCss' => 'm-bg-brand', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));
        array_push($form1,new GovernmentReport(['reportName' => 'LHDN CP39 Lieu', 'value' => 'LHDN_cp39lieu', 'reportGroup' => 'Lembaga Hasil Dalam Negeri', 'reportTarget' => 'cp39lieu', 'reportCss' => 'm-bg-brand', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));
        array_push($form1,new GovernmentReport(['reportName' => 'LHDN EA Form', 'value' => 'LHDN_eaform', 'reportGroup' => 'Lembaga Hasil Dalam Negeri', 'reportTarget' => 'eaform', 'reportCss' => 'm-bg-brand', 'showOfficer' => true, 'showYear' => true, 'showPeriod' => false, 'showFilter' => true]));

        //Tabung haji
        array_push($form2,new GovernmentReport(['reportName' => 'Tabung Haji  Caruman', 'value' => 'Tabung_Haji_caruman', 'reportGroup' => 'Lembaga Tabung Haji', 'reportTarget' => 'caruman', 'reportCss' => 'm-bg-brand-cream', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));
        array_push($form2,new GovernmentReport(['reportName' => 'Tabung Haji  Disket', 'value' => 'Tabung_Haji_disket', 'reportGroup' => 'Lembaga Tabung Haji', 'reportTarget' => 'disket', 'reportCss' => 'm-bg-brand-cream', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));

        //EPF
        array_push($form2,new GovernmentReport(['reportName' => 'EPF BBCD', 'value' => 'EPF_bbcd', 'reportGroup' => 'Kumpulan Wang Simpanan Pekerja', 'reportTarget' => 'bbcd', 'reportCss' => 'm-bg-brand-bluish', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));
        array_push($form2,new GovernmentReport(['reportName' => 'EPF Borang A', 'value' => 'EPF_borangA', 'reportGroup' => 'Kumpulan Wang Simpanan Pekerja', 'reportTarget' => 'borangA', 'reportCss' => 'm-bg-brand-bluish', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));

        //SOSCO
        array_push($form3,new GovernmentReport(['reportName' => 'SOCSO Lampiran A', 'value' => 'SOSCO_lampiranA', 'reportGroup' => 'Pertubuhan Keselamatan Social', 'reportTarget' => 'lampiranA', 'reportCss' => 'm-bg-brand-greenish', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));
        array_push($form3,new GovernmentReport(['reportName' => 'SOCSO Borang 8A', 'value' => 'SOSCO_borang8A', 'reportGroup' => 'Pertubuhan Keselamatan Social', 'reportTarget' => 'borang8A', 'reportCss' => 'm-bg-brand-greenish', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));


        //PTPTN
        array_push($form3,new GovernmentReport(['reportName' => 'PTPTN', 'value' => 'PTPTN_monthly', 'reportGroup' => 'Perbadanan Tabung Pendidikan Tinggi Nasional', 'reportTarget' => 'ptptn', 'reportCss' => 'm-bg-brand-rasberry', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));

        //ZAKAT
        array_push($form3,new GovernmentReport(['reportName' => 'ZAKAT', 'value' => 'ZAKAT_monthly', 'reportGroup' => 'ZAKAT Malaysia', 'reportTarget' => 'zakat', 'reportCss' => 'm-bg-brand-orange', 'showOfficer' => true, 'showPeriod' => true, 'showYear' => false, 'showFilter' => true]));

        //ASBN
        array_push($form4,new GovernmentReport(['reportName' => 'ASBN', 'value' => 'ASBN_monthly',  'reportGroup' => 'Amanah Saham National Berhad', 'reportTarget' => 'asbn', 'reportCss' => 'm-bg-brand-brown', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));

        //EIS
        array_push($form4,new GovernmentReport(['reportName' => 'EIS Lampiran 1', 'value' => 'EIS_lampiran1',   'reportGroup' => 'Employment Insurance System', 'reportTarget' => 'lampiran1', 'reportCss' => 'm-bg-brand-bluish', 'showOfficer' => true, 'showYear' => false, 'showPeriod' => true, 'showFilter' => true]));

        $form = array(
            "form"=>$form,
            "form1"=>$form1,
            "form2"=>$form2,
            "form3"=>$form3,
            "form4"=>$form4
        );
        return $form;
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
