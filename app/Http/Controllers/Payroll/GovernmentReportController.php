<?php

namespace App\Http\Controllers\payroll;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Popo\governmentreport\GovernmentReport;
use Illuminate\Http\Request;
use DB;
use Auth;
use Log;

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

    public function callReport(){
        return view('pages.payroll.government-report');
    }


    private function getAllGovermentReport(){

    }

}
