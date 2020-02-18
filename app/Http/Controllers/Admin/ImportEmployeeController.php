<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\EmployeesImport;

class ImportEmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function importEmployees(Request $request)
    {
        $ImportData = $request->validate([
           'file_import'  => 'required|mimes:xls,xlsx'
        ]);
        
        $fileName = $request->file('file_import')->getRealPath();
        Log::debug('Start Import Employees');
        //$fileName = 'Template.xlsx';
        $import = new EmployeesImport();
        Excel::import($import, $fileName);
        
        //TODO: return error
    }
}
