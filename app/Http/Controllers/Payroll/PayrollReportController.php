<?php
namespace App\Http\Controllers\Payroll;

use App\Enums\PayrollPeriodEnum;
use App\Helpers\DateHelper;
use App\Helpers\GenerateReportsHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Payroll\ReportRepository;
use App\Services\PayrollService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mpdf\Output\Destination;
use App\Http\Controllers\Popo\payrollreport\PayrollReport;

class PayrollReportController extends Controller
{
    protected $company;
    public function __construct(PayrollService $payrollService, CompanyRepository $company, ReportRepository $report
//          PayrollRepository $payroll, PayrollReportRepository $payroll_report, 
        )
    {
        $this->company = $company;
//         $this->payroll = $payroll;
//         $this->payroll_report = $payroll_report;
        $this->report = $report;
        $this->payrollService = $payrollService;
    }
    
    // *Note: Total type of reports: 7
    // 1. group by department according company, group by department according company & cost-center (HQ Only)
    // 2. group by department & cost-center according company
    // 3. group by department & cost-center, cost-center according company, group by department according cost-center (Oppo HQ Only)
    // 4. group by department according to company
    // 5. group by bank ID according to company
    // 6. group by company ID (Summary)
    // 7. group by employee according to department & company
    public function export_report(Request $request)
    {
//         dd($request);
        
        // Request Data
        $year = substr($request->input('year_month'),0,4);
        $month = substr($request->input('year_month'),5);
        $type = $request->input('reportName');
        $filter_data = [
            'year'      => $year,
            'month'     => $month,
            'type'      => $type,
        ];
        //checking filter
        if($request->input('selectCostCentres') != 0){
            $filter_data['costcentres'] = $request->input('selectCostCentres');
            
        } 
        
        if($request->input('selectDepartments') != 0){
            $filter_data['departments'] = $request->input('selectDepartments');
            
        }
        
        if($request->input('selectBranches') != 0){
            $filter_data['branches'] = $request->input('selectBranches');
            
        }
        
        if($request->input('selectPositions') != 0){
            $filter_data['positions'] = $request->input('selectPositions');
            
        }
        
        $company = GenerateReportsHelper::getUserLogonCompanyInfomation();
        $data = array(
            'year_month' => $request->input('year_month').'-01',
            'period' => $request->input('selectPeriod'),
            'companyId' => $company->id
        );
        // Condition
        $payroll = $this->payrollService->findByPayrollMonthPeriod($data);
        if (count($payroll) > 0) {
            $payroll = $payroll->first();
            
            if($payroll->status !== 1) {
                $error = 'Payroll must be locked before report generation.';
                return redirect($request->server('HTTP_REFERER'))->withErrors([$error]);
            }
        } else {
            $msg = 'Report ' . $request['year_month'] . ' does not exist.';
            return redirect($request->server('HTTP_REFERER'))->withErrors([$msg]);
        }
//         dd($payroll);
        
        // Process
        DB::beginTransaction();

//         $company_list = $this->company->all(false, ['status'=>'Active']);
        $extra = [
            'period'    => strtoupper(PayrollPeriodEnum::getDescription($payroll->period).'-'.DateHelper::dateWithFormat($payroll->year_month, 'M-Y')),
        ];
        $request_data = [
            'payroll_master_id'  => $payroll->id,
            'type'              => $type,
        ];
//         dd($company,$filter_data,$request_data,$extra);
        switch ($type) {
            case '1':
                // Document 1. Got two types to generate - Group by department, Group by department and cost-center (HQ)
                
                $filter_data['groupby'] = ['JM_department.id'];
                // Run type 1.
                $this->generate_report($company, $filter_data, $request_data, $extra);
                
                $filter_data['cost_center'] = 'HQ';
                // Run type 2.
                $this->generate_report($company, $filter_data, $request_data, $extra);
                
                break;
            case '2':
                // Document 2. Group by department and cost-center based on company
                
                $filter_data['groupby'] = ['JM_department.id', 'JM_category.id'];
                $this->generate_report($company, $filter_data, $request_data, $extra);
                
                break;
            case '3':
                // Document 3. Got three types to generate - Group by department & cost-center, Group by cost-center, Group by department (HQ)
                
                $filter_data['groupby'] = ['JM_department.id', 'JM_category.id'];
                $extra['filter_by'] = '';
                // Run type 1.
                $this->generate_report($company, $filter_data, $request_data, $extra);
                
                $filter_data['groupby'] = ['JM_category.id'];
                $extra['filter_by'] = 'category';
                // Run type 2.
                $this->generate_report($company, $filter_data, $request_data, $extra);
                
                $filter_data['groupby'] = ['JM_department.id'];
                $filter_data['cost_center'] = 'HQ';
                $extra['filter_by'] = 'department';
                // Run type 3.
                $this->generate_report($company, $filter_data, $request_data, $extra);
                
                break;
            case '4':
                // Document 4. Group by department
                
                $filter_data['groupby'] = ['JM_department.id'];
                $this->generate_report($company, $filter_data, $request_data, $extra);
                break;
            case '5':
                // Document 5. Group by bank
//                 dd();
                $filter_data['groupby'] = ['EM.id', 'BM.id'];
                $this->generate_report($company, $filter_data, $request_data, $extra);
                break;
            case '6':
                // Document 6. Summary
                $filter_data['groupby'] = ['CM.id'];
                $this->generate_report($company, $filter_data, $request_data, $extra);
                break;
            case '7':
                // Document 7. Payroll Details
                $filter_data['groupby'] = ['EM.id', 'JM_department.id'];
                $this->generate_report($company, $filter_data, $request_data, $extra);
                break;
            default:
                $error = 'Unknown type of report selected. Kindly contact admin to get more details.';
                break;
        }
        
        DB::commit();
        
        if(@$error) return redirect($request->server('HTTP_REFERER'))->with('error', $error);
        return redirect($request->server('HTTP_REFERER'))->with('success', 'Successfully generated report.');
    }
    
