<?php

namespace App\Http\Controllers\payroll;

use App\Enums\PayrollPeriodEnum;
use App\Exports\EISLampiranExport;
use App\Helpers\GenerateReportsHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Popo\governmentreport\GovernmentReport;
use PDF;
use Illuminate\Http\Request;
use DB;
use Auth;
use Excel;


class GovernmentReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function viewGovernmentReport(){

        //get company information based on user login
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        $officers = GenerateReportsHelper::getListOfficerInformation($company->id);

        //get slider data
        $arr = GovernmentReport::getGovernmentReportSlider();
        $form = GovernmentReport::getGovernmentReportForm();
        $costcentres = GenerateReportsHelper::getCostCentre();
        $departments = GenerateReportsHelper::getDepartments();
        $branches = GenerateReportsHelper::getBranches();
        $positions = GenerateReportsHelper::getPosition();
        $period = GenerateReportsHelper::getPeriod($company->id);
        $year = GenerateReportsHelper::getYear($company->id);



        return view('pages.payroll.government-report')->with([
            'sliders' => $arr['slider'] ,
            'sliders1' => $arr['slider1'] ,
            'sliders2' => $arr['slider2'] ,
            'sliders3' => $arr['slider3'] ,
            'sliders4' => $arr['slider4'] ,
            'dforms' => $form['form'],
            'dforms1' => $form['form1'],
            'dforms2' => $form['form2'],
            'dforms3' => $form['form3'],
            'dforms4' => $form['form4'],
            'costcentres' => $costcentres,
            'departments' => $departments,
            'branches' => $branches,
            'positions' => $positions,
            'period' => $period,
            'year' => $year,
            'officers' => $officers
        ]);
    }

    public function generateReport(Request $request){

        $this->validate($request, [
            'reportName' => 'required'
        ]);

        $reportName = $request->input('reportName');
        $year = $request->input('selectYear');
        $periods = $request->input('selectPeriod');
        $officerId = $request->input('selectOfficer');

        //checking filter
        if($request->input('selectCostCentres') != 0){
            $filter = "costcentres";
            $value = $request->input('selectCostCentres');

        }else if($request->input('selectDepartments') != 0){
            $filter = "departments";
            $value = $request->input('selectDepartments');

        }else if($request->input('selectBranches') != 0){
            $filter = "branches";
            $value = $request->input('selectBranches');

        }else if($request->input('selectPositions') != 0){
            $filter = "positions";
            $value = $request->input('selectPositions');

        }else{
            $filter = "none";
            $value = 0;
        }

        $filterOption = GenerateReportsHelper::getFilterKey($filter,$value);
        $result = $this->generate($reportName,$periods,$year,$officerId,$filterOption);
        if(!empty($result)){
            return $result;
        }else{
            return redirect()->route('payroll/government_report')->with('message', 'No record found!');
        }
    }


    private function generate($reportName,$periods,$year,$officerId,$filter){
        switch ($reportName) {
            case "LHDN_borangE":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnBorangE',
                        [
                            'data' => $arr['data'],
                            'empData' => $arr['empData'],
                        ])->setOrientation('landscape');

                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('lhdnBorangE.pdf');
                }else{
                    return;
                }
                break;

            case "LHDN_cp21":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnCP21',
                        [
                            'dataArr' => $arr['data']
                        ]);

                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('lhdn_cp21.pdf');
                }else{
                    return;
                }
                break;

            case "LHDN_cp22":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnCP22',
                        [
                            'dataArr' => $arr['data']
                        ]);

                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('lhdn_cp22.pdf');
                }else{
                    return;
                }
                break;

            case "LHDN_cp22a":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnCP22a',
                        [
                            'dataArr' => $arr['data']
                        ]);

                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('lhdn_cp22a.pdf');
                }else{
                    return;
                }
                break;

            case "LHDN_cp22b":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnCP22b',
                        [
                            'dataArr' => $arr['data']
                        ]);
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('lhdn_cp22b.pdf');
                }else{
                    return;
                }
                break;

            case "LHDN_cp39":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnCP39',
                        [
                            'data' => $arr['data'],
                            'empData' => $arr['empData'],
                            'totalPcb' => $arr['totalPcb'],
                            'totalcp38' => $arr['totalcp38'],
                            'totalAmountofPCBAndCP8' => $arr['totalAmountofPCBAndCP8']
                        ])->setOrientation('landscape');
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('lhdn_cp39.pdf');
                }else{
                    return;
                }
                break;

            case "LHDN_cp39lieu":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnCP39_lieu',
                        [
                            'dataArr' => $arr['data']
                        ]);
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('lhdn_cp39lieu.pdf');
                }else{
                    return;
                }
                break;

            case "LHDN_eaform":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)){
                    $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnEaForm1',
                        [
                            'dataArr' => $arr['data']
                        ]);
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('lhdn_eaForm.pdf');
                }  else{
                    return;
                }
                break;

            case "Tabung_Haji_caruman":
