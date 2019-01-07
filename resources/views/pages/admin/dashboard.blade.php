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
                <div class="card border-1">
                    <div class="card-body adjust-height">
                        <h6 class="text-black">Attendance for {{ \Carbon\Carbon::today()->format('l, d/m/Y') }}</h6>
                        <div class="progress-attendance">
                            <div class="barOverflow">
                                <div class="bar"></div>
                            </div>
                            <span class="fraction">
                                <span class="today_attendance">{{ 
                                    App\EmployeeClockInOutRecord::selectRaw('DISTINCT(emp_id)')
                                    ->whereDate('clock_in_time', \Carbon\Carbon::today())
                                    ->count() 
                                }}</span>/<span class="total_working_today">{{ 
                                    DB::table('employees')
                                    ->join('employee_working_days', 'employees.id', '=', 'employee_working_days.emp_id')
                                    ->whereIn(strtolower(\Carbon\Carbon::today()->format('l')), array('full','half'))
                                    ->count() 
                                }}</span>
                                <span class="pct" hidden>56.5</span>
                            </span>
                        </div>
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
<script>
$(function(){
    adjust_dimensions();

    $(window).resize(function(){
        adjust_dimensions();
    });

    $(".progress-attendance").each(function(){  
        var $bar = $(this).find(".bar");
        var total = ($(".today_attendance").text() / $(".total_working_today").text()) * 100;

        $("span.pct").text(total);

        var $val = $(this).find("span.pct");
        var perc = parseInt( $val.text(), 10);

        $({p:0}).animate({p:perc}, {
            duration: 1000,
            easing: "swing",
            step: function(p) {
                $bar.css({
                    transform: "rotate("+ (45+(p*1.8)) +"deg)", // 100%=180° so: ° = % * 1.8
                    // 45 is to add the needed rotation to have the green borders at the bottom
                });
                $val.text(p|0);
            }
        });
    });

    function adjust_dimensions() {
        var container_width = $(".adjust-height").width();
        var semi_height = container_width / 2;
        var adjust_height = container_width - 110;

        $('.bar').width(container_width - 60);
        $('.bar').height(container_width - 60);
        $('.barOverflow').width(container_width);
        $('.barOverflow').height(semi_height);
    }
})
</script>
@append