    private function generate_report($company, $filter_data, $request_data, $extra)
    {
        if(isset($company)) {
                $report_list = $this->report->find_by_company_id($company->id, $filter_data);
                
                $document_info = $this->get_document_html($filter_data['type'], $company, $report_list, $extra);
//                 $request_data['file'] = $file_name;
                
                switch ($filter_data['type']) {
                    case '1':
                        $file_name = 'doc1.pdf';
                        $request_data['document_name'] = 'Doc 1. Payment Form Group By Department - '.$company->name;
                        if(@$filter_data['costcentres']) $request_data['document_name'] .= ' (HQ)';
                        break;
                    case '2':
                        $file_name = 'doc2.pdf';
                        $request_data['document_name'] = 'Doc 2. Payment Form Group By Department & Cost Center - '.$company->name;
                        break;
                    case '3':
                        $file_name = 'doc3.pdf';
                        $request_data['document_name'] = 'Doc 3. Supplier Payment Form [Cost Center] - '.$company->name;
                        if(count($filter_data['groupby']) > 1) $request_data['document_name'] = 'Doc 3. Supplier Payment Form [Department - Cost Center] - '.$company->name;
                        if(@$filter_data['cost_center']) $request_data['document_name'] .= ' (HQ)';
                        break;
                    case '4':
                        $file_name = 'doc4.pdf';
                        $request_data['document_name'] = 'Doc 4. Cash Transfer Document [Department] - '.$company->name;
                        break;
                    case '5':
                        $file_name = 'doc5.pdf';
                        $request_data['document_name'] = 'Doc 5. Group By Bank - '.$company->name;
                        break;
                    case '6':
                        $file_name = 'doc6.pdf';
                        $request_data['document_name'] = 'Doc 6. Payroll Summary';
                        break;
                    case '7':
                        $file_name = 'doc7.pdf';
                        $request_data['document_name'] = 'Doc 7. Payroll Details - '.$company->name;
                        break;
                    default:
                        $request_data['document_name'] = 'Not available.';
                        break;
                }
                
                $this->export_pdf($document_info['css'], $document_info['header'], $document_info['footer'], $document_info['body'], $document_info['pdf_format'], $file_name);
//                 $this->payroll_report->update('new', $request_data);
        } 
        /* else {
            $report_list = $this->report->find_by_company_id(0, $filter_data);
            
            $document_info = $this->get_document_html($filter_data['type'], null, $report_list, $extra);
            $file_name = md5(uniqid().rand()).'.pdf';
            $request_data['file'] = $file_name;
            $request_data['document_name'] = 'Doc 6. Payroll Summary';
            
                $this->export_pdf($document_info['css'], $document_info['header'], $document_info['footer'], $document_info['body'], $document_info['pdf_format'], $file_name);
            $this->payroll_report->update('new', $request_data);
        } */
        
    }
    
