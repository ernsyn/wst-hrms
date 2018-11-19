@extends('layouts.admin-base') 
@section('content') {{-- @hasrole('super-admin') --}}
<div class="p-4">
    <div class="row">
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="{{ route('admin.employees') }}">
                <div class="card border-0 bg-primary">
                    <div class="card-body">
                        <i class="fas fa-user fa-4x float-right text-white"></i>
                        <h6 class="text-white text-capitalize">Total Employee</h6>
                        <h1 class="text-white">187</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="{{ route('admin.employees') }}">
                <div class="card border-0 bg-info">
                    <div class="card-body">
                        <i class="fas fa-user-plus fa-4x float-right text-white"></i>
                        <h6 class="text-white text-capitalize">Joined This Month</h6>
                        <h1 class="text-white">7</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="{{ route('admin/leaverequest') }}">
                <div class="card border-0 bg-success">
                    <div class="card-body">
                        <i class="fas fa-calendar-check fa-4x float-right text-white"></i>
                        <h6 class="text-white text-capitalize">Leave Request</h6>
                        <h1 class="text-white">9</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 col-xl-3 col-lg-6">
            <a href="">
                <div class="card border-0 bg-danger">
                    <div class="card-body">
                        <i class="fas fa-map-marker-alt fa-4x float-right text-white"></i>
                        <h6 class="text-white text-capitalize">Total Branch</h6>
                        <h1 class="text-white">13</h1>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="p-2 col-lg-8">
            <div class="card">
                <div class="card-header">Monthly Leave Statistic</div>
                <div class="card-body p-5">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="p-2 col-lg-4">
            <div class="card">
                <div class="card-header">Recent Leave Request</div>
                <div class="card-body bulletin p-4">
                    <div class="card-body bulletin">
                        {{-- {!! dd($leaveRequests) !!} --}} @foreach($leaveRequests as $leaveRequest)
                        <div class="row">
                            <div class="col-auto">
                                <div class="float-right">{{$loop->iteration}}.</div>
                            </div>
                            <div class="col">
                                <div>{{$leaveRequest->user->name}}</div>
                                <div>{{$leaveRequest['leave_type']}}</div>
                                {{--
                                <div>{{$row['start_date']}} - {{$row['end_date']}}</div> --}}
                                <div>{{$leaveRequest['total_days']}} days</div>
                                <div>{{$leaveRequest['status']}}</div>
                                <div class="dropdown-divider"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin/leaverequest') }}" type="button" class="btn btn-outline-primary btn-block">View All Request</a></div>
            </div>
        </div>
    </div>
</div>
{{-- @else
<div>I am not a super admin...</div>
@endhasrole --}}
@endsection