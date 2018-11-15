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

    public function __construct(array $array = []) {
        $this->reportName = isset($array['reportName']) ? $array['reportName'] : null;
        $this->reportDescription = isset($array['reportDescription']) ? $array['reportDescription'] : null;
        $this->reportGroup = isset($array['reportGroup']) ? $array['reportGroup'] : null;
        $this->reportTarget = isset($array['reportTarget']) ? $array['reportTarget'] : null;
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

    public function getGovernmentReport(){
        $arr = array();
        array_push($arr,new GovernmentReport(['reportName' => 'Borang E', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'borangE']));
        array_push($arr,new GovernmentReport(['reportName' => 'CP21', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp21']));
        array_push($arr,new GovernmentReport(['reportName' => 'CP22', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp22']));
        array_push($arr,new GovernmentReport(['reportName' => 'CP22a', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp22a']));
        array_push($arr,new GovernmentReport(['reportName' => 'CP22b', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp22b']));
        array_push($arr,new GovernmentReport(['reportName' => 'CP39', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp39']));
        array_push($arr,new GovernmentReport(['reportName' => 'CP39 Lieu', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'cp39lieu']));
        array_push($arr,new GovernmentReport(['reportName' => 'EA Form', 'reportDescription' => '', 'reportGroup' => 'LHDN', 'reportTarget' => 'eaform']));

        return $arr;
    }

    public function toArray() {
        return [
            'month'=> $this->month,
            'year'=> $this->year,
            'employerReferenceNo' => $this->employerReferenceNo
        ];
    }

    public function toJson() {
        return json_encode($this->toArray());
    }
}