    private function export_pdf($css, $header = null, $footer = null, $body, $pdf_format = [], $file_name = null)
    {
//         dd('ok');
//         dd($css);
//         $mpdf = new \Mpdf\Mpdf($pdf_format);
//         $mpdf->SetHTMLHeader($header);
//         $mpdf->writeHTML($css,1);
//         // Write some HTML code:
//         $mpdf->WriteHTML('Hello World');
        
        // Output a PDF file directly to the browser
//         $mpdf->Output();
//         dd('ok');
//         dd($pdf_format);
        $mpdf = new \Mpdf\Mpdf([$pdf_format, ['tempDir' => storage_path("temp")]]);
        $mpdf->SetHTMLHeader($header);
        $mpdf->writeHTML($css,1);
        $mpdf->writeHTML($body,2);
        $mpdf->Output($file_name, Destination::DOWNLOAD);
    }
    
    private function get_document_html($document_type, $company, $list, $extra = null)
    {
        $css = '
                <style media="print">
                    .text-right { text-align: right; }
                    .text-left { text-align: left; }
                    .text-center { text-align: center; }
            
                    .w-1p { width: 1%; }
                    .w-2p { width: 2%; }
                    .w-3p { width: 3%; }
                    .w-4p { width: 4%; }
                    .w-5p { width: 5%; }
                    .w-10p { width: 10%; }
                    .w-15p { width: 15%; }
                    .w-20p { width: 20%; }
                    .w-25p { width: 25%; }
                    .w-30p { width: 30%; }
                    .w-35p { width: 35%; }
                    .w-40p { width: 40%; }
                    .w-45p { width: 45%; }
                    .w-50p { width: 50%; }
                    .w-55p { width: 55%; }
                    .w-60p { width: 60%; }
                    .w-65p { width: 65%; }
                    .w-70p { width: 70%; }
                    .w-75p { width: 75%; }
                    .w-80p { width: 80%; }
                    .w-85p { width: 85%; }
                    .w-90p { width: 90%; }
                    .w-95p { width: 95%; }
                    .w-100p { width: 100%; }
            
                    .black-top-border { border-top: 1px solid black; }
                    .black-bottom-border { border-bottom: 1px solid black; }
                    .bold { font-weight: bold; }
                </style>
            
        ';
        
        switch ($document_type) {
            case '1':
            case 1:
            case '2':
            case 2:
                $period = $extra['period'];
                
                $header = '
                    <table style="font-weight:bold; margin-bottom:10px;" cellspacing="0" cellpadding="1">
                        <tbody>
                            <tr>
                                <td class="w-15p">COMPANY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">'.$company->name.' ('.$company->registration_number.')</td>
                                <td class="text-right">Date: '.date_format(date_create(date('Y-m-d')), 'd-M-Y (D) H:i A').' Page: {PAGENO} </td>
                            </tr>
                            <tr>
                                <td class="w-15p">FORMELY KNOWN</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">NO CUKAI PENDAPATAN: C2304727002</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">REPORT TITLE</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">MONTH-TO-DATE PAYROLL SUMMARY</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">SORTED BY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">DEPARTMENT</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">PERIOD</td>
                                <td>:</td>
                                <td class="w-40p">'.$period.'</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                ';
                
                $sum = [];
                $content = '';
                foreach ($list as $key => $info) {
                    $display_name = ($document_type == 1)? $info->department : $info->department.'-'.$info->cost_center;
                    
                    $content .= '
                        <tr>
                            <td colspan="15">
                                GROUP : '.$display_name.'
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15">Total Employee : '.$info->total_employee.'</td>
                        </tr>
                        <tr>
                            <td>Sub Total</td>
                            <td class="text-center">'.$info->total_basic_salary.'</td>
                            <td class="text-center">'.$info->total_unpaid_leave.'</td>
                            <td class="text-center">'.$info->total_overtime.'</td>
                            <td class="text-center">'.$info->total_bonus.'</td>
                            <td class="text-center">'.$info->total_other_addition.'</td>
                            <td class="text-center">'.$info->total_gross_pay.'</td>
                            <td class="text-center">'.$info->total_employee_epf.'</td>
                            <td class="text-center">'.$info->total_employee_socso.'</td>
                            <td class="text-center">'.$info->total_employee_pcb.'</td>
                            <td class="text-center">'.$info->total_other_deduction.'</td>
                            <td class="text-center">'.$info->total_net_pay.'</td>
                            <td class="text-center">'.$info->total_employer_epf.'</td>
                            <td class="text-center">'.$info->total_employer_socso.'</td>
                            <td class="text-center">'.$info->total_employer_levy.'</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-center">'.$info->total_seniority_pay.'</td>
                            <td class="text-center">'.$info->total_default_addition.'</td>
                            <td class="text-center">'.$info->total_shift.'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">'.$info->total_employee_vol.'</td>
                            <td class="text-center">'.$info->total_employee_eis.'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">'.$info->total_employer_vol.'</td>
                            <td class="text-center">'.$info->total_employer_eis.'</td>
                            <td></td>
                        </tr>
                    ';
                    
                    /* TODO: 
                     * if(count($info->additional_list) > 0) {
                        $row = '';
                        foreach($info->additional_list as $key => $additional) {
                            if(!@$additional->code) break;
                            $row .= $additional->code.'..........'.$additional->amount.'&nbsp; &nbsp; &nbsp; ';
                            if(@$sum[$additional->code]) {
                                $sum[$additional->code] = $sum[$additional->code] + $additional->amount;
                            } else {
                                $sum[$additional->code] = $additional->amount;
                            }
                        }
                        $content .= '
                            <tr>
                                <td colspan="15">'.$row.'</td>
                            </tr>
                        ';
                    } */
                }
                
                $final_addition_list = '';
                if(count($sum) > 0) {
                    foreach($sum as $key => $value) {
                        $final_addition_list .= $key.'..........'.$value.'&nbsp; &nbsp; &nbsp; ';
                    }
                }
                
                $body = '
                    <table style="font-size: 10px; text-align: left;" cellspacing="0" cellpadding="1">
                        <thead>
                            <tr>
                                <th class="text-left black-top-border w-30p">DEPARTMENT</th>
                                <th class="text-right black-top-border w-5p">BASIC</th>
                                <th class="text-right black-top-border w-5p">NPL</th>
                                <th class="text-right black-top-border w-5p">OT</th>
                                <th class="text-right black-top-border w-5p">BONUS</th>
                                <th class="text-right black-top-border w-5p">OTHERS</th>
                                <th class="text-right black-top-border w-5p">GROSS</th>
                                <th class="text-right black-top-border w-5p">E\'EPF</th>
                                <th class="text-right black-top-border w-5p">E\'SOC</th>
                                <th class="text-right black-top-border w-5p">E\'TAX</th>
                                <th class="text-right black-top-border w-5p">OTHERS</th>
                                <th class="text-right black-top-border w-5p">NETTPAY</th>
                                <th class="text-right black-top-border w-5p">R\'EPF</th>
                                <th class="text-right black-top-border w-5p">R\'SOC</th>
                                <th class="text-right black-top-border w-5p">R\'LEVY</th>
                            </tr>
                            <tr>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border">S\'PAY</th>
                                <th class="text-right black-bottom-border">ADDPAY</th>
                                <th class="text-right black-bottom-border">SHIFT</th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border">PAY</th>
                                <th class="text-right black-bottom-border">E\'VOL</th>
                                <th class="text-right black-bottom-border">E\'EIS</th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="text-right black-bottom-border">R\'VOL</th>
                                <th class="text-right black-bottom-border">R\'EIS</th>
                                <th class="black-bottom-border"></th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$content.'
                            <tr>
                                <td class="black-top-border bold">Grand Total</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_basic_salary'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_unpaid_leave'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_overtime'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_bonus'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_other_addition'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_gross_pay'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employee_epf'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employee_socso'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employee_pcb'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_other_deduction'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_net_pay'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employer_epf'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employer_socso'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employer_levy'),2,'.','').'</td>
                            </tr>
                            <tr>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_seniority_pay'),2,'.','').'</td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_default_addition'),2,'.','').'</td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_shift'),2,'.','').'</td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_employee_vol'),2,'.','').'</td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_employee_eis'),2,'.','').'</td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_employer_vol'),2,'.','').'</td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_employer_eis'),2,'.','').'</td>
                                <td class="black-bottom-border "></td>
                            </tr>
                            <tr>
                                <td colspan="15">'.$final_addition_list.'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                
                $pdf_format = [
                    'format'        => 'A4-L', // L: Landscape, Default: Portrait
                    'margin_top'    => 40,
                ];
                break;
            case '3':
            case 3:
                $filter_by = $extra['filter_by'];
                $final_net_pay = 0;
                