/*                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$date,$officerId,$filter);
                $pdf = PDF::loadView('pages/payroll/governmentreport/tabunghaji_caruman',
                    [
                        'data' => $arr['data'] ,
                        'empData' => $arr['empData']
                    ] )->setOrientation('landscape');
                $pdf->setTemporaryFolder(storage_path("temp"));
                // download pdf
                return $pdf->download('tabunghaji_caruman.pdf');*/
                return;
                break;

            case "Tabung_Haji_df":
                return;
                break;

            case "EPF_bbcd":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/epf_bbcd',
                        [
                            'data' => $arr['data']
                        ]);
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('epf_bbcd.pdf');
                }else{
                    return;
                }
                break;

            case "EPF_borangA":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/epf_borangA',
                        [
                            'data' => $arr['data'],
                            'empData' => $arr['empData'],
                            'totalOverallContributionEmp' => $arr['totalOverallContributionEmp'],
                        ]);
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('epf_borangA.pdf');
                }else{
                    return;
                }
                break;

            case "SOSCO_lampiranA":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/soscoLampiranA',
                        [
                            'data' => $arr['data']
                        ]);
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('sosco_LampiranA.pdf');
                }else{
                    return;
                }
                break;

            case "SOSCO_borang8A":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/soscoBorang8A',
                        [
                            'data' => $arr['data'],
                            'empData' => $arr['empData'],
                            'totalContribution' => $arr['totalContribution']
                        ]);
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('sosco_Borang8A.pdf');
                }else{
                    return;
                }
                break;

            case "PTPTN_monthly":
                //TODO :PTPTN currently not in used.
/*
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/ptptn',
                        [
                            'data' => $arr['data'],
                            'empData' => $arr['empData'],
                            'totalCheckAmount' => $arr['totalCheckAmount']
                        ]);
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('ptptn.pdf');
                }else{
                    return;
                }
*/
                return;
                break;

            case "ZAKAT_montly":
                //TODO :ZAKAT currently not in used.
/*
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    $pdf = PDF::loadView('pages/payroll/governmentreport/zakat',
                        [
                            'data' => $arr['data'],
                            'empData' => $arr['empData']
                        ]);
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('zakat.pdf');
                }else{
                    return;
                }
*/
                return;
                break;

            case "ASBN_monthly":
                //TODO :ASBN currently not in used.
                return;
                break;

            case "EIS_lampiran1":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                if(!empty($arr)) {
                    return Excel::download(new EISLampiranExport(
                        $arr['data'],
                        $arr['dataArr'],
                        $arr['totalContributionAmount']
                    ), 'EIS_lampiran1.xlsx');
                }else{
                    return;
                }
                return;
                break;

            case "test":
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$year,$officerId,$filter);
                break;
            default:
                echo "None";
        }
    }


}
