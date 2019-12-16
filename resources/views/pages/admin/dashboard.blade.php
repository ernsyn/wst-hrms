@extends('layouts.admin-base') 
@section('content') 
@can(PermissionConstant::VIEW_ADMIN_DASHBOARD)
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
        <a href="{{ route('admin.e-leave.configuration.leave-requests') }}" style="text-decoration: none">
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
                                    DB::table('employee_clock_in_out_records')
                                    ->distinct('emp_id')
                                    ->whereDate('clock_in_time', \Carbon\Carbon::today())
                                    ->count('emp_id')
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
</div>
@endcan
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
                    transform: "rotate("+ (45+(p*1.8)) +"deg)", 
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