                $sub_header = '
                    <table class="w-100p">
                        <tr>
                            <td class="text-center w-60p"> <h2> SUPPLIER PAYMENT FORM </h2> </td>
                            <td align="right" class="w-30p"> Date: ..................... </td>
                        </tr>
                    </table>
                    <table class="w-100p">
                        <tr>
                            <td class="w-20p"> Name </td>
                            <td class="w-40p"> : .......................................... <td>
                            <td class="w-40p"></td>
                        </tr>
                        <tr>
                            <td class="w-20p"> Department </td>
                            <td class="w-40p"> : .......................................... <td>
                            <td align="right" class="w-40p"> Date of Proposal : ..................... </td>
                        </tr>
                    </table>
                ';
                $sub_footer = '
                    <table class="w-100p">
                        <tr>
                            <td align="center" class="w-25p"> Prepared by </td>
                            <td align="center" class="w-25p"> Approved by </td>
                            <td align="center" class="w-25p"> Aknowledge by </td>
                            <td align="center" class="w-25p"> Issued by </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding-top: 50px;"> ------------------------------- </td>
                            <td align="center" style="padding-top: 50px;"> ------------------------------- </td>
                            <td align="center" style="padding-top: 50px;"> ------------------------------- </td>
                            <td align="center" style="padding-top: 50px;"> ------------------------------- </td>
                        </tr>
                        <tr>
                            <td align="center" style="font-size: 12px;"></td>
                            <td align="center" style="font-size: 12px;"> Manager </td>
                            <td align="center" style="font-size: 12px;"> General Manager </td>
                            <td align="center" style="font-size: 12px;"> Finance and Accounting </td>
                        </tr>
                    </table>
                ';
                
