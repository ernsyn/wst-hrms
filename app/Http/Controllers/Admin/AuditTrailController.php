<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;

class AuditTrailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin']);
    }

    public function display()
    {
        return view('pages.admin.audit-trail.index');
    }

    public function getDataTableAuditTrails()
    {
        $audits = \OwenIt\Auditing\Models\Audit::with(
            [
                'user.employee' => function($query) {
                    $query->select(['user_id','code']);
                }
            ]
        );

        return DataTables::of($audits)->make(true);
    }
}
