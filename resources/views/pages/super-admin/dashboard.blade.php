@extends('layouts.super-admin-base') 
@section('content')
<div id="page-super-admin-dashboard" class="container-fluid">
    {{-- {!! dd($initCheck) !!} --}}
    @if(!$initCheck["ok"])
    <div id="init-warning-prompt" class="card bg-danger">
        <div class="card-header text-white">
            Application has not been fully initialized
        </div>  
        <ul class="list-group list-group-flush">
            @if($initCheck["companiesCount"] <= 0)
                <li class="init-warning list-group-item"><span>There should be at least one <b>Company</b> created</span><a href="{{ route('admin.settings.setting-company') }}"  class="btn btn-sm btn-primary float-right">Add Company</a></li>
            @endif
            @if($initCheck["costCentresCount"] <= 0)
                <li class="init-warning list-group-item"><span>There should be at least one <b>Cost Centre</b> created</span><a href="{{ route('admin.settings.setting-cost-centre') }}"  class="btn btn-sm btn-primary float-right">Add Cost Centre</a></li>
            @endif
            @if($initCheck["departmentsCount"] <= 0)
                <li class="init-warning list-group-item"><span>There should be at least one <b>Department</b> created</span><a href="{{ route('admin.settings.setting-department') }}"  class="btn btn-sm btn-primary float-right">Add Department</a></li>
            @endif
            @if($initCheck["branchesCount"] <= 0)
                <li class="init-warning list-group-item"><span>There should be at least one <b>Branch</b> created</span><a href="{{ route('admin.settings.setting-branch') }}"  class="btn btn-sm btn-primary float-right">Add Branch</a></li>
            @endif
            @if($initCheck["teamsCount"] <= 0)
                <li class="init-warning list-group-item"><span>There should be at least one <b>Team</b> created</span><a href="{{ route('admin.settings.setting-team') }}"  class="btn btn-sm btn-primary float-right">Add Team</a></li>
            @endif
            @if($initCheck["employeePositionsCount"] <= 0)
                <li class="init-warning list-group-item"><span>There should be at least one <b>Employee Position</b> created</span><a href="{{ route('admin.settings.setting-position') }}"  class="btn btn-sm btn-primary float-right">Add Position</a></li>
            @endif
            @if($initCheck["employeeGradesCount"] <= 0)
                <li class="init-warning list-group-item"><span>There should be at least one <b>Employee Grade</b> created</span><a href="{{ route('admin.settings.setting-grade') }}"  class="btn btn-sm btn-primary float-right">Add Grade</a></li>
            @endif
        </ul>
    </div>
    @endif
</div>
@endsection