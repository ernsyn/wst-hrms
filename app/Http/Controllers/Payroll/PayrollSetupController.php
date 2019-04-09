<?php

namespace App\Http\Controllers\Payroll;

use App\Helpers\AccessControllHelper;
use App\Helpers\GenerateReportsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\PayrollSetup;

class PayrollSetupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin']);
    }
    
    public function index()
    {
        if(AccessControllHelper::hasSuperadminRole()){
            $payrollSetup = PayrollSetup::all();
        } else {
            $company = GenerateReportsHelper::getUserLogonCompanyInformation();
            $payrollSetup = PayrollSetup::where('company_id',$company->id)->get();
        }
        
        return view('pages.payroll.payroll-setup.index', compact('payrollSetup'));
    }
    
    public function create()
    {
        $company = Company::all();
        return view('pages.payroll.payroll-setup.create', compact('company'));
    }
    
    public function store(Request $request)
    {
        $currentUser = Auth::id();
        
        $request->validate([
            'key'=>'required',
            'value'=> 'required',
            'remark' => 'required',
            'company' => 'required'
        ]);
        
        $payrollSetup = new PayrollSetup([
            'key' => $request->get('key'),
            'value'=> $request->get('value'),
            'remark'=> $request->get('remark'),
            'status' => 1,
            'created_by' => $currentUser,
            'company_id' => $request->get('company'),
        ]);
        $payrollSetup->save();
        return redirect('/payroll-setup')->with('success', 'Payroll Setup has been added');
    }
    
    public function show($id)
    {
        $payrollSetup = PayrollSetup::find($id);
        $company = Company::all();
        $disable = true;

        return view('pages.payroll.payroll-setup.edit', compact('payrollSetup', 'company', 'disable'));
    }
    
    public function edit($id)
    {
        $payrollSetup = PayrollSetup::find($id);
        $company = Company::all();
        $disable = false;
        
        return view('pages.payroll.payroll-setup.edit', compact('payrollSetup', 'company', 'disable'));
    }
    
    public function update(Request $request, $id)
    {
        $currentUser = Auth::id();
        
        $request->validate([
            'key'=>'required',
            'value'=> 'required',
            'remark' => 'required',
            'company' => 'required',
            'status' => 'required'
        ]);
        
//         $payrollSetup = PayrollSetup::find($id);
        $payrollSetup['value'] = $request->get('value');
        $payrollSetup['remark'] = $request->get('remark');
        if(AccessControllHelper::hasSuperadminRole()) {
            $payrollSetup['key'] = $request->get('key');
            $payrollSetup['company_id'] = $request->get('company');
            $payrollSetup['status'] = $request->get('status');
        }
        $payrollSetup['updated_by'] = $currentUser;
        
        PayrollSetup::find($id)->update($payrollSetup);
        
//         $payrollSetup->save();
        
        return redirect('/payroll-setup')->with('success', 'Payroll Setup has been updated');
    }
    
    public function destroy($id)
    {
        if(AccessControllHelper::hasSuperadminRole()) {
            $payrollSetup = PayrollSetup::find($id);
            $payrollSetup->delete();
            
            return redirect()->route('payroll-setup.index')->with('success','Payroll Setup deleted successfully');
        }
    }
}
