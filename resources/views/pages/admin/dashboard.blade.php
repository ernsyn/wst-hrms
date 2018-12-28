@extends('layouts.admin-base') 
@section('content') {{-- @hasrole('super-admin') --}}
<div id="page-admin-dashboard" class="p-4">
    <div class="row">
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="{{ route('admin.employees') }}" style="text-decoration: none">
                <div class="card border-0 bg-primary">
                    <div class="card-body">
                        <i class="fas fa-user fa-4x float-right text-white"></i>
                        <h6 class="text-white text-capitalize">Total Employee</h6>
                    <h1 class="text-white">{{ App\Employee::count() }}</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="{{ route('admin.employees') }}" style="text-decoration: none">
                <div id="emp-joined-card" class="card border-0">
                    <div class="card-body">
                        <i class="fas fa-user-plus fa-4x float-right text-white"></i>
                        <h6 class="text-white">Joined This Month</h6>
                        <h1 class="text-white">{{ App\Employee::whereMonth('created_at', date('m'))->count() }}</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 col-xl-3 col-lg-6">
        <a href="{{ route('admin.e-leave.configuration.leaverequests') }}" style="text-decoration: none">
                <div id="leave-requests-card" class="card border-0">
                    <div class="card-body">
                        <i class="fas fa-calendar-check fa-4x float-right text-white"></i>
                        <h6 class="text-white text-capitalize">Open Leave Requests</h6>
                        <h1 class="text-white">{{ App\LeaveRequest::where('status', 'new')->count() }}</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="{{ route('admin.settings.branches') }}" style="text-decoration: none">
                <div class="card border-0 bg-danger">
                    <div class="card-body">
                        <i class="fas fa-map-marker-alt fa-4x float-right text-white"></i>
                        <h6 class="text-white text-capitalize">Total Branches</h6>
                        <h1 class="text-white">{{ App\Branch::count() }}</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="{{ route('admin.attendance.current-day') }}" style="text-decoration: none">
                <div class="card border-0 bg-info">
                    <div class="card-body">
                        <i class="fas fa-clock fa-4x float-right text-white"></i>
                        <h6 class="text-white">Attendance for {{ \Carbon\Carbon::today()->format('l, d/m/Y') }}</h6>
                        <h1 class="text-white">
                            {{ 
                                App\EmployeeClockInOutRecord::selectRaw('DISTINCT(emp_id)')
                                ->whereDate('clock_in_time', \Carbon\Carbon::today())
                                ->count() 
                            }}
                            /
                            {{ 
                                DB::table('employees')
                                ->join('employee_working_days', 'employees.id', '=', 'employee_working_days.emp_id')
                                ->whereIn(strtolower(\Carbon\Carbon::today()->format('l')), array('full','half'))
                                ->count() 
                            }}
                        </h1>
                    </div>
                </div>
            </a>
        </div>
    </div>
    {{-- <div class="row">
        <div class="p-2 col-lg-8">
            <div class="card">
                <div class="card-header">Monthly Leave Statistic</div>
                <div class="card-body p-5">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div> --}}
        {{-- <div class="p-2 col-lg-4">
            <div class="card">
                <div class="card-header">Recent Leave Request</div>
                <div class="card-body bulletin p-4">
                    <div class="card-body bulletin"> --}}
                        {{-- @foreach($leaveRequests as $leaveRequest)
                        <div class="row">
                            <div class="col-auto">
                                <div class="float-right">{{$loop->iteration}}.</div>
                            </div>
                            <div class="col">
                                <div>{{$leaveRequest->user->name}}</div>
                                <div>{{$leaveRequest['leave_type']}}</div>
                                {{--
                                <div>{{$row['start_date']}} - {{$row['end_date']}}</div> --}}
                                {{-- <div>{{$leaveRequest['total_days']}} days</div>
                                <div>{{$leaveRequest['status']}}</div>
                                <div class="dropdown-divider"></div>
                            </div>
                        </div>
                        @endforeach --}}
                    {{-- </div>
                </div>
                <div class="card-footer">
                    <a href="" type="button" class="btn btn-outline-primary btn-block">View All Request</a></div>
            </div>
        </div> --}}
    {{-- </div> --}}
</div>
{{-- @else
<div>I am not a super admin...</div>
@endhasrole --}}
@endsection

@section('scripts')
{{-- <script>
new Chart($("#myChart"), {
    type: 'bar',
    data: {
        labels: ["AL", "SL", "UL", "HL", "ML", "MTL"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Monthly Leave Statistics'
        },
        legend: {
            display: false
        }

    }
});
</script> --}}
@append