                $content = '
                    <table class="w-100p" style="border-collapse:collapse;" border="1">
                        <tr>
                            <td align="center" class="w-80p"> Detail Information </td>
                            <td align="center" class="w-20p"> Total </td>
                        </tr>
                        <tr>
                            <td> '.$company->name.' </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td> &nbsp; </td>
                            <td> </td>
                        </tr>
                ';
                foreach ($list as $key => $info) {
                    $i = $key + 1;
                    
                    switch ($filter_by) {
                        case 'category':
                            $display_name = $info->cost_center;
                            break;
                        case 'department':
                            $display_name = $info->department;
                            break;
                        default:
                            $display_name = $info->department.' - '.$info->cost_center;
                            break;
                    }
                    
                    $content .= '
                        <tr>
                            <td> '.$i.') '.$display_name.' </td>
                            <td align="center"> '.$info->total_net_pay.' </td>
                        </tr>
                    ';
                    
                    $final_net_pay = $final_net_pay + $info->total_net_pay;
                    
                }
                $content .= '
                        <tr>
                            <td> &nbsp; </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td align="center"> TOTAL </td>
                            <td align="center"> '.$final_net_pay.' </td>
                        </tr>
                    </table>
                ';
                
                $body = $sub_header.$content.$sub_footer;
                break;
            case '4':
            case 4:
                $period = $extra['period'];
                $final_employee = 0;
                $final_net_pay = 0;
                $final_average_net_pay = 0;
                
                $content = '
                    <table class="w-100p">
                        <tr>
                            <td style="font-weight:bold;"> Company : '.$company->name.' </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;"> Report : Department \'s Salary </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;"> Period : '.$period.' </td>
                        </tr>
                    </table>
                    <table class="w-100p" style="border-collapse:collapse;" border="1">
                        <tr>
                            <td align="center" class="w-40p"> Department </td>
                            <td align="center" class="w-20p"> Total Employee </td>
                            <td align="center" class="w-20p"> Total Net Pay </td>
                            <td align="center" class="w-20p"> Average Net Pay </td>
                        </tr>
                ';
                foreach ($list as $key => $info) {
                    $content .= '
                        <tr>
                            <td align="left"> '.$info->department.' </td>
                            <td align="center"> '.$info->total_employee.' </td>
                            <td align="center"> '.$info->total_net_pay.' </td>
                            <td align="center"> '.$info->average_net_pay.' </td>
                        </tr>
                    ';
                    
                    $final_employee = $final_employee + $info->total_employee;
                    $final_net_pay = $final_net_pay + $info->total_net_pay;
                    $final_average_net_pay = $final_average_net_pay + $info->average_net_pay;
                }
                $content .= '
                        <tr>
                            <td align="left"> &nbsp; &nbsp; &nbsp; TOTAL RM : </td>
                            <td align="center"> '.$final_employee.' </td>
                            <td align="center"> '.$final_net_pay.' </td>
                            <td align="center"> '.$final_average_net_pay.' </td>
                        </tr>
                    </table>
                    <table class="w-100p" style="padding-top:50px;">
                        <tr>
                            <td class="w-30p"> Prepared by : ......................................... </td>
                            <td class="w-30p"> Checked by : ......................................... </td>
                            <td class="w-30p"> Signed by : ......................................... </td>
                            <td class="w-10p"> </td>
                        </tr>
                        <tr>
                            <td align="center"> (Amanda Chong) </td>
                            <td align="center"> (Candice Liu) </td>
                            <td align="center"> (CEO William Fang) </td>
                        </tr>
                    </table>
                ';
                
                $body = $content;
                $pdf_format = [
                    'format'        => 'A4-L',
                ];
                break;
            case '5':
            case 5:
                $period = $extra['period'];
                
                $header = '
                    <table style="font-weight:bold; margin-bottom:10px;" cellspacing="0" cellpadding="1">
                        <tbody>
                            <tr>
                                <td class="w-15p">COMPANY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">'.$company->name.' ('.$company->registration_number.')</td>
                                <td class="text-right">Date: '.date_format(date_create(date('Y-m-d')), 'd-M-Y (D) H:i A').' Page: {PAGENO} </td>
                            </tr>
                            <tr>
                                <td class="w-15p">FORMELY KNOWN</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">NO CUKAI PENDAPATAN: C2304727002</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">REPORT TITLE</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">BANK CREDITING REPORT</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">SORTED BY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">BANK CODE + BRANCH</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">PERIOD</td>
                                <td>:</td>
                                <td class="w-40p">'.$period.'</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                ';
                
                $content = '';
                $bank = '';
                $count = 1;
                $net_pay = 0;
                foreach ($list as $key => $info) {
                    if(!@$bank || $bank != $info->bank) {
                        $bank = $info->bank;
                        $content .= '
                            <tr>
                                <th align="left" colspan="2"> BANK : '.$bank.' Branch()</th>
                            </tr>
                            <tr>
                                <th align="left" colspan="2"> Address : </th>
                            </tr>
                        ';
                    }
                    $content .= '
                        <tr>
                            <td align="left"> '.$info->code.' </td>
                            <td align="left"> '.$info->full_name.' </td>
                            <td align="center"> </td>
                            <td align="center"> '.$info->ic_no.' </td>
                            <td align="center"> </td>
                            <td align="center"> '.$info->account_number.' </td>
                            <td align="right"> '.number_format($info->net_pay,2).' </td>
                        </tr>
                    ';
                    
                    if(@$bank != @$list[$key+1]->bank && @$bank) {
                        $content .= '
                            <tr>
                                <td class="black-top-border bold" align="left" colspan="5"> Total Employee : '.$count.' </td>
                                <td class="black-top-border bold" align="left"> Sub Total </td>
                                <td class="black-top-border bold" align="right"> '.number_format($net_pay,2).' </td>
                            </tr>
                        ';
                        $count = 1;
                        $net_pay = 0;
                        continue;
                    }
                    
                    $count++;
                    $net_pay+=$info->net_pay;
                }
                
                $content .= '
                    <tr>
                        <td class="black-top-border black-bottom-border bold" align="left" colspan="5"> Total Employee : '.$list->count().' </td>
                        <td class="black-top-border black-bottom-border bold" align="left"> Grand Total </td>
                        <td class="black-top-border black-bottom-border bold" align="right"> '.number_format($list->sum('net_pay'),2).' </td>
                    </tr>
                ';
                
                $body = '
                    <table class="w-95p" style="font-size: 12px; text-align: left;" cellspacing="0" cellpadding="1">
                        <thead>
                            <tr>
                                <th align="left" class="black-top-border black-bottom-border w-10p">EMPL NO.</th>
                                <th align="left" class="black-top-border black-bottom-border w-40p">EMPLOYEE NAME</th>
                                <th align="center" class="black-top-border black-bottom-border w-10p">OLD I/C NO</th>
                                <th align="center" class="black-top-border black-bottom-border w-10p">NEW I/C NO</th>
                                <th align="center" class="black-top-border black-bottom-border w-10p">PASSPORT NO</th>
                                <th align="center" class="black-top-border black-bottom-border w-10p">BANK A/C #</th>
                                <th align="right" class="black-top-border black-bottom-border w-10p">NET PAY (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$content.'
                        </tbody>
                    </table>
                ';
                
                $pdf_format = [
                    'format'        => 'A4-L', // L: Landscape, Default: Portrait
                    'margin_top'    => 40,
                ];
                break;
            case '6':
            case 6:
                $content = '';
                $total_employee = 0;
                $total_gross_pay = 0;
                $total_net_pay = 0;
                $period = $extra['period'];
                
                foreach ($list as $key => $info) {
                    $content .= '
                        <br/>
                        <table class="w-100p" style="border-collapse:collapse;" border="1">
                            <tr>
                                <td align="left" style="width:125px; font-weight:bold;  "> '.$info->company_name.' </td>
                                <td align="right" style="width:300px;"> '.$info->total_employee.' </td>
                            </tr>
                            <tr>
                                <td align="left" style="width:125px;"> Gross Pay: </td>
                                <td align="right" style="width:300px;"> RM'.number_format($info->total_gross_pay,2).' </td>
                            </tr>
                            <tr>
                                <td align="left" style="width:125px;"> Nett Pay: </td>
                                <td align="right" style="width:300px;"> RM'.number_format($info->total_net_pay,2).' </td>
                            </tr>
                        </table>
                    ';
                    
                    $total_employee = $total_employee + $info->total_employee;
                    $total_gross_pay = $total_gross_pay + $info->total_gross_pay;
                    $total_net_pay = $total_net_pay + $info->total_net_pay;
                }
                
                $content .= '
                    <br/>
                    <table class="w-100p" style="border-collapse:collapse;" border="1">
                        <tr>
                            <td align="left" style="width:125px; font-weight:bold;  "> TOTAL P1 </td>
                            <td align="right" style="width:300px;"> '.$total_employee.' </td>
                        </tr>
                        <tr>
                            <td align="left" style="width:125px;"> Gross Pay: </td>
                            <td align="right" style="width:300px;"> RM'.number_format($total_gross_pay,2).' </td>
                        </tr>
                        <tr>
                            <td align="left" style="width:125px;"> Nett Pay: </td>
                            <td align="right" style="width:300px;"> RM'.number_format($total_net_pay,2).' </td>
                        </tr>
                    </table>
                ';
                
                $body = '
                    <table class="w-100p" cellspacing="0" cellpadding="1">
                        <thead>
                            <tr>
                                <th class="w-20p"> </th>
                                <th align="left" class="w-60p" style="text-decoration:underline;"> '.$period.' </th>
                                <th class="w-20p"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> </td>
                                <td>
                                    '.$content.'
                                </td>
                                <td> </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                
                break;
            case '7':
            case 7:
                $period = $extra['period'];
                
                $header = '
                    <table style="font-weight:bold; margin-bottom:10px;" cellspacing="0" cellpadding="1">
                        <tbody>
                            <tr>
                                <td class="w-15p">COMPANY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">'.$company->name.' ('.$company->registration_number.')</td>
                                <td class="text-right">Date: '.date_format(date_create(date('Y-m-d')), 'd-M-Y (D) H:i A').' Page: {PAGENO} </td>
                            </tr>
                            <tr>
                                <td class="w-15p">FORMELY KNOWN</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">NO CUKAI PENDAPATAN: C2304727002</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">REPORT TITLE</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">MONTH-TO-DATE PAYROLL DETAIL</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">SORTED BY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">DEPARTMENT</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">PERIOD</td>
                                <td>:</td>
                                <td class="w-40p">'.$period.'</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $content = '';
                $department = '';
                $unreset_count = 0;
                $count = 1;
                
                foreach ($list as $key => $info) {
                    
                    if(!@$department || $department != $info->department) {
                        $department = $info->department;
                        $content .= '
                            <tr>
                                <td style="font-weight:bold;" colspan="16"> GROUP : '.strtoupper($department).'</td>
                            </tr>
                        ';
                    }
                    $content .= '
                        <tr>
                            <td class="text-left">'.$info->code.'</td>
                            <td class="text-left">'.$info->full_name.'</td>
                            <td class="text-center">'.$info->total_basic_salary.'</td>
                            <td class="text-center">'.$info->total_unpaid_leave.'</td>
                            <td class="text-center">'.$info->total_overtime.'</td>
                            <td class="text-center">'.$info->total_bonus.'</td>
                            <td class="text-center">'.$info->total_other_addition.'</td>
                            <td class="text-center">'.$info->total_gross_pay.'</td>
                            <td class="text-center">'.$info->total_employee_epf.'</td>
                            <td class="text-center">'.$info->total_employee_socso.'</td>
                            <td class="text-center">'.$info->total_employee_pcb.'</td>
                            <td class="text-center">'.$info->total_other_deduction.'</td>
                            <td class="text-center">'.$info->total_net_pay.'</td>
                            <td class="text-center">'.$info->total_employer_epf.'</td>
                            <td class="text-center">'.$info->total_employer_socso.'</td>
                            <td class="text-center">'.$info->total_employer_levy.'</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-center">'.$info->total_seniority_pay.'</td>
                            <td class="text-center">'.$info->total_default_addition.'</td>
                            <td class="text-center">'.$info->total_shift.'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">'.$info->total_employee_vol.'</td>
                            <td class="text-center">'.$info->total_employee_eis.'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">'.$info->total_employer_vol.'</td>
                            <td class="text-center">'.$info->total_employer_eis.'</td>
                            <td></td>
                        </tr>
                    ';
                    
                    if(@$department != @$list[$key+1]->department && @$department) {
                        $content .= '
                            <tr>
                                <td align="left" colspan="2" class="bold"> Total Employee : '.$count.' </td>
                            </tr>
                            <tr>
                                <td class="black-top-border bold" align="left"> Sub Total </td>
                                <td class="black-top-border bold text-left"></td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_basic_salary'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_unpaid_leave'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_overtime'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_bonus'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_other_addition'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_gross_pay'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employee_epf'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employee_socso'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employee_pcb'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_other_deduction'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_net_pay'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employer_epf'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employer_socso'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employer_levy'),2,'.','').'</td>
                            </tr>
                            <tr>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_seniority_pay'),2,'.','').'</td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_default_addition'),2,'.','').'</td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_shift'),2,'.','').'</td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employee_vol'),2,'.','').'</td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employee_eis'),2,'.','').'</td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employer_vol'),2,'.','').'</td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employer_eis'),2,'.','').'</td>
                                <td class="black-bottom-border bold "></td>
                            </tr>
                        ';
                        $count = 1;
                        $unreset_count = $key+1;
                        continue;
                    }
                    
                    $count++;
                }
                
                $content .= '
                    <tr>
                        <td align="left" colspan="2" class="bold"> Total Employee : '.$list->count().' </td>
                    </tr>
                    <tr>
                        <td class="black-top-border bold" align="left"> Grand Total </td>
                        <td class="black-top-border bold text-left"></td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_basic_salary'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_unpaid_leave'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_overtime'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_bonus'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_other_addition'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_gross_pay'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employee_epf'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employee_socso'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employee_pcb'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_other_deduction'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_net_pay'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employer_epf'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employer_socso'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employer_levy'),2,'.','').'</td>
                    </tr>
                    <tr>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_seniority_pay'),2,'.','').'</td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_default_addition'),2,'.','').'</td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_shift'),2,'.','').'</td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_employee_vol'),2,'.','').'</td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_employee_eis'),2,'.','').'</td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_employer_vol'),2,'.','').'</td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_employer_eis'),2,'.','').'</td>
                        <td class="black-bottom-border bold "></td>
                    </tr>
                ';
                
                $body = '
                    <table style="font-size: 10px; text-align: left;" cellspacing="0" cellpadding="1">
                        <thead>
                            <tr>
                                <th class="text-left black-top-border w-10p">EMP NO.</th>
                                <th class="text-left black-top-border w-20p">EMPLOYEE NAME</th>
                                <th class="text-right black-top-border w-5p">BASIC</th>
                                <th class="text-right black-top-border w-5p">NPL</th>
                                <th class="text-right black-top-border w-5p">OT</th>
                                <th class="text-right black-top-border w-5p">BONUS</th>
                                <th class="text-right black-top-border w-5p">OTHERS</th>
                                <th class="text-right black-top-border w-5p">GROSS</th>
                                <th class="text-right black-top-border w-5p">E\'EPF</th>
                                <th class="text-right black-top-border w-5p">E\'SOC</th>
                                <th class="text-right black-top-border w-5p">E\'TAX</th>
                                <th class="text-right black-top-border w-5p">OTHERS</th>
                                <th class="text-right black-top-border w-5p">NETTPAY</th>
                                <th class="text-right black-top-border w-5p">R\'EPF</th>
                                <th class="text-right black-top-border w-5p">R\'SOC</th>
                                <th class="text-right black-top-border w-5p">R\'LEVY</th>
                            </tr>
                            <tr>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border">S\'PAY</th>
                                <th class="text-right black-bottom-border">ADDPAY</th>
                                <th class="text-right black-bottom-border">SHIFT</th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border">PAY</th>
                                <th class="text-right black-bottom-border">E\'VOL</th>
                                <th class="text-right black-bottom-border">E\'EIS</th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="text-right black-bottom-border">R\'VOL</th>
                                <th class="text-right black-bottom-border">R\'EIS</th>
                                <th class="black-bottom-border"></th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$content.'
                        </tbody>
                    </table>
                ';
                
                $pdf_format = [
                    'format'        => 'A4-L', // L: Landscape, Default: Portrait
                    'margin_top'    => 40,
                ];
                break;
            default:
                break;
        }
        
        return [
            'css'           => $css,
            'header'        => @$header,
            'footer'        => @$footer,
            'body'          => $body,
            'pdf_format'    => (@$pdf_format)?:[],
        ];
    }
    
}

