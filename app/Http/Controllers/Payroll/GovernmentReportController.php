<?php

namespace App\Http\Controllers\payroll;

use App\Helpers\GenerateReportsHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Popo\governmentreport\GovernmentReport;
use PDF;
use Illuminate\Http\Request;
use DB;
use Auth;


class GovernmentReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function viewGovernmentReport(){

        //get slider data
        $arr = GovernmentReport::getGovernmentReport();

        return view('pages.payroll.government-report')->with([
            'sliders' => $arr['slider'] ,
            'sliders1' => $arr['slider1'] ,
            'sliders2' => $arr['slider2'] ,
            'sliders3' => $arr['slider3'] ,
            'sliders4' => $arr['slider4'] ,
        ]);
    }

    public function generateReport(Request $request){

        $this->validate($request, [
            'reportName' => 'required'
        ]);

        $reportName = $request->input('reportName');

        return $this->generate($reportName,null);
    }

    private function generate($reportName,$option){
        switch ($reportName) {
            case "LHDN_borangE":
                $arr = GenerateReportsHelper::generateBean($reportName,null);
                $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnBorangE',
                    ['data' => $arr['data'] ,
                     'empData' => $arr['data1'] ,
                    ])->setOrientation('landscape');

                $pdf->setTemporaryFolder(storage_path("temp"));
                // download pdf
                return $pdf->download('lhdnBorangE.pdf');
                break;

            case "LHDN_cp21":
                $arr = GenerateReportsHelper::generateBean($reportName,null);
                $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnCP21',
                    ['dataArr' => $arr['data']
                    ]);

                $pdf->setTemporaryFolder(storage_path("temp"));
                // download pdf
                return $pdf->download('lhdn_cp21.pdf');
                break;

            case "LHDN_cp22":
                $arr = GenerateReportsHelper::generateBean($reportName,null);
                $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnCP22',
                    ['dataArr' => $arr['data']
                    ]);

                $pdf->setTemporaryFolder(storage_path("temp"));
                // download pdf
                return $pdf->download('lhdn_cp22.pdf');
                break;

            case "LHDN_cp22a":
                $arr = GenerateReportsHelper::generateBean($reportName,null);
                $pdf = PDF::loadView('pages/payroll/governmentreport/lhdnCP22a',
                    ['dataArr' => $arr['data']
                    ]);

                $pdf->setTemporaryFolder(storage_path("temp"));
                // download pdf
                return $pdf->download('lhdn_cp22a.pdf');
                break;

            case "LHDN_cp22b":
                echo "portrait";
                break;
            case "LHDN_cp39":
                echo "portrait";
                break;
            case "LHDN_cp39lieu":
                echo "portrait";
                break;
            case "LHDN_eaform":
                echo "portrait";
                break;
            default:
                echo "None";
        }
    }


}
