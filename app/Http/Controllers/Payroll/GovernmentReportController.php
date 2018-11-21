<?php

namespace App\Http\Controllers\payroll;

use App\Helpers\GenerateReportsHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Popo\governmentreport\GovernmentReport;
use App\Http\Controllers\Popo\governmentreport\LhdnBorangEBean;
use App\Http\Controllers\Popo\governmentreport\LhdnCP8EmployeeDetail;
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
        $data = new GovernmentReport();
        //get slider data
        $sliders = $data->getGovernmentReport();

        return view('pages.payroll.government-report')->with(['sliders' => $sliders]);
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
                echo "portrait";
                break;
            case "LHDN_cp22":
                echo "portrait";
                break;
            case "LHDN_cp22a":
                echo "portrait";